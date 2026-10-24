<?php
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../models/user.php';

ini_set('display_errors', '0');
header('Content-Type: application/json');

function respond(array $data, int $code = 200): never {
    http_response_code($code);
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['success' => false, 'message' => 'Method not allowed.'], 405);
}

if (!empty($_SESSION['login_locked_until']) && time() < $_SESSION['login_locked_until']) {
    respond(['success' => false, 'message' => 'Too many attempts. Please try again in a few minutes.'], 429);
}

$login    = trim($_POST['login'] ?? '');
$password = $_POST['password'] ?? '';

$errors = [];
if ($login === '' || strlen($login) > 100) {
    $errors['login'] = 'Enter your username or email address.';
}
if ($password === '') {
    $errors['password'] = 'Enter your password.';
}
if ($errors) {
    respond(['success' => false, 'errors' => $errors], 422);
}

try {
    $user  = user_find_by_login($conn, $login);
    $valid = false;
    if ($user) {
        $valid = password_verify($password, $user['password_hash']);
    } else {
        password_hash($password, PASSWORD_DEFAULT);
    }

    if (!$valid) {
        $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
        if ($_SESSION['login_attempts'] >= 5) {
            $_SESSION['login_locked_until'] = time() + 300;
            $_SESSION['login_attempts'] = 0;
        }
        respond(['success' => false, 'message' => 'Invalid username/email or password.'], 401);
    }

    if ((int) $user['is_active'] !== 1) {
        respond(['success' => false, 'message' => 'This account has been deactivated. Please contact support.'], 403);
    }

    if ($user['role'] === 'technician') {
        respond(['success' => false, 'message' => 'Technician accounts cannot log in on the website.'], 403);
    }

    $profileId = user_profile_id($conn, (int) $user['user_id'], $user['role']);
    if (!$profileId) {
        error_log('users row ' . $user['user_id'] . ' has no ' . $user['role'] . ' profile row');
        respond(['success' => false, 'message' => 'Account setup is incomplete. Please contact support.'], 403);
    }

    auth_sign_in($user['role'], $profileId, (int) $user['user_id'], $user['username']);
    user_touch_login($conn, (int) $user['user_id']);

    respond([
        'success'  => true,
        'message'  => 'Login successful! Redirecting...',
        'redirect' => auth_home_url($user['role']),
    ]);
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    respond(['success' => false, 'message' => 'Something went wrong. Please try again.'], 500);
}