<?php

require_once __DIR__ . '../../bootstrap.php';
require_once __DIR__ . '../../models/customer.php';

header('Content-Type: application/json');

function respond(array $data, int $code = 200): never {
    http_response_code($code);
    echo json_encode($data);
    exit;
}

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['success' => false, 'message' => 'Method not allowed.'], 405);
}

// Read input
$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$confirm  = $_POST['confirm_password'] ?? '';

// Validate
$errors = [];

if (!preg_match('/^[A-Za-z0-9_]{3,50}$/', $username)) {
    $errors['username'] = 'Use 3-50 letters, numbers, or underscores.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
    $errors['email'] = 'Enter a valid email address.';
}
if (!preg_match('/^[0-9+\-\s()]{7,20}$/', $phone)) {
    $errors['phone'] = 'Enter a valid phone number.';
}
if (strlen($password) < 8) {
    $errors['password'] = 'Password must be at least 8 characters.';
}
if ($password !== $confirm) {
    $errors['confirm_password'] = 'Passwords do not match.';
}
if (empty($_POST['terms'])) {
    $errors['terms'] = 'You must accept the Terms and Privacy Policy.';
}

if ($errors) {
    respond(['success' => false, 'errors' => $errors], 422);
}

// Save to database
try {
    $taken = customer_exists($conn, $username, $email);
    if ($taken) {
        respond(['success' => false, 'errors' => $taken], 409);
    }

    customer_create($conn, $username, $email, $phone, $password);

    respond([
        'success'  => true,
        'message'  => 'Account created! Redirecting to login...',
        'redirect' => BASE_URL . '?page=login',
    ]);
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() === 1062) { // duplicate key (race condition)
        respond(['success' => false, 'errors' => ['username' => 'Username or email is already registered.']], 409);
    }
    error_log($e->getMessage());
    respond(['success' => false, 'message' => 'Something went wrong. Please try again.'], 500);
}