<?php

require_once dirname(__DIR__, 3) . '/backend/bootstrap.php';

$userName = $_SESSION['username'] ?? 'Customer';

$currentPage = 'services';

// Sidebar menu
$menu = [
    [
        'title' => 'Services',
        'items' => [
            ['label' => 'Services', 'icon' => 'fa-screwdriver-wrench', 'link' => 'service.php'],
        ]
    ],
    [
        'title' => 'Cart',
        'items' => [
            ['label' => 'Service Cart', 'icon' => 'fa-cart-shopping', 'link' => 'cart.php'],
        ]
    ],
    [
        'title' => 'Service Requests',
        'items' => [
            ['label' => 'My Requests', 'icon' => 'fa-clipboard-list', 'link' => 'requests.php'],
        ]
    ],
    [
        'title' => 'System',
        'items' => [
            ['label' => 'Profile', 'icon' => 'fa-user', 'link' => 'profile.php'],
            ['label' => "Helps and FAQ's", 'icon' => 'fa-circle-question', 'link' => 'faqs.php'],
            ['label' => 'Settings', 'icon' => 'fa-gear', 'link' => 'settings.php'],
        ]
    ],
];

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CoolFreeze | Services</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="<?= BASE_URL ?>frontend/assets/css/servicesmain.css">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>

<body>

<div class="layout">

    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <aside class="sidebar" id="sidebar">
        
        <img class="imglogo"
                        src="<?= BASE_URL ?>frontend/assets/img/coolfreeze_horizontal_logo.svg"
                        alt="Bright living room with a grey sofa"
                        class="card-img"
                    >
        <nav class="menu">

            <!-- DASHBOARD -->

            <p class="menu-title">Dashboard</p>

            <a
                href="index.php"
                class="menu-link"
            >
                <i class="fa-solid fa-house"></i>
                Home
            </a>


            <!-- OTHER MENU SECTIONS -->

            <?php foreach ($menu as $section): ?>

                <p class="menu-title">
                    <?= e($section['title']) ?>
                </p>

                <?php foreach ($section['items'] as $item): ?>

                    <a
                        href="<?= e($item['link']) ?>"
                        class="menu-link <?= $item['link'] === 'service.php' ? 'active' : '' ?>"
                    >

                        <i class="fa-solid <?= e($item['icon']) ?>"></i>

                        <?= e($item['label']) ?>

                    </a>

                <?php endforeach; ?>

            <?php endforeach; ?>

        </nav>


        <!-- LOGOUT -->

        <form
            action="<?= BASE_URL ?>backend/api/logout.php"
            method="POST"
            class="logout-form"
        >

            <button type="submit" class="logout">

                <i class="fa-solid fa-right-from-bracket"></i>

                Log out

            </button>

        </form>

    </aside>


    <!-- =====================================================
         MOBILE OVERLAY
    ====================================================== -->

    <div class="overlay" id="overlay"></div>


    <!-- =====================================================
         MAIN
    ====================================================== -->

    <div class="main">


        <!-- =================================================
             TOPBAR
        ================================================== -->

        <header class="topbar">

            <button
                type="button"
                class="menu-button"
                id="menuButton"
                aria-label="Open menu"
                aria-expanded="false"
            >

                <i class="fa-solid fa-bars"></i>

            </button>


            <!-- SEARCH -->

            <form
                class="search"
                action="search.php"
                method="GET"
            >

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="search"
                    name="q"
                    placeholder="Search"
                >

            </form>


            <!-- TOP ACTIONS -->

            <div class="top-actions">

                <a
                    href="notifications.php"
                    class="icon-link"
                    aria-label="Notifications"
                >

                    <i class="fa-solid fa-bell"></i>

                </a>


                <a
                    href="cart.php"
                    class="icon-link"
                    aria-label="Cart"
                >

                    <i class="fa-solid fa-cart-shopping"></i>

                </a>


                <a
                    href="profile.php"
                    class="profile-link"
                >

                    <i class="fa-solid fa-user"></i>

                    <span>
                        <?= e($userName) ?>
                    </span>

                </a>

            </div>

        </header>


        <!-- =================================================
             SERVICES PAGE CONTENT
        ================================================== -->

        <main class="content">


            <!-- PAGE HEADER -->

            <div class="page-header">

                <nav
                    class="breadcrumb"
                    aria-label="Breadcrumb"
                >

                    <a href="index.php">
                        Home
                    </a>

                    <i class="fa-solid fa-chevron-right"></i>

                    <span>
                        Services
                    </span>

                </nav>


                <h1 class="page-title">

                    Our
                    <span>Services</span>

                </h1>


                <p class="page-subtitle">

                    Professional air conditioning services to keep
                    your home or business cool and comfortable

                </p>

            </div>


            <!-- =================================================
                 SERVICES GRID
            ================================================== -->

            <section class="services-grid">


                <!-- AC CLEANING -->

                <article class="card">

                    <img
                        src="<?= BASE_URL ?>frontend/assets/img/couch.svg"
                        alt="Bright living room with a grey sofa"
                        class="card-img"
                    >

                    <div class="card-body">

                        <h2>
                            AC Cleaning
                        </h2>

                        <p class="desc">
                            Keep your aircon clean and efficient with
                            our professional cleaning service
                        </p>

                        <p class="includes">
                            Services include:
                        </p>

                        <ul class="checklist">

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                General cleaning
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Filter cleaning
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Unit inspection
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Basic performance check
                            </li>

                        </ul>


                        <div class="card-footer">

                            <div class="price">

                                <i class="fa-solid fa-tag"></i>

                                <div>

                                    <small>
                                        Starting from
                                    </small>

                                    <strong>
                                        ₱ 800
                                    </strong>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="btn-request"
                            >

                                Request Service

                                <i class="fa-solid fa-chevron-right"></i>

                            </button>

                        </div>

                    </div>

                </article>


                <!-- AC REPAIR -->

                <article class="card">

                    <img
                        src="<?= BASE_URL ?>frontend/assets/img/couch.svg"
                        alt="Bright living room with a grey sofa"
                        class="card-img"
                    >

                    <div class="card-body">

                        <h2>
                            AC Repair
                        </h2>

                        <p class="desc">
                            We fix aircon problems quickly and efficiently
                            to get your unit back in condition
                        </p>

                        <p class="includes">
                            Services include:
                        </p>

                        <ul class="checklist">

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Diagnose the issue
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Repair faulty parts
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Test functionality
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Provide service report
                            </li>

                        </ul>


                        <div class="card-footer">

                            <div class="price">

                                <i class="fa-solid fa-tag"></i>

                                <div>

                                    <small>
                                        Starting from
                                    </small>

                                    <strong>
                                        ₱ 1000
                                    </strong>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="btn-request"
                            >

                                Request Service

                                <i class="fa-solid fa-chevron-right"></i>

                            </button>

                        </div>

                    </div>

                </article>


                <!-- AC MAINTENANCE -->

                <article class="card">

                    <img
                        src="<?= BASE_URL ?>frontend/assets/img/couch.svg"
                        alt="Bright living room with a grey sofa"
                        class="card-img"
                    >

                    <div class="card-body">

                        <h2>
                            AC Maintenance
                        </h2>

                        <p class="desc">
                            Prevent problems before they happen with
                            our scheduled maintenance service
                        </p>

                        <p class="includes">
                            Services include:
                        </p>

                        <ul class="checklist">

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Full system check
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Clean and inspect components
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Optimize performance
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Extend unit lifespan
                            </li>

                        </ul>


                        <div class="card-footer">

                            <div class="price">

                                <i class="fa-solid fa-tag"></i>

                                <div>

                                    <small>
                                        Starting from
                                    </small>

                                    <strong>
                                        ₱ 1200
                                    </strong>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="btn-request"
                            >

                                Request Service

                                <i class="fa-solid fa-chevron-right"></i>

                            </button>

                        </div>

                    </div>

                </article>


                <!-- AC INSTALLATION -->

                <article class="card">

                    <img
                        src="<?= BASE_URL ?>frontend/assets/img/couch.svg"
                        alt="Bright living room with a grey sofa"
                        class="card-img"
                    >

                    <div class="card-body">

                        <h2>
                            AC Installation
                        </h2>

                        <p class="desc">
                            Professional installation for your new
                            aircon unit
                        </p>

                        <p class="includes">
                            Services include:
                        </p>

                        <ul class="checklist">

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Site inspection
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Proper unit installation
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                System testing
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Warranty and support
                            </li>

                        </ul>


                        <div class="card-footer">

                            <div class="price">

                                <i class="fa-solid fa-tag"></i>

                                <div>

                                    <small>
                                        Starting from
                                    </small>

                                    <strong>
                                        ₱ 800
                                    </strong>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="btn-request"
                            >

                                Request Service

                                <i class="fa-solid fa-chevron-right"></i>

                            </button>

                        </div>

                    </div>

                </article>


                <!-- PARTS REPLACEMENT -->

                <article class="card">

                    <img
                        src="<?= BASE_URL ?>frontend/assets/img/couch.svg"
                        alt="Bright living room with a grey sofa"
                        class="card-img"
                    >

                    <div class="card-body">

                        <h2>
                            Parts Replacement
                        </h2>

                        <p class="desc">
                            Replace damaged parts with genuine and
                            high-quality components
                        </p>

                        <p class="includes">
                            Services include:
                        </p>

                        <ul class="checklist">

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Genuine parts
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Professional installation
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                System testing
                            </li>

                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                Warranty and replaced parts
                            </li>

                        </ul>


                        <div class="card-footer">

                            <div class="price">

                                <i class="fa-solid fa-tag"></i>

                                <div>

                                    <small>
                                        Starting from
                                    </small>

                                    <strong>
                                        ₱ 800
                                    </strong>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="btn-request"
                            >

                                Request Service

                                <i class="fa-solid fa-chevron-right"></i>

                            </button>

                        </div>

                    </div>

                </article>

            </section>

        </main>

    </div>

</div>


<!-- =========================================================
     REQUEST SERVICE MODAL
========================================================= -->

<div
    class="modal-overlay"
    id="serviceModalOverlay"
>

    <div
        class="modal"
        id="serviceModal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modalTitle"
    >

        <div class="modal-scroll">


            <button
                type="button"
                class="modal-close"
                id="modalCloseBtn"
                aria-label="Close"
            >

                <i class="fa-solid fa-xmark"></i>

            </button>


            <button
                type="button"
                class="modal-back"
                id="modalBackBtn"
            >

                <i class="fa-solid fa-arrow-left"></i>

                Back to Services

            </button>


            <h2
                class="modal-title"
                id="modalTitle"
            >

                Request
                <span>Service</span>

            </h2>


            <p class="modal-subtitle">

                Fill in the details below to request
                your selected service

            </p>


            <!-- STEPPER -->

            <div class="stepper">

                <div
                    class="step active"
                    data-step="1"
                >

                    <div class="step-circle">
                        1
                    </div>

                    <div class="step-label">
                        Service Details
                    </div>

                </div>


                <div class="step-line"></div>


                <div
                    class="step"
                    data-step="2"
                >

                    <div class="step-circle">
                        2
                    </div>

                    <div class="step-label">
                        Schedule &amp; Location
                    </div>

                </div>


                <div class="step-line"></div>


                <div
                    class="step"
                    data-step="3"
                >

                    <div class="step-circle">
                        3
                    </div>

                    <div class="step-label">
                        Submit
                    </div>

                </div>

            </div>


            <!-- STEP 1 -->

            <div
                class="step-panel active"
                data-panel="1"
            >

                <div class="panel-grid">


                    <div class="form-col">

                        <h3 class="form-heading">
                            Service Information
                        </h3>


                        <label class="field">

                            <span>
                                Service Type
                            </span>

                            <select id="serviceTypeSelect">

                                <option>
                                    Services Type
                                </option>

                                <option>
                                    Residential
                                </option>

                                <option>
                                    Commercial
                                </option>

                            </select>

                        </label>


                        <label class="field">

                            <span>
                                AC Unit Type
                            </span>

                            <select id="acUnitTypeSelect">

                                <option>
                                    Split Type
                                </option>

                                <option>
                                    Window Type
                                </option>

                                <option>
                                    Cassette Type
                                </option>

                                <option>
                                    Portable Type
                                </option>

                            </select>

                        </label>


                        <div class="field">

                            <span>
                                Number of Units
                            </span>

                            <div class="qty">

                                <button
                                    type="button"
                                    class="qty-btn"
                                    data-action="dec"
                                    aria-label="Decrease"
                                >
                                    &minus;
                                </button>

                                <input
                                    type="text"
                                    class="qty-input"
                                    id="qtyInput"
                                    value="1"
                                    inputmode="numeric"
                                    readonly
                                >

                                <button
                                    type="button"
                                    class="qty-btn"
                                    data-action="inc"
                                    aria-label="Increase"
                                >
                                    &plus;
                                </button>

                            </div>

                        </div>

                    </div>


                    <div class="info-col">

                        <div class="info-art">

                            <img
                                class="modalpic"
                                src="<?= BASE_URL ?>frontend/assets/img/aircon.svg"
                                alt=""
                            >

                        </div>


                        <div class="includes-box">

                            <p
                                class="includes-title"
                                id="includesTitle"
                            >
                                Service Includes:
                            </p>

                            <ul
                                class="includes-list"
                                id="includesList"
                            ></ul>

                        </div>

                    </div>

                </div>

            </div>


            <!-- STEP 3 -->

            <div
                class="step-panel"
                data-panel="3"
            >

                <div
                    class="review-box"
                    id="reviewBox"
                ></div>

            </div>

        </div>


        <!-- MODAL FOOTER -->

        <div class="modal-footer">

            <button
                type="button"
                class="btn-outline"
                id="btnStepBack"
                style="display:none;"
            >
                Previous
            </button>


            <div class="footer-actions">

                <button
                    type="button"
                    class="btn-outline"
                    id="btnScheduleService"
                >
                    Schedule Service
                </button>


                <button
                    type="button"
                    class="btn-primary"
                    id="btnAddCart"
                >
                    Add to Service Cart
                </button>


                <button
                    type="button"
                    class="btn-primary"
                    id="btnStepNext"
                    style="display:none;"
                >
                    Continue
                </button>


                <button
                    type="button"
                    class="btn-primary"
                    id="btnSubmitRequest"
                    style="display:none;"
                >
                    Confirm &amp; Submit Request
                </button>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

(function () {

    var menuButton = document.getElementById('menuButton');
    var sidebar = document.getElementById('sidebar');
    var overlay = document.getElementById('overlay');


    function setOpen(open) {

        sidebar.classList.toggle('open', open);

        overlay.classList.toggle('open', open);

        menuButton.setAttribute(
            'aria-expanded',
            open ? 'true' : 'false'
        );

    }


    if (menuButton && sidebar && overlay) {

        menuButton.addEventListener('click', function () {

            setOpen(
                !sidebar.classList.contains('open')
            );

        });


        overlay.addEventListener('click', function () {

            setOpen(false);

        });


        sidebar
            .querySelectorAll('.menu-link')
            .forEach(function (link) {

                link.addEventListener('click', function () {

                    if (
                        window.matchMedia(
                            '(max-width: 900px)'
                        ).matches
                    ) {

                        setOpen(false);

                    }

                });

            });


        window.addEventListener('resize', function () {

            if (
                !window.matchMedia(
                    '(max-width: 900px)'
                ).matches
            ) {

                setOpen(false);

            }

        });

    }

})();



/* =========================================================
   REQUEST SERVICE MODAL
========================================================= */

(function () {

    var overlay =
        document.getElementById('serviceModalOverlay');

    var modal =
        document.getElementById('serviceModal');

    var modalTitle =
        document.getElementById('modalTitle');

    var includesTitle =
        document.getElementById('includesTitle');

    var includesList =
        document.getElementById('includesList');

    var reviewBox =
        document.getElementById('reviewBox');

    var qtyInput =
        document.getElementById('qtyInput');

    var acUnitTypeSelect =
        document.getElementById('acUnitTypeSelect');


    var btnStepBack =
        document.getElementById('btnStepBack');

    var btnScheduleService =
        document.getElementById('btnScheduleService');

    var btnAddCart =
        document.getElementById('btnAddCart');

    var btnStepNext =
        document.getElementById('btnStepNext');

    var btnSubmitRequest =
        document.getElementById('btnSubmitRequest');


    var currentStep = 1;

    var currentService = {
        name: '',
        price: '',
        includes: []
    };

    var lastFocused = null;


    function openModal(card) {

        var name =
            card.querySelector('h2')
                .textContent
                .trim();


        var priceEl =
            card.querySelector('.price strong');


        var price =
            priceEl
                ? priceEl.textContent.trim()
                : '';


        var items =
            Array.prototype.map.call(
                card.querySelectorAll(
                    '.checklist li'
                ),
                function (li) {

                    return li.textContent.trim();

                }
            );


        currentService = {
            name: name,
            price: price,
            includes: items
        };


        modalTitle.innerHTML =
            'Request <span>' +
            name +
            '</span>';


        includesTitle.textContent =
            name + ' Includes:';


        includesList.innerHTML =
            items.map(function (item) {

                return (
                    '<li>' +
                    '<i class="fa-solid fa-circle-check"></i>' +
                    item +
                    '</li>'
                );

            }).join('');


        lastFocused =
            document.activeElement;


        goToStep(1);


        overlay.classList.add('open');

        document.body.style.overflow =
            'hidden';


        document
            .getElementById('modalCloseBtn')
            .focus();

    }


    function closeModal() {

        overlay.classList.remove('open');

        document.body.style.overflow = '';


        if (lastFocused) {

            lastFocused.focus();

        }

    }


    function goToStep(n) {

        currentStep = n;


        document
            .querySelectorAll('.step')
            .forEach(function (s) {

                var step =
                    parseInt(
                        s.getAttribute('data-step'),
                        10
                    );


                s.classList.toggle(
                    'active',
                    step === n
                );


                s.classList.toggle(
                    'done',
                    step < n
                );

            });


        document
            .querySelectorAll('.step-line')
            .forEach(function (line, idx) {

                line.classList.toggle(
                    'done',
                    idx + 1 < n
                );

            });


        document
            .querySelectorAll('.step-panel')
            .forEach(function (p) {

                p.classList.toggle(
                    'active',
                    parseInt(
                        p.getAttribute('data-panel'),
                        10
                    ) === n
                );

            });


        modal
            .querySelector('.modal-footer')
            .classList.toggle(
                'has-back',
                n !== 1
            );


        btnStepBack.style.display =
            n === 1
                ? 'none'
                : 'inline-flex';


        btnScheduleService.style.display =
            n === 1
                ? 'inline-flex'
                : 'none';


        btnAddCart.style.display =
            n === 1
                ? 'inline-flex'
                : 'none';


        btnStepNext.style.display =
            n === 2
                ? 'inline-flex'
                : 'none';


        btnSubmitRequest.style.display =
            n === 3
                ? 'inline-flex'
                : 'none';


        if (n === 3) {

            renderReview();

        }


        modal
            .querySelector('.modal-scroll')
            .scrollTop = 0;

    }


    function renderReview() {

        var unitType =
            acUnitTypeSelect.value;

        var qty =
            qtyInput.value;


        reviewBox.innerHTML =

            '<div class="review-row">' +
                '<span>Service</span>' +
                '<strong>' +
                    currentService.name +
                '</strong>' +
            '</div>' +

            '<div class="review-row">' +
                '<span>AC Unit Type</span>' +
                '<strong>' +
                    unitType +
                '</strong>' +
            '</div>' +

            '<div class="review-row">' +
                '<span>Number of Units</span>' +
                '<strong>' +
                    qty +
                '</strong>' +
            '</div>' +

            '<div class="review-row total">' +
                '<span>Starting from</span>' +
                '<strong>' +
                    currentService.price +
                '</strong>' +
            '</div>';

    }


    document
        .querySelectorAll('.btn-request')
        .forEach(function (btn) {

            btn.addEventListener(
                'click',
                function () {

                    var card =
                        btn.closest('.card');

                    if (card) {

                        openModal(card);

                    }

                }
            );

        });


    document
        .getElementById('modalCloseBtn')
        .addEventListener(
            'click',
            closeModal
        );


    document
        .getElementById('modalBackBtn')
        .addEventListener(
            'click',
            closeModal
        );


    overlay.addEventListener(
        'click',
        function (e) {

            if (e.target === overlay) {

                closeModal();

            }

        }
    );


    document.addEventListener(
        'keydown',
        function (e) {

            if (
                e.key === 'Escape' &&
                overlay.classList.contains('open')
            ) {

                closeModal();

            }

        }
    );


    document
        .querySelectorAll('.qty-btn')
        .forEach(function (b) {

            b.addEventListener(
                'click',
                function () {

                    var val =
                        parseInt(
                            qtyInput.value,
                            10
                        ) || 1;


                    if (
                        b.getAttribute(
                            'data-action'
                        ) === 'inc'
                    ) {

                        val += 1;

                    } else {

                        val =
                            Math.max(
                                1,
                                val - 1
                            );

                    }


                    qtyInput.value = val;

                }
            );

        });


    btnScheduleService.addEventListener(
        'click',
        function () {

            goToStep(2);

        }
    );


    btnStepBack.addEventListener(
        'click',
        function () {

            goToStep(
                Math.max(
                    1,
                    currentStep - 1
                )
            );

        }
    );


    btnStepNext.addEventListener(
        'click',
        function () {

            goToStep(3);

        }
    );


    btnAddCart.addEventListener(
        'click',
        function () {

            closeModal();

            alert(
                currentService.name +
                ' added to your Service Cart.'
            );

        }
    );


    btnSubmitRequest.addEventListener(
        'click',
        function () {

            closeModal();

            alert(
                'Your request for ' +
                currentService.name +
                ' has been submitted.'
            );

        }
    );

})();

</script>

</body>
</html>