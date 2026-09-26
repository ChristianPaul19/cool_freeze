<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CoolFreeze | Service Request Form</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="request-form.css">

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

        <img
            class="imglogo"
            src="frontend/assets/img/coolfreeze_horizontal_logo.svg"
            alt="CoolFreeze"
        >

        <nav class="menu">

            <p class="menu-title">Dashboard</p>

            <a href="index.php" class="menu-link">
                <i class="fa-solid fa-house"></i>
                Home
            </a>

            <p class="menu-title">Services</p>

            <a href="service.php" class="menu-link">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                Services
            </a>

            <p class="menu-title">Cart</p>

            <a href="cart.php" class="menu-link active">
                <i class="fa-solid fa-cart-shopping"></i>
                Service Cart
            </a>

            <p class="menu-title">Service Requests</p>

            <a href="requests.php" class="menu-link">
                <i class="fa-solid fa-clipboard-list"></i>
                My Requests
            </a>

            <p class="menu-title">System</p>

            <a href="profile.php" class="menu-link">
                <i class="fa-solid fa-user"></i>
                Profile
            </a>

            <a href="faqs.php" class="menu-link">
                <i class="fa-solid fa-circle-question"></i>
                Helps and FAQ's
            </a>

            <a href="settings.php" class="menu-link">
                <i class="fa-solid fa-gear"></i>
                Settings
            </a>

        </nav>

        <form action="backend/api/logout.php" method="POST" class="logout-form">
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

            <form class="search" action="search.php" method="GET">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="q" placeholder="Search">
            </form>

            <div class="top-actions">

                <a href="notifications.php" class="icon-link" aria-label="Notifications">
                    <i class="fa-solid fa-bell"></i>
                </a>

                <a href="cart.php" class="icon-link" aria-label="Cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>

                <a href="profile.php" class="profile-link">
                    <i class="fa-solid fa-user"></i>
                    <span>Juan Tuy</span>
                </a>

            </div>

        </header>


        <!-- =================================================
             REQUEST FORM CONTENT
        ================================================== -->

        <main class="content">

            <div class="page-header">

                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <a href="index.php">Home</a>
                    <i class="fa-solid fa-chevron-right"></i>
                    <a href="cart.php">Service Cart</a>
                    <i class="fa-solid fa-chevron-right"></i>
                    <span>Service Request Form</span>
                </nav>

                <h1 class="page-title">
                    My <span>Service Request Form</span>
                </h1>

                <p class="page-subtitle">
                    Review the details below and submit your request &mdash;
                    our team will confirm the schedule shortly
                </p>

            </div>

            <h2 class="section-heading">Review Your Service Request</h2>

            <!-- STEPPER -->

            <div class="stepper">

                <div class="step done" data-step="1">
                    <div class="step-circle"><i class="fa-solid fa-check"></i></div>
                    <div class="step-label">Service Details</div>
                </div>

                <div class="step-line done"></div>

                <div class="step done" data-step="2">
                    <div class="step-circle"><i class="fa-solid fa-check"></i></div>
                    <div class="step-label">Schedule &amp; Location</div>
                </div>

                <div class="step-line"></div>

                <div class="step active" data-step="3">
                    <div class="step-circle">3</div>
                    <div class="step-label">Submit</div>
                </div>

            </div>

            <!-- REVIEW GRID -->

            <section class="review-grid">

                <!-- SERVICE DETAILS -->

                <div class="panel review-panel">

                    <div class="panel-head">
                        <h3 class="panel-title"><i class="fa-solid fa-screwdriver-wrench"></i> Service Details</h3>
                        <a href="#" class="edit-link"><i class="fa-solid fa-pen"></i> Edit</a>
                    </div>

                    <div class="service-line">
                        <div class="service-line-icon"><i class="fa-solid fa-wind"></i></div>
                        <div class="service-line-info">
                            <strong>AC Cleaning</strong>
                            <span>Split type</span>
                        </div>
                        <div class="service-line-price">&#8369;900</div>
                    </div>

                    <div class="service-line">
                        <div class="service-line-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                        <div class="service-line-info">
                            <strong>AC Repair</strong>
                            <span>Split type</span>
                        </div>
                        <div class="service-line-price">&#8369;1,000</div>
                    </div>

                    <div class="review-row total">
                        <span>Estimated Total</span>
                        <strong>&#8369;1,900</strong>
                    </div>

                </div>


                <!-- SCHEDULE -->

                <div class="panel review-panel">

                    <div class="panel-head">
                        <h3 class="panel-title"><i class="fa-solid fa-calendar-days"></i> Schedule</h3>
                        <a href="#" class="edit-link"><i class="fa-solid fa-pen"></i> Edit</a>
                    </div>

                    <div class="detail-block">
                        <span>Preferred Date</span>
                        <strong>September 12, 2026</strong>
                    </div>

                    <div class="detail-block">
                        <span>Preferred Time</span>
                        <strong>6:00 AM &ndash; 9:00 AM</strong>
                    </div>

                    <div class="detail-block">
                        <span><i class="fa-solid fa-location-dot"></i> Service Address</span>
                        <strong>123 Example St, Makati City, Metro Manila, Philippines</strong>
                    </div>

                </div>


                <!-- NOTE + CONTACT -->

                <div class="review-side">

                    <div class="panel review-panel">

                        <div class="panel-head">
                            <h3 class="panel-title"><i class="fa-solid fa-note-sticky"></i> Note</h3>
                            <a href="#" class="edit-link"><i class="fa-solid fa-pen"></i> Edit</a>
                        </div>

                        <p class="note-text">
                            Description/Notes: please clean it and check if
                            there are any issues with the unit. Thank you!
                        </p>

                    </div>

                    <div class="panel review-panel">

                        <div class="panel-head">
                            <h3 class="panel-title"><i class="fa-solid fa-address-card"></i> Contact</h3>
                            <a href="#" class="edit-link"><i class="fa-solid fa-pen"></i> Edit</a>
                        </div>

                        <p class="contact-name">Juan Tuy</p>
                        <p class="contact-phone">0999-999-9999</p>

                    </div>

                </div>

            </section>

            <div class="submit-footer">
                <button type="button" class="btn-primary" id="btnSubmitRequest">
                    Submit Request
                </button>
            </div>

        </main>

    </div>

</div>


<!-- =========================================================
     CONFIRMATION MODAL
========================================================= -->

<div class="modal-overlay" id="confirmModalOverlay">

    <div class="modal confirm-modal" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">

        <button type="button" class="modal-close" id="confirmCloseBtn" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="confirm-body">

            <div class="confirm-icon">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>

            <h2 class="confirm-title" id="confirmTitle">Service Request Submitted!</h2>

            <p class="confirm-text">
                Your service request has been successfully submitted.
                You will receive an update once it's been reviewed by our team.
            </p>

            <div class="confirm-summary">

                <div class="confirm-summary-item">
                    <span>Request Number</span>
                    <strong>SR-00000152</strong>
                </div>

                <div class="confirm-summary-divider"></div>

                <div class="confirm-summary-item">
                    <span>Estimated Total</span>
                    <strong>&#8369;1,800</strong>
                </div>

            </div>

            <div class="confirm-actions">
                <a href="requests.php" class="btn-primary">View My Request</a>
                <a href="index.php" class="btn-outline">Back to Home</a>
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
        menuButton.setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    if (menuButton && sidebar && overlay) {

        menuButton.addEventListener('click', function () {
            setOpen(!sidebar.classList.contains('open'));
        });

        overlay.addEventListener('click', function () {
            setOpen(false);
        });

        sidebar.querySelectorAll('.menu-link').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.matchMedia('(max-width: 900px)').matches) {
                    setOpen(false);
                }
            });
        });

        window.addEventListener('resize', function () {
            if (!window.matchMedia('(max-width: 900px)').matches) {
                setOpen(false);
            }
        });

    }

})();


/* =========================================================
   SUBMIT + CONFIRMATION MODAL
========================================================= */

(function () {

    var overlay = document.getElementById('confirmModalOverlay');
    var btnSubmit = document.getElementById('btnSubmitRequest');
    var btnClose = document.getElementById('confirmCloseBtn');

    function openConfirm() {
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
        btnClose.focus();
    }

    function closeConfirm() {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    btnSubmit.addEventListener('click', openConfirm);
    btnClose.addEventListener('click', closeConfirm);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) {
            closeConfirm();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('open')) {
            closeConfirm();
        }
    });

})();

</script>

</body>
</html>