<?php

function auth_role(): ?string {
    $role = $_SESSION['role'] ?? null;
    if ($role === 'admin'    && !empty($_SESSION['admin_id']))    return 'admin';
    if ($role === 'customer' && !empty($_SESSION['customer_id'])) return 'customer';
    return null;
}

function auth_home_url(?string $role): string {
    return BASE_URL . ($role === 'admin' ? '?page=admin_home' : '?page=home_main');
}

function auth_sign_in(string $role, int $profileId, int $userId, string $username): void {
    session_regenerate_id(true);
    unset($_SESSION['customer_id'], $_SESSION['admin_id'], $_SESSION['role'], $_SESSION['user_id'],
          $_SESSION['username'], $_SESSION['login_attempts'], $_SESSION['login_locked_until']);
    $_SESSION['role']     = $role;
    $_SESSION['user_id']  = $userId;
    $_SESSION['username'] = $username;
    if ($role === 'admin') {
        $_SESSION['admin_id'] = $profileId;
    } else {
        $_SESSION['customer_id'] = $profileId;
    }
}