<?php
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../models/customer_profile.php';

ini_set('display_errors', '0');
header('Content-Type: application/json');
header('Cache-Control: no-store');

if (!function_exists('respond')) {
    function respond(array $data, int $code = 200): never {
        http_response_code($code);
        echo json_encode($data);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['success' => false, 'message' => 'Method not allowed.'], 405);
}

$customerId = (int) ($_SESSION['customer_id'] ?? 0);
if ($customerId === 0) {
    respond(['success' => false, 'message' => 'Please log in again.'], 401);
}

try {
    $stored = customer_get_password_copy($conn, $customerId);
    $plain  = $stored ? vault_decrypt($stored) : null;

    if ($plain === null) {
        respond(['success' => false, 'message' => 'Not available yet. Log out and log in again.'], 404);
    }

    respond(['success' => true, 'password' => $plain]);
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    respond(['success' => false, 'message' => 'Something went wrong.'], 500);
}
