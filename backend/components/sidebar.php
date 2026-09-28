<?php
/*
 * Sidebar (desktop) + off-canvas menu (mobile) + dark overlay.
 * Needs: $currentPage  (example: 'profile')
 * Optional: $menu. If the page does not define it, the default below is used.
 * TODO: change the file names in $pagesUrl to match your real pages.
 */
$pagesUrl = BASE_URL . '/frontend/pages/customer/';

$menu = $menu ?? [
    'Dashboard' => [
        ['key' => 'home', 'label' => 'Home', 'icon' => 'home', 'url' => $pagesUrl . 'home.php'],
    ],
    'Services' => [
        ['key' => 'services', 'label' => 'Services', 'icon' => 'services', 'url' => $pagesUrl . 'services.php'],
    ],
    'Cart' => [
        ['key' => 'cart', 'label' => 'Service Cart', 'icon' => 'cart', 'url' => $pagesUrl . 'cart.php'],
    ],
    'Service Requests' => [
        ['key' => 'requests', 'label' => 'My Requests', 'icon' => 'requests', 'url' => $pagesUrl . 'requests.php'],
    ],
    'System' => [
        ['key' => 'profile', 'label' => 'Profile', 'icon' => 'user', 'url' => $pagesUrl . 'profile.php'],
        ['key' => 'help', 'label' => "Helps and FAQ's", 'icon' => 'file', 'url' => $pagesUrl . 'help.php'],
        ['key' => 'settings', 'label' => 'Settings', 'icon' => 'settings', 'url' => $pagesUrl . 'settings.php'],
    ],
];
?>
<aside class="cf-sidebar" id="sidebar" aria-label="Main navigation">
    <a class="cf-sidebar__logo" href="<?= e($pagesUrl . 'home.php') ?>">
        <img src="<?= e(BASE_URL . '/frontend/assets/images/coolfreeze_horizontal_logo.svg') ?>" alt="CoolFreeze">
    </a>

    <nav class="cf-sidebar__nav">
        <?php foreach ($menu as $sectionName => $items): ?>
            <div class="cf-sidebar__section">
                <p class="cf-sidebar__label"><?= e($sectionName) ?></p>
                <ul class="cf-sidebar__list">
                    <?php foreach ($items as $item): ?>
                        <li>
                            <a class="cf-sidebar__link<?= $currentPage === $item['key'] ? ' is-active' : '' ?>"
                               href="<?= e($item['url']) ?>"
                               <?= $currentPage === $item['key'] ? 'aria-current="page"' : '' ?>>
                                <?= icon($item['icon']) ?>
                                <span><?= e($item['label']) ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </nav>

    <!-- Uses your existing logout endpoint. -->
    <form class="cf-sidebar__logout" method="post" action="<?= e(BASE_URL . '/backend/api/logout.php') ?>">
        <button type="submit"><?= icon('logout') ?><span>Logout</span></button>
    </form>
</aside>
<div class="cf-overlay" id="sidebarOverlay"></div>
