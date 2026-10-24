<?php
require_once __DIR__ . '/customer.php';

const RESET_CODE_MINUTES = 10;
const RESET_MAX_ATTEMPTS = 5;

function password_reset_create(mysqli $conn, string $email): string {
    $code = (string) random_int(10000, 99999);
    $hash = password_hash($code, PASSWORD_DEFAULT);

    $stmt = $conn->prepare('UPDATE password_resets SET used_at = NOW() WHERE email = ? AND used_at IS NULL');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->close();

    $minutes = RESET_CODE_MINUTES;
    $stmt = $conn->prepare(
        'INSERT INTO password_resets (email, code_hash, expires_at)
         VALUES (?, ?, DATE_ADD(NOW(), INTERVAL ? MINUTE))'
    );
    $stmt->bind_param('ssi', $email, $hash, $minutes);
    $stmt->execute();
    $stmt->close();

    return $code;
}

function password_reset_active(mysqli $conn, string $email): ?array {
    $stmt = $conn->prepare(
        'SELECT reset_id, code_hash, attempts FROM password_resets
         WHERE email = ? AND used_at IS NULL AND expires_at > NOW()
         ORDER BY reset_id DESC LIMIT 1'
    );
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return ($row && (int) $row['attempts'] < RESET_MAX_ATTEMPTS) ? $row : null;
}

function password_reset_verify(mysqli $conn, string $email, string $code): bool {
    $row = password_reset_active($conn, $email);
    if (!$row) {
        return false;
    }
    if (password_verify($code, $row['code_hash'])) {
        return true;
    }
    $id = (int) $row['reset_id'];
    $stmt = $conn->prepare('UPDATE password_resets SET attempts = attempts + 1 WHERE reset_id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    return false;
}

function password_reset_mark_used(mysqli $conn, string $email): void {
    $stmt = $conn->prepare('UPDATE password_resets SET used_at = NOW() WHERE email = ? AND used_at IS NULL');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->close();
}