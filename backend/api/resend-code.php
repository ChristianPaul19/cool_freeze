<?php
require_once __DIR__ . '/../helpers/api.php';
require_once __DIR__ . '/../helpers/mailer.php';
require_once __DIR__ . '/../models/password_reset.php';
require_once __DIR__ . '/../models/user.php';

require_method('POST');

$email = $_SESSION['reset_email'] ?? '';
if ($email === '') {
    respond([
        'success'  => false,
        'message'  => 'Please start again from the Forgot Password page.',
        'redirect' => BASE_URL . '?page=forget',
    ], 400);
}

if (!empty($_SESSION['reset_last_sent']) && time() - $_SESSION['reset_last_sent'] < 60) {
    respond(['success' => false, 'message' => 'Please wait a minute before asking for another code.'], 429);
}

try {
    $user = user_find_by_email($conn, $email);
    if ($user && (int) $user['is_active'] === 1) {
        send_reset_code_email($email, password_reset_create($conn, $email));
    }
    $_SESSION['reset_last_sent'] = time();

    respond(['success' => true, 'message' => 'If that email is registered, a new code has been sent.']);
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    respond(['success' => false, 'message' => 'Something went wrong. Please try again.'], 500);
}