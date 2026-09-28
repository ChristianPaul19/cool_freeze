<?php
/*
 * Avatar + name + role.
 * Needs: $username, $profileImage
 */
?>
<div class="cf-card cf-profile-card">
    <div class="cf-avatar">
        <img id="profileAvatar" src="<?= e($profileImage) ?>" alt="Profile picture of <?= e($username) ?>">
        <button type="button" class="cf-avatar__edit" data-open-modal="editProfileModal" aria-label="Change profile picture">
            <?= icon('camera', 18) ?>
        </button>
    </div>
    <div class="cf-profile-card__text">
        <h3 data-profile="username"><?= e($username) ?></h3>
        <p>Client</p>
    </div>
</div>
