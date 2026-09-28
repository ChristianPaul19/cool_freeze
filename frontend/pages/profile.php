<?php

require_once dirname(__DIR__) . '/../backend/bootstrap.php';

// Shared parts live in frontend/includes/
$componentsPath = __DIR__ . '/../includes/';
require_once $componentsPath . 'cf-helpers.php';

$base = rtrim(BASE_URL, '/');

require_once BACKEND_PATH . '/models/customer_profile.php';

// Only a logged-in customer can open this page (login saves customer_id in the session).
$customerId = (int) ($_SESSION['customer_id'] ?? 0);
$customer   = $customerId ? customer_get_profile($conn, $customerId) : null;

if (!$customer) {
    header('Location: ' . $base . '/?page=login');
    exit;
}

$currentPage = 'profile';

$username     = $customer['username'];
$userName     = $username;                         // used by the header
$fullName     = $customer['full_name'] ?? '';
$birthdayIso  = $customer['birthday'] ?? '';       // YYYY-MM-DD, for <input type="date">
$birthday     = $birthdayIso ? date('F j, Y', strtotime($birthdayIso)) : '';
$address      = $customer['address'] ?? '';
$email        = $customer['email'];
$phone        = $customer['phone'] ?? '';
$profileImage = !empty($customer['profile_image'])
    ? $base . '/frontend/assets/uploads/' . rawurlencode($customer['profile_image'])
    : $base . '/frontend/assets/img/default-avatar.svg';
$supportUrl   = 'mailto:support@coolfreeze.com';   // TODO: your real support page/email

$passwordMask = '**************';   // the real password is loaded only when the eye is clicked

$profileFields = [
    ['id' => 'username', 'icon' => 'monitor',  'label' => 'User name', 'value' => $username],
    ['id' => 'fullName', 'icon' => 'file',     'label' => 'Full name', 'value' => $fullName !== '' ? $fullName : 'Not set'],
    ['id' => 'birthday', 'icon' => 'calendar', 'label' => 'Birthday',  'value' => $birthday !== '' ? $birthday : 'Not set'],
    ['id' => 'address',  'icon' => 'pin',      'label' => 'Address',   'value' => $address !== '' ? $address : 'Not set'],
];

$securityFields = [
    ['id' => 'email',    'icon' => 'mail',  'label' => 'Email Address', 'value' => $email],
    ['id' => 'phone',    'icon' => 'phone', 'label' => 'Phone number',  'value' => $phone !== '' ? $phone : 'Not set'],
    ['id' => 'password', 'icon' => 'lock',  'label' => 'Password',      'value' => $passwordMask, 'secret' => true, 'reveal_url' => $base . '/backend/api/reveal-password.php'],
];

// Sample answers. Change the wording to match your own system.
$faqs = [
    ['q' => 'How do I request a service?',
     'a' => 'Open Services, choose the service you need, add it to your Service Cart, then submit your request from the cart.'],
    ['q' => 'How can I check my request status?',
     'a' => 'Go to My Requests to see every request you sent and its current status.'],
    ['q' => 'Can I cancel my service request?',
     'a' => 'Yes. Open My Requests and cancel the request before a technician has been assigned.'],
    ['q' => 'How is the service cost determined?',
     'a' => 'The cost depends on the type of service and the unit being serviced. The final price is confirmed before work begins.'],
    ['q' => 'How do I contact CoolFreeze?',
     'a' => 'Use the Contact Support button below and our team will get back to you.'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Profile | CoolFreeze</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e($base . '/frontend/assets/css/profile.css') ?>">
</head>
<body>

<?php include $componentsPath . 'cf-sidebar.php'; ?>

<div class="cf-main">
    <?php include $componentsPath . 'cf-header.php'; ?>

    <main class="cf-content">
        <img class="cf-banner" src="<?= e($base . '/frontend/assets/img/ac-banner.svg') ?>" alt="">
        <p class="cf-eyebrow">Profile</p>
        <h1 class="cf-title">Your <span>Profile</span></h1>
        <p class="cf-subtitle">What would you like to do today?</p>

        <div class="cf-columns" id="profileColumns">

        <div class="cf-panel cf-panel--view">

            <!-- PROFILE INFORMATION -->
            <section class="cf-section">
                <?php
                $sectionTitle       = 'Profile Information';
                $sectionIcon        = 'user';
                $sectionButtonLabel = 'Edit Profile';
                $sectionButtonIcon  = 'edit';
                $sectionButtonTarget = 'editPanel';
                include $componentsPath . 'cf-section-header.php';

                include $componentsPath . 'cf-profile-card.php';
                ?>
                <div class="cf-card cf-card--fields">
                    <?php foreach ($profileFields as $field) { include $componentsPath . 'cf-profile-field.php'; } ?>
                </div>
            </section>

            <!-- SECURITY -->
            <section class="cf-section">
                <?php
                $sectionTitle = 'Security';
                $sectionIcon  = 'shield';
                include $componentsPath . 'cf-section-header.php';
                ?>
                <div class="cf-card cf-card--fields">
                    <?php foreach ($securityFields as $field) { include $componentsPath . 'cf-profile-field.php'; } ?>
                </div>
            </section>

            <!-- ACCOUNT -->
            <section class="cf-section">
                <?php
                $sectionTitle = 'Account';
                $sectionIcon  = 'settings';
                include $componentsPath . 'cf-section-header.php';
                ?>
                <div class="cf-card cf-card--fields">
                    <div class="cf-row">
                        <div>
                            <h3>Change password</h3>
                            <p>Update your account password</p>
                        </div>
                        <button type="button" class="cf-btn cf-btn--outline" data-open-modal="changePasswordModal">Change password</button>
                    </div>
                    <div class="cf-row">
                        <div>
                            <h3>Log out</h3>
                            <p>Sign out from your account</p>
                        </div>
                        <!-- Uses your existing logout endpoint. -->
                        <form method="post" action="<?= e($base . '/backend/api/logout.php') ?>">
                            <button type="submit" class="cf-btn cf-btn--danger">Log out</button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- FAQS -->
            <section class="cf-section">
                <?php
                $sectionTitle = 'FAQs';
                $sectionIcon  = 'help';
                include $componentsPath . 'cf-section-header.php';
                ?>
                <div class="cf-card cf-card--fields">
                    <?php foreach ($faqs as $i => $faq): ?>
                        <div class="cf-faq">
                            <button type="button" class="cf-faq__q" aria-expanded="false" aria-controls="faq<?= $i ?>">
                                <span><?= e($faq['q']) ?></span>
                                <?= icon('chevron', 20) ?>
                            </button>
                            <p class="cf-faq__a" id="faq<?= $i ?>" hidden><?= e($faq['a']) ?></p>
                        </div>
                    <?php endforeach; ?>
                    <div class="cf-faq__footer">
                        <a class="cf-btn cf-btn--primary" href="<?= e($supportUrl) ?>">Contact Support</a>
                    </div>
                </div>
            </section>

        </div><!-- /view panel -->

        <!-- EDIT PANEL (shown when Edit Profile is clicked) -->
        <form class="cf-panel cf-panel--edit" id="editPanel" data-action="<?= e($base . '/backend/api/update-profile.php') ?>" method="post" enctype="multipart/form-data" novalidate hidden>
            <div class="cf-edit__top">
                <button type="submit" class="cf-btn cf-btn--outline cf-btn--lg"><?= icon('edit') ?><span>Done</span></button>
            </div>

            <div class="cf-card cf-edit-avatar">
                <div class="cf-avatar cf-avatar--sm">
                    <img id="editAvatarPreview" src="<?= e($profileImage) ?>" alt="">
                    <span class="cf-avatar__edit"><?= icon('camera', 12) ?></span>
                </div>
                <label class="cf-btn cf-btn--outline cf-btn--block" for="editAvatarInput">Edit Profile</label>
                <input type="file" id="editAvatarInput" name="profile_image" accept="image/*" hidden>
            </div>

            <div class="cf-card cf-card--edit">
                <?php
                $editFields = [
                    ['id' => 'editUsername', 'name' => 'username',  'label' => 'User name',     'type' => 'text',  'value' => $username],
                    ['id' => 'editFullName', 'name' => 'full_name', 'label' => 'Full name',     'type' => 'text',  'value' => $fullName],
                    ['id' => 'editBirthday', 'name' => 'birthday',  'label' => 'Birthday',      'type' => 'date',  'value' => $birthdayIso],
                    ['id' => 'editAddress',  'name' => 'address',   'label' => 'Address',       'type' => 'area',  'value' => $address],
                    ['id' => 'editEmail',    'name' => 'email',     'label' => 'Email Address', 'type' => 'email', 'value' => $email],
                    ['id' => 'editPhone',    'name' => 'phone',     'label' => 'Phone number',  'type' => 'tel',   'value' => $phone],
                ];
                foreach ($editFields as $f): ?>
                    <div class="cf-edit-field">
                        <label for="<?= e($f['id']) ?>"><?= e($f['label']) ?></label>
                        <?php if ($f['type'] === 'area'): ?>
                            <textarea id="<?= e($f['id']) ?>" name="<?= e($f['name']) ?>" rows="2"><?= e($f['value']) ?></textarea>
                        <?php else: ?>
                            <input type="<?= e($f['type']) ?>" id="<?= e($f['id']) ?>" name="<?= e($f['name']) ?>" value="<?= e($f['value']) ?>">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="cf-form-error" id="editError" role="alert" hidden></p>
        </form>

        </div><!-- /cf-columns -->
    </main>
</div>

<?php
/* ---------- CHANGE PASSWORD MODAL ---------- */
$modalId    = 'changePasswordModal';
$modalTitle = 'Change password';
ob_start();
?>
<form id="changePasswordForm" data-action="<?= e($base . '/backend/api/change-password.php') ?>" method="post" novalidate>
    <?php
    $passwordInputs = [
        ['id' => 'currentPassword', 'name' => 'current_password', 'label' => 'Current password', 'autocomplete' => 'current-password'],
        ['id' => 'newPassword',     'name' => 'new_password',     'label' => 'New password',     'autocomplete' => 'new-password'],
        ['id' => 'confirmPassword', 'name' => 'confirm_password', 'label' => 'Confirm password', 'autocomplete' => 'new-password'],
    ];
    foreach ($passwordInputs as $input): ?>
        <div class="cf-form-group">
            <label for="<?= e($input['id']) ?>"><?= e($input['label']) ?></label>
            <div class="cf-input-wrap">
                <input type="password" id="<?= e($input['id']) ?>" name="<?= e($input['name']) ?>" autocomplete="<?= e($input['autocomplete']) ?>" required>
                <button type="button" class="cf-input-wrap__eye" data-toggle-input="<?= e($input['id']) ?>" aria-label="Show password"><?= icon('eye', 20) ?></button>
            </div>
        </div>
    <?php endforeach; ?>

    <p class="cf-form-error" id="passwordError" role="alert" hidden></p>

    <div class="cf-modal__actions">
        <button type="submit" class="cf-btn cf-btn--primary">Done</button>
    </div>
</form>
<?php
$modalBody = ob_get_clean();
include $componentsPath . 'cf-modal.php';
?>

<script src="<?= e($base . '/frontend/assets/js/profile.js') ?>"></script>
</body>
</html>
