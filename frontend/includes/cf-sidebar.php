<?php
/*
 * CoolFreeze profile-page sidebar (styled by profile.css, classes start with cf-).
 * Needs: $currentPage. Edit the 'url' values below to match your real pages.
 */
$base = rtrim(BASE_URL, '/');

$menu = $menu ?? [
    'Dashboard' => [
        ['key' => 'home',     'label' => 'Home',            'icon' => 'home',     'url' => $base . '/?page=home'],
    ],
    'Services' => [
        ['key' => 'services', 'label' => 'Services',        'icon' => 'services', 'url' => $base . '/?page=services'],
    ],
    'Cart' => [
        ['key' => 'cart',     'label' => 'Service Cart',    'icon' => 'cart',     'url' => $base . '/?page=cart'],
    ],
    'Service Requests' => [
        ['key' => 'requests', 'label' => 'My Requests',     'icon' => 'requests', 'url' => $base . '/?page=Myrequest'],
    ],
    'System' => [
        ['key' => 'profile',  'label' => 'Profile',         'icon' => 'user',     'url' => $base . '/?page=profile'],
        ['key' => 'faqs',     'label' => "Helps and FAQ's", 'icon' => 'file',     'url' => $base . '/?page=faqs'],
        ['key' => 'settings', 'label' => 'Settings',        'icon' => 'settings', 'url' => $base . '/?page=settings'],
    ],
];
?>
<aside class="cf-sidebar" id="sidebar" aria-label="Main navigation">
    <a class="cf-sidebar__logo" href="<?= e($base . '/?page=home') ?>">
        <img src="<?= e($base . '/frontend/assets/img/coolfreeze_horizontal_logo.svg') ?>" alt="CoolFreeze">
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

    <form class="cf-sidebar__logout" method="post" action="<?= e($base . '/backend/api/logout.php') ?>">
        <button type="submit"><?= icon('logout') ?><span>Logout</span></button>
    </form>
</aside>
<div class="cf-overlay" id="sidebarOverlay"></div>
