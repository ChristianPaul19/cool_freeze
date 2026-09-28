<?php
/*
 * Top bar: hamburger (mobile), search, notification, cart, user.
 * Needs: $userName
 */
$base = rtrim(BASE_URL, '/');
?>
<header class="cf-header">
    <button type="button" class="cf-header__menu" id="sidebarToggle" aria-label="Open menu" aria-controls="sidebar">
        <?= icon('menu') ?>
    </button>

    <div class="cf-search">
        <?= icon('search', 20) ?>
        <input type="search" placeholder="Search" aria-label="Search">
    </div>

    <div class="cf-header__actions">
        <button type="button" class="cf-header__icon cf-header__icon--dot" aria-label="Notifications"><?= icon('bell', 20) ?></button>
        <a class="cf-header__icon" href="<?= e($base . '/?page=cart') ?>" aria-label="Service cart"><?= icon('cart', 20) ?></a>
        <a class="cf-header__user" href="<?= e($base . '/?page=profile') ?>">
            <?= icon('user', 20) ?>
            <span data-profile="username"><?= e($userName) ?></span>
        </a>
    </div>
</header>
