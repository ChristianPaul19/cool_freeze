<?php
// Save as: frontend/pages/main/faq_main.php
require_once dirname(__DIR__, 3) . '/backend/bootstrap.php';
require_once BACKEND_PATH . '/helpers/guard.php';

if (!function_exists('e')) {
    function e($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

$userName    = $_SESSION['username'] ?? 'Customer';   // used by topbar.php
$currentPage = 'faqs';                                // used by sidebar.php (matches the sidebar key)

$supportUrl = 'mailto:support@coolfreeze.com';
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CoolFreeze | Help &amp; FAQs</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>frontend/assets/css/main.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>frontend/assets/css/profile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
  <div class="layout">
    <!-- SIDEBAR -->
    <?php require FRONTEND_PATH . 'includes/sidebar.php' ?>

    <!-- MOBILE OVERLAY -->
    <div class="overlay" id="overlay"></div>

    <!-- MAIN CONTENT -->
    <div class="main">
      <!-- TOPBAR -->
      <?php require FRONTEND_PATH . 'includes/topbar.php' ?>

      <!-- PAGE CONTENT -->
      <main class="content">
        <!-- PAGE HEADER -->
        <div class="page-header">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="<?= BASE_URL ?>?page=home_main">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Help &amp; FAQs</span>
          </nav>

          <h1 class="page-title">Help &amp; <span>FAQs</span></h1>
          <p class="page-subtitle">Find quick answers to common questions</p>
        </div>

        <!-- Same wrappers as on the profile page, so the FAQ keeps its styling -->
        <div class="pf-columns">
          <div class="panel pf-view">
            <section class="pf-section">
              <div class="panel-head">
                <h2 class="panel-title">
                  <i class="fa-regular fa-circle-question"></i>
                  FAQs
                </h2>
              </div>

              <div class="pf-card pf-fields">
                <?php foreach ($faqs as $i => $faq): ?>
                <div class="pf-faq">
                  <button type="button" class="pf-faq-q" aria-expanded="false" aria-controls="faq<?= (int) $i ?>">
                    <span><?= e($faq['q']) ?></span>
                    <i class="fa-solid fa-chevron-down"></i>
                  </button>
                  <p class="pf-faq-a" id="faq<?= (int) $i ?>" hidden><?= e($faq['a']) ?></p>
                </div>
                <?php endforeach; ?>

                <div class="pf-faq-footer">
                  <a class="btn-primary" href="<?= e($supportUrl) ?>">Contact Support</a>
                </div>
              </div>
            </section>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
  /* ---------- Mobile sidebar ---------- */
  (function() {
    var menuButton = document.getElementById('menuButton');
    var sidebar = document.getElementById('sidebar');
    var overlay = document.getElementById('overlay');

    function setOpen(open) {
      sidebar.classList.toggle('open', open);
      overlay.classList.toggle('open', open);
      menuButton.setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    if (!menuButton || !sidebar || !overlay) {
      return;
    }

    menuButton.addEventListener('click', function() {
      setOpen(!sidebar.classList.contains('open'));
    });
    overlay.addEventListener('click', function() {
      setOpen(false);
    });
    window.addEventListener('resize', function() {
      if (!window.matchMedia('(max-width: 900px)').matches) {
        setOpen(false);
      }
    });
  })();

  /* ---------- FAQ accordion ---------- */
  (function() {
    document.querySelectorAll('.pf-faq-q').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var answer = document.getElementById(btn.getAttribute('aria-controls'));
        var open = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', open ? 'false' : 'true');
        answer.hidden = open;
      });
    });
  })();
  </script>
</body>

</html>