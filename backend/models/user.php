<?php

function user_find_by_login(mysqli $conn, string $login): ?array {
    $stmt = $conn->prepare(
        'SELECT user_id, role, username, email, password_hash, is_active
         FROM users WHERE email = ? OR username = ? LIMIT 1'
    );
    $stmt->bind_param('ss', $login, $login);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $row ?: null;
}

function user_find_by_email(mysqli $conn, string $email): ?array {
    $stmt = $conn->prepare(
        'SELECT user_id, role, username, email, is_active FROM users WHERE email = ? LIMIT 1'
    );
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $row ?: null;
}

function user_taken(mysqli $conn, string $username, string $email, ?int $exceptUserId = null): array {
    if ($exceptUserId === null) {
        $stmt = $conn->prepare('SELECT username, email FROM users WHERE username = ? OR email = ?');
        $stmt->bind_param('ss', $username, $email);
    } else {
        $stmt = $conn->prepare(
            'SELECT username, email FROM users WHERE (username = ? OR email = ?) AND user_id <> ?'
        );
        $stmt->bind_param('ssi', $username, $email, $exceptUserId);
    }
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    $taken = [];
    foreach ($rows as $r) {
        if (strcasecmp($r['username'], $username) === 0) $taken['username'] = 'Username is already taken.';
        if (strcasecmp($r['email'], $email) === 0)       $taken['email']    = 'Email is already registered.';
    }
    return $taken;
}

function user_create(mysqli $conn, string $role, string $username, string $email, string $password): int {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare('INSERT INTO users (role, username, email, password_hash) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $role, $username, $email, $hash);
    $stmt->execute();
    $id = $stmt->insert_id;
    $stmt->close();
    return $id;
}

function user_set_password(mysqli $conn, int $userId, string $new): void {
    $hash = password_hash($new, PASSWORD_DEFAULT);
    $stmt = $conn->prepare('UPDATE users SET password_hash = ? WHERE user_id = ?');
    $stmt->bind_param('si', $hash, $userId);
    $stmt->execute();
    $stmt->close();
}

function user_touch_login(mysqli $conn, int $userId): void {
    $stmt = $conn->prepare('UPDATE users SET last_login_at = NOW() WHERE user_id = ?');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->close();
}

function user_profile_id(mysqli $conn, int $userId, string $role): ?int {
    $sql = match ($role) {
        'customer'   => 'SELECT customer_id   FROM customers   WHERE user_id = ? LIMIT 1',
        'admin'      => 'SELECT admin_id      FROM admins      WHERE user_id = ? LIMIT 1',
        'technician' => 'SELECT technician_id FROM technicians WHERE user_id = ? LIMIT 1',
        default      => null,
    };
    if ($sql === null) return null;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_row();
    $stmt->close();
    return $row ? (int) $row[0] : null;
}