<?php
// Database functions for the customer profile page (same style as models/customer.php).
require_once BACKEND_PATH . '/helpers/password_vault.php';

function customer_get_profile(mysqli $conn, int $customerId): ?array
{
    $stmt = $conn->prepare(
        'SELECT customer_id, username, full_name, birthday, address, email, phone, profile_image
         FROM customers WHERE customer_id = ? LIMIT 1'
    );
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $row ?: null;
}

// Returns 'username' or 'email' if another customer already uses it, otherwise null.
function customer_find_taken(mysqli $conn, string $username, string $email, int $exceptId): ?string
{
    $stmt = $conn->prepare(
        'SELECT username, email FROM customers
         WHERE (username = ? OR email = ?) AND customer_id <> ? LIMIT 1'
    );
    $stmt->bind_param('ssi', $username, $email, $exceptId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$row) {
        return null;
    }
    return strcasecmp($row['username'], $username) === 0 ? 'username' : 'email';
}

// $newImage is a file name, or null to keep the current photo.
function customer_update_profile(mysqli $conn, int $customerId, array $d, ?string $newImage): void
{
    if ($newImage !== null) {
        $stmt = $conn->prepare(
            'UPDATE customers
             SET username = ?, full_name = ?, birthday = ?, address = ?, email = ?, phone = ?, profile_image = ?
             WHERE customer_id = ?'
        );
        $stmt->bind_param('sssssssi', $d['username'], $d['full_name'], $d['birthday'], $d['address'], $d['email'], $d['phone'], $newImage, $customerId);
    } else {
        $stmt = $conn->prepare(
            'UPDATE customers
             SET username = ?, full_name = ?, birthday = ?, address = ?, email = ?, phone = ?
             WHERE customer_id = ?'
        );
        $stmt->bind_param('ssssssi', $d['username'], $d['full_name'], $d['birthday'], $d['address'], $d['email'], $d['phone'], $customerId);
    }
    $stmt->execute();
    $stmt->close();
}

function customer_get_password_hash(mysqli $conn, int $customerId): ?string
{
    $stmt = $conn->prepare('SELECT password_hash FROM customers WHERE customer_id = ? LIMIT 1');
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $row['password_hash'] ?? null;
}

function customer_set_password_hash(mysqli $conn, int $customerId, string $hash): void
{
    $stmt = $conn->prepare('UPDATE customers SET password_hash = ? WHERE customer_id = ?');
    $stmt->bind_param('si', $hash, $customerId);
    $stmt->execute();
    $stmt->close();
}

// Saves the encrypted, viewable copy of the password (see helpers/password_vault.php).
function customer_store_password_copy(mysqli $conn, int $customerId, string $plainPassword): void
{
    $encrypted = vault_encrypt($plainPassword);
    $stmt = $conn->prepare('UPDATE customers SET password_enc = ? WHERE customer_id = ?');
    $stmt->bind_param('si', $encrypted, $customerId);
    $stmt->execute();
    $stmt->close();
}

function customer_get_password_copy(mysqli $conn, int $customerId): ?string
{
    $stmt = $conn->prepare('SELECT password_enc FROM customers WHERE customer_id = ? LIMIT 1');
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $row['password_enc'] ?? null;
}
