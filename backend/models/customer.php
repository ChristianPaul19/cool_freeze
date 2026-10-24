<?php

require_once __DIR__ . '/user.php';

function customer_user_id(mysqli $conn, int $customerId): ?int {
    $stmt = $conn->prepare('SELECT user_id FROM customers WHERE customer_id = ? LIMIT 1');
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_row();
    $stmt->close();
    return $row ? (int) $row[0] : null;
}

function customer_find(mysqli $conn, int $customerId): ?array {
    $stmt = $conn->prepare(
        'SELECT c.customer_id, u.username, u.email, c.phone, c.full_name, c.birthday, c.address, c.profile_image, u.is_active, c.created_at
         FROM customers c JOIN users u ON u.user_id = c.user_id
         WHERE c.customer_id = ? LIMIT 1'
    );
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $row ?: null;
}

function customer_taken_by_other(mysqli $conn, int $customerId, string $username, string $email): array {
    return user_taken($conn, $username, $email, customer_user_id($conn, $customerId));
}

function customer_update_profile(
    mysqli $conn, int $customerId, string $username, string $email,
    ?string $fullName, ?string $phone, ?string $birthday, ?string $address
): void {
    $fullName = ($fullName === '') ? null : $fullName;
    $phone    = ($phone === '')    ? null : $phone;   // phone is NOT NULL: empty keeps the old number
    $birthday = ($birthday === '') ? null : $birthday;
    $address  = ($address === '')  ? null : $address;

    $stmt = $conn->prepare(
        'UPDATE customers c JOIN users u ON u.user_id = c.user_id
         SET u.username = ?, u.email = ?, c.full_name = ?, c.phone = COALESCE(?, c.phone),
             c.birthday = ?, c.address = ?
         WHERE c.customer_id = ?'
    );
    $stmt->bind_param('ssssssi', $username, $email, $fullName, $phone, $birthday, $address, $customerId);
    $stmt->execute();
    $stmt->close();
}

function customer_update_profile_image(mysqli $conn, int $customerId, string $path): void {
    $stmt = $conn->prepare('UPDATE customers SET profile_image = ? WHERE customer_id = ?');
    $stmt->bind_param('si', $path, $customerId);
    $stmt->execute();
    $stmt->close();
}

function customer_change_password(mysqli $conn, int $customerId, string $current, string $new): bool {
    $stmt = $conn->prepare(
        'SELECT u.user_id, u.password_hash
         FROM customers c JOIN users u ON u.user_id = c.user_id
         WHERE c.customer_id = ? LIMIT 1'
    );
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$row || !password_verify($current, $row['password_hash'])) {
        return false;
    }
    user_set_password($conn, (int) $row['user_id'], $new);
    return true;
}

function customer_exists(mysqli $conn, string $username, string $email): array {
    return user_taken($conn, $username, $email);   // checks every role, not just customers
}

function customer_create(mysqli $conn, string $username, string $email, string $phone, string $password): int {
    $conn->begin_transaction();
    try {
        $userId = user_create($conn, 'customer', $username, $email, $password);

        $stmt = $conn->prepare(
            'INSERT INTO customers (user_id, phone, agreed_to_terms, terms_agreed_at)
             VALUES (?, ?, 1, NOW())'
        );
        $stmt->bind_param('is', $userId, $phone);
        $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();

        $conn->commit();
        return $id;
    } catch (Throwable $e) {
        $conn->rollback();
        throw $e;
    }
}