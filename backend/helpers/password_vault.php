<?php
/*
 * Keeps an ENCRYPTED copy of the customer's password so the profile page can show it
 * when the eye button is clicked. Login still uses password_hash / password_verify.
 * The key is created automatically in backend/config/vault_key.php the first time it is needed.
 * Do NOT upload or share vault_key.php (add it to .gitignore). If it is deleted,
 * the stored copies can no longer be read (they are saved again at the customer's next login).
 */

function vault_key(): string
{
    $file = BACKEND_PATH . '/config/vault_key.php';

    if (!is_file($file)) {
        $key = bin2hex(random_bytes(32));
        file_put_contents($file, "<?php\nreturn '" . $key . "';\n", LOCK_EX);
    }

    return hex2bin(require $file);
}

function vault_encrypt(string $plain): string
{
    $iv = random_bytes(12);
    $cipher = openssl_encrypt($plain, 'aes-256-gcm', vault_key(), OPENSSL_RAW_DATA, $iv, $tag);

    return base64_encode($iv . $tag . $cipher);
}

function vault_decrypt(string $stored): ?string
{
    $raw = base64_decode($stored, true);
    if ($raw === false || strlen($raw) < 29) {
        return null;
    }

    $plain = openssl_decrypt(substr($raw, 28), 'aes-256-gcm', vault_key(), OPENSSL_RAW_DATA, substr($raw, 0, 12), substr($raw, 12, 16));

    return $plain === false ? null : $plain;
}
