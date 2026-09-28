<?php
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../models/customer_profile.php';

ini_set('display_errors', '0');   // API must return clean JSON only
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

$username = trim($_POST['username'] ?? '');
$fullName = trim($_POST['full_name'] ?? '');
$birthday = trim($_POST['birthday'] ?? '');
$address  = trim($_POST['address'] ?? '');
$email    = strtolower(trim($_POST['email'] ?? ''));
$phone    = trim($_POST['phone'] ?? '');

// ---- validation ----
if (mb_strlen($username) < 3 || mb_strlen($username) > 50) fail('User name must be 3 to 50 characters.');
if (mb_strlen($fullName) > 100)                             fail('Full name is too long.');
if (mb_strlen($address) > 255)                              fail('Address is too long.');
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 100) fail('Enter a valid email address.');
if ($phone !== '' && !preg_match('/^[0-9+\-\s()]{7,20}$/', $phone))       fail('Enter a valid phone number.');

$birthdayValue = null;
if ($birthday !== '') {
    $date = DateTime::createFromFormat('!Y-m-d', $birthday);
    if (!$date || $date->format('Y-m-d') !== $birthday || $date > new DateTime('today')) {
        fail('Enter a valid birthday.');
    }
    $birthdayValue = $birthday;
}

try {
    $taken = customer_find_taken($conn, $username, $email, $customerId);
    if ($taken === 'username') fail('That user name is already taken.', 409);
    if ($taken === 'email')    fail('That email is already used by another account.', 409);

    $current = customer_get_profile($conn, $customerId);
    if (!$current) fail('Account not found.', 404);

    // ---- optional new profile photo ----
    $uploadDir = FRONTEND_PATH . 'assets/uploads/';
    $newImage  = null;

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['profile_image'];
        if ($file['error'] !== UPLOAD_ERR_OK) fail('The photo could not be uploaded.');
        if ($file['size'] > 2 * 1024 * 1024)   fail('Photo must be 2 MB or smaller.');

        $types = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        $mime  = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        if (!isset($types[$mime])) fail('Photo must be a JPG, PNG or WEBP image.');

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $newImage = 'customer' . $customerId . '_' . bin2hex(random_bytes(6)) . '.' . $types[$mime];
        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $newImage)) fail('The photo could not be saved.', 500);
    }

    try {
        customer_update_profile($conn, $customerId, [
            'username'  => $username,
            'full_name' => $fullName,
            'birthday'  => $birthdayValue,
            'address'   => $address,
            'email'     => $email,
            'phone'     => $phone,
        ], $newImage);
    } catch (mysqli_sql_exception $e) {
        if ($newImage) @unlink($uploadDir . $newImage);
        if ($e->getCode() === 1062) fail('That user name or email is already used.', 409);
        throw $e;
    }

    // remove the old photo file
    $old = $current['profile_image'] ?? '';
    if ($newImage && $old && preg_match('/^customer\d+_[a-f0-9]+\.(jpg|png|webp)$/', $old)) {
        @unlink($uploadDir . $old);
    }

    $_SESSION['username'] = $username;

    $baseUrl = rtrim(BASE_URL, '/');
    respond([
        'success' => true,
        'message' => 'Profile updated.',
        'profile' => [
            'username'         => $username,
            'full_name'        => $fullName,
            'birthday_display' => $birthdayValue ? date('F j, Y', strtotime($birthdayValue)) : '',
            'address'          => $address,
            'email'            => $email,
            'phone'            => $phone,
        ],
        'profile_image_url' => $newImage ? $baseUrl . '/frontend/assets/uploads/' . $newImage : null,
    ]);
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    fail('Something went wrong. Please try again.', 500);
}
