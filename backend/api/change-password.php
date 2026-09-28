<?php
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../models/customer_profile.php';

ini_set('display_errors', '0');
header('Content-Type: application/json');

if (!function_exists('respond')) {
    function respond(array $data, int $code = 200): never {
        http_response_code($code);
        echo json_encode($data);
        exit;
    }
}

function fail(string $message, int $code = 422): never {
    respond(['success' => false, 'message' => $message], $code);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('Method not allowed.', 405);
}

$customerId = (int) ($_SESSION['customer_id'] ?? 0);
if ($customerId === 0) {
    fail('Please log in again.', 401);
}

// Same idea as login: 5 wrong current passwords locks this for 5 minutes
if (!empty($_SESSION['pw_locked_until']) && time() < $_SESSION['pw_locked_until']) {
    fail('Too many attempts. Please try again in a few minutes.', 429);
}

$current = $_POST['current_password'] ?? '';
$new     = $_POST['new_password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if ($current === '' || $new === '' || $confirm === '') fail('Please fill in all fields.');
if (strlen($new) < 8)        fail('New password must be at least 8 characters.');  // match your register rules
if (strlen($new) > 72)       fail('New password must be 72 characters or fewer.');
if ($new !== $confirm)       fail('New password and confirm password do not match.');
if ($new === $current)       fail('New password must be different from the current one.');

try {
    $hash = customer_get_password_hash($conn, $customerId);

    if (!$hash || !password_verify($current, $hash)) {
        $_SESSION['pw_attempts'] = ($_SESSION['pw_attempts'] ?? 0) + 1;
        if ($_SESSION['pw_attempts'] >= 5) {
            $_SESSION['pw_locked_until'] = time() + 300;
            $_SESSION['pw_attempts'] = 0;
        }
        fail('Current password is incorrect.', 401);
    }

    customer_set_password_hash($conn, $customerId, password_hash($new, PASSWORD_DEFAULT));
    customer_store_password_copy($conn, $customerId, $new);   // encrypted copy for the eye button
    unset($_SESSION['pw_attempts'], $_SESSION['pw_locked_until']);
    session_regenerate_id(true);

    respond(['success' => true, 'message' => 'Password changed.']);
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    fail('Something went wrong. Please try again.', 500);
}
