<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Services | CoolFreeze</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Sora:wght@500;600;700&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="/cool_freeze/frontend/assets/css/servicesmain.css">
</head>
<body>

  <aside class="sidebar">
    <div class="sidebar-top">
      <a href="#" class="logo">
        <img class="logo-img" src="/cool_freeze/frontend/assets/img/CoolFreeze_Logo.svg" alt="CoolFreeze">
      </a>

      <button type="button" class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="sidebarNav">
        <i class="bi bi-list"></i>
      </button>
    </div>

    <nav class="nav" id="sidebarNav" aria-label="Main navigation">
      <a href="#" class="nav-link">
        <i class="bi bi-house"></i> Home
      </a>

      <p class="nav-heading">Services</p>
      <a href="#" class="nav-link active" aria-current="page">
        <i class="bi bi-wind"></i> Services
      </a>

      <p class="nav-heading">Cart</p>
      <a href="#" class="nav-link">
        <i class="bi bi-cart"></i> Service Cart
      </a>

      <p class="nav-heading">Service Requests</p>
      <a href="#" class="nav-link">
        <i class="bi bi-clipboard-check"></i> My Requests
      </a>

      <p class="nav-heading">System</p>
      <a href="#" class="nav-link">
        <i class="bi bi-person"></i> Profile
      </a>
      <a href="#" class="nav-link">
        <i class="bi bi-file-earmark"></i> Helps and FAQ's
      </a>
      <a href="#" class="nav-link">
        <i class="bi bi-gear"></i> Settings
      </a>

      <a href="<?= BASE_URL ?>?page=landing" class="logout logout-mobile">
        <i class="bi bi-box-arrow-left"></i> Logout
      </a>
    </nav>

    <a href="<?= BASE_URL ?>?page=landing" class="logout logout-desktop">
      <i class="bi bi-box-arrow-left"></i> Logout
    </a>
  </aside>

  <!-- ========== MAIN ========== -->
  <div class="main">

    <!-- Top bar -->
    <header class="topbar">
      <label class="search">
        <i class="bi bi-search"></i>
        <input type="search" placeholder="Search" aria-label="Search">
      </label>

      <div class="topbar-actions">
        <button class="icon-btn has-dot" aria-label="Notifications">
          <i class="bi bi-bell"></i>
        </button>
        <button class="icon-btn" aria-label="Cart">
          <i class="bi bi-cart"></i>
        </button>
        <a href="#" class="user">
          <i class="bi bi-person"></i>
          <span>JuanTzy</span>
        </a>
      </div>
    </header>

    <!-- Page content -->
    <main class="content">
      <div class="page-header">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="#">Home</a>
            <i class="bi bi-chevron-right"></i>
            <span>Services</span>
        </nav>

        <h1 class="page-title">Our <span>Services</span></h1>
        <p class="page-subtitle">
            Professional air conditioning services to keep your home or business cool and comfortable
        </p>
      </div>

      <section class="services-grid">

        <!-- AC Cleaning -->
        <article class="card">
          <img src="/cool_freeze/frontend/assets/img/couch.svg" alt="Bright living room with a grey sofa" class="card-img">
          <div class="card-body">
            <h2>AC Cleaning</h2>
            <p class="desc">Keep your aircon clean and efficient with our professional cleaning service</p>
            <p class="includes">Services include:</p>
            <ul class="checklist">
              <li><i class="bi bi-check-circle"></i> General cleaning</li>
              <li><i class="bi bi-check-circle"></i> Filter cleaning</li>
              <li><i class="bi bi-check-circle"></i> Unit inspection</li>
              <li><i class="bi bi-check-circle"></i> Basic performance check</li>
            </ul>
            <div class="card-footer">
              <div class="price">
                <i class="bi bi-tag"></i>
                <div><small>Starting from</small><strong>₱ 800</strong></div>
              </div>
              <button type="button" class="btn-request">Request Service <i class="bi bi-chevron-right"></i></button>
            </div>
          </div>
        </article>

        <!-- AC Repair -->
        <article class="card">
          <img src="/cool_freeze/frontend/assets/img/couch.svg" alt="Bright living room with a grey sofa" class="card-img">
          <div class="card-body">
            <h2>AC Repair</h2>
            <p class="desc">We fix aircon problems quickly and efficiently to get your unit back in condition</p>
            <p class="includes">Services include:</p>
            <ul class="checklist">
              <li><i class="bi bi-check-circle"></i> Diagnose the issue</li>
              <li><i class="bi bi-check-circle"></i> Repair faulty parts</li>
              <li><i class="bi bi-check-circle"></i> Test functionality</li>
              <li><i class="bi bi-check-circle"></i> Provide service report</li>
            </ul>
            <div class="card-footer">
              <div class="price">
                <i class="bi bi-tag"></i>
                <div><small>Starting from</small><strong>₱ 1000</strong></div>
              </div>
              <button type="button" class="btn-request">Request Service <i class="bi bi-chevron-right"></i></button>
            </div>
          </div>
        </article>

        <!-- AC Maintenance -->
        <article class="card">
          <img src="/cool_freeze/frontend/assets/img/couch.svg" alt="Bright living room with a grey sofa" class="card-img">
          <div class="card-body">
            <h2>AC Maintenance</h2>
            <p class="desc">Prevent problems before they happen with our scheduled maintenance service</p>
            <p class="includes">Services include:</p>
            <ul class="checklist">
              <li><i class="bi bi-check-circle"></i> Full system check</li>
              <li><i class="bi bi-check-circle"></i> Clean and inspect components</li>
              <li><i class="bi bi-check-circle"></i> Optimize performance</li>
              <li><i class="bi bi-check-circle"></i> Extend unit lifespan</li>
            </ul>
            <div class="card-footer">
              <div class="price">
                <i class="bi bi-tag"></i>
                <div><small>Starting from</small><strong>₱ 1200</strong></div>
              </div>
              <button type="button" class="btn-request">Request Service <i class="bi bi-chevron-right"></i></button>
            </div>
          </div>
        </article>

        <!-- AC Installation -->
        <article class="card card-wide">
          <img src="/cool_freeze/frontend/assets/img/couch.svg" alt="Bright living room with a grey sofa" class="card-img">
          <div class="card-body">
            <h2>AC Installation</h2>
            <p class="desc">Professional installation for your new aircon unit</p>
            <p class="includes">Services include:</p>
            <ul class="checklist">
              <li><i class="bi bi-check-circle"></i> Site inspection</li>
              <li><i class="bi bi-check-circle"></i> Proper unit installation</li>
              <li><i class="bi bi-check-circle"></i> System testing</li>
              <li><i class="bi bi-check-circle"></i> Warranty and support</li>
            </ul>
            <div class="card-footer">
              <div class="price">
                <i class="bi bi-tag"></i>
                <div><small>Starting from</small><strong>₱ 800</strong></div>
              </div>
              <button type="button" class="btn-request">Request Service <i class="bi bi-chevron-right"></i></button>
            </div>
          </div>
        </article>

        <!-- Parts replacement -->
        <article class="card card-wide">
          <img src="/cool_freeze/frontend/assets/img/couch.svg" alt="Bright living room with a grey sofa" class="card-img">
          <div class="card-body">
            <h2>Parts replacement</h2>
            <p class="desc">Replace damaged parts with genuine and high-quality components</p>
            <p class="includes">Services include:</p>
            <ul class="checklist">
              <li><i class="bi bi-check-circle"></i> Genuine parts</li>
              <li><i class="bi bi-check-circle"></i> Professional installation</li>
              <li><i class="bi bi-check-circle"></i> System testing</li>
              <li><i class="bi bi-check-circle"></i> Warranty and replaced parts</li>
            </ul>
            <div class="card-footer">
              <div class="price">
                <i class="bi bi-tag"></i>
                <div><small>Starting from</small><strong>₱ 800</strong></div>
              </div>
              <button type="button" class="btn-request">Request Service <i class="bi bi-chevron-right"></i></button>
            </div>
          </div>
        </article>

      </section>
    </main>
  </div>

  <!-- ========== REQUEST SERVICE MODAL ========== -->
  <div class="modal-overlay" id="serviceModalOverlay">
    <div class="modal" id="serviceModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <div class="modal-scroll">
        <button type="button" class="modal-close" id="modalCloseBtn" aria-label="Close">
          <i class="bi bi-x-lg"></i>
        </button>

        <button type="button" class="modal-back" id="modalBackBtn">
          <i class="bi bi-arrow-left"></i> Back to Services
        </button>

        <h2 class="modal-title" id="modalTitle">Request <span>Service</span></h2>
        <p class="modal-subtitle">Fill in the details below to request your selected service</p>

        <div class="stepper">
          <div class="step active" data-step="1">
            <div class="step-circle">1</div>
            <div class="step-label">Service Details</div>
          </div>
          <div class="step-line"></div>
          <div class="step" data-step="2">
            <div class="step-circle">2</div>
            <div class="step-label">Schedule &amp; Location</div>
          </div>
          <div class="step-line"></div>
          <div class="step" data-step="3">
            <div class="step-circle">3</div>
            <div class="step-label">Submit</div>
          </div>
        </div>

        <!-- Step 1: Service details -->
        <div class="step-panel active" data-panel="1">
          <div class="panel-grid">
            <div class="form-col">
              <h3 class="form-heading">Service Information</h3>

              <label class="field">
                <span>Service Type</span>
                <select id="serviceTypeSelect">
                  <option>Services Type</option>
                  <option>Residential</option>
                  <option>Commercial</option>
                </select>
              </label>

              <label class="field">
                <span>AC Unit Type</span>
                <select id="acUnitTypeSelect">
                  <option>Split Type</option>
                  <option>Window Type</option>
                  <option>Cassette Type</option>
                  <option>Portable Type</option>
                </select>
              </label>

              <div class="field">
                <span>Number of Units</span>
                <div class="qty">
                  <button type="button" class="qty-btn" data-action="dec" aria-label="Decrease">&minus;</button>
                  <input type="text" class="qty-input" id="qtyInput" value="1" inputmode="numeric" readonly>
                  <button type="button" class="qty-btn" data-action="inc" aria-label="Increase">&plus;</button>
                </div>
              </div>
            </div>

            <div class="info-col">
              <div class="info-art">
                <img class="modalpic" src="/cool_freeze/frontend/assets/img/aircon.svg" alt="">
              </div>
              <div class="includes-box">
                <p class="includes-title" id="includesTitle">Service Includes:</p>
                <ul class="includes-list" id="includesList"></ul>
              </div>
            </div>
          </div>
        </div>

    


      <div class="modal-footer">
        <button type="button" class="btn-outline" id="btnStepBack" style="display:none;">Previous</button>
        <div class="footer-actions">
          <button type="button" class="btn-outline" id="btnScheduleService">Schedule Service</button>
          <button type="button" class="btn-primary" id="btnAddCart">Add to Service Cart</button>
          <button type="button" class="btn-primary" id="btnStepNext" style="display:none;">Continue</button>
          <button type="button" class="btn-primary" id="btnSubmitRequest" style="display:none;">Confirm &amp; Submit Request</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function () {
      var toggle = document.getElementById('navToggle');
      var nav = document.getElementById('sidebarNav');
      if (toggle && nav) {
        function setOpen(open) {
          nav.classList.toggle('open', open);
          toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
          var icon = toggle.querySelector('i');
          if (icon) icon.className = open ? 'bi bi-x-lg' : 'bi bi-list';
        }

        toggle.addEventListener('click', function () {
          setOpen(!nav.classList.contains('open'));
        });

        // Close the dropdown after picking a link (mobile only)
        nav.querySelectorAll('.nav-link, .logout-mobile').forEach(function (link) {
          link.addEventListener('click', function () {
            if (window.matchMedia('(max-width: 768px)').matches) {
              setOpen(false);
            }
          });
        });

        // Reset state if the viewport is resized back to desktop
        window.addEventListener('resize', function () {
          if (!window.matchMedia('(max-width: 768px)').matches) {
            setOpen(false);
          }
        });
      }
    })();

    /* ========== REQUEST SERVICE MODAL ========== */
    (function () {
      var overlay = document.getElementById('serviceModalOverlay');
      var modal = document.getElementById('serviceModal');
      var modalTitle = document.getElementById('modalTitle');
      var includesTitle = document.getElementById('includesTitle');
      var includesList = document.getElementById('includesList');
      var reviewBox = document.getElementById('reviewBox');
      var qtyInput = document.getElementById('qtyInput');
      var acUnitTypeSelect = document.getElementById('acUnitTypeSelect');

      var btnStepBack = document.getElementById('btnStepBack');
      var btnScheduleService = document.getElementById('btnScheduleService');
      var btnAddCart = document.getElementById('btnAddCart');
      var btnStepNext = document.getElementById('btnStepNext');
      var btnSubmitRequest = document.getElementById('btnSubmitRequest');

      var currentStep = 1;
      var currentService = { name: '', price: '', includes: [] };
      var lastFocused = null;

      function openModal(card) {
        var name = card.querySelector('h2').textContent.trim();
        var priceEl = card.querySelector('.price strong');
        var price = priceEl ? priceEl.textContent.trim() : '';
        var items = Array.prototype.map.call(
          card.querySelectorAll('.checklist li'),
          function (li) { return li.textContent.trim(); }
        );

        currentService = { name: name, price: price, includes: items };

        modalTitle.innerHTML = 'Request <span>' + name + '</span>';
        includesTitle.textContent = name + ' Includes:';
        includesList.innerHTML = items.map(function (item) {
          return '<li><i class="bi bi-check-circle"></i>' + item + '</li>';
        }).join('');

        lastFocused = document.activeElement;
        goToStep(1);
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
        document.getElementById('modalCloseBtn').focus();
      }

      function closeModal() {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
        if (lastFocused) lastFocused.focus();
      }

      function goToStep(n) {
        currentStep = n;

        document.querySelectorAll('.step').forEach(function (s) {
          var step = parseInt(s.getAttribute('data-step'), 10);
          s.classList.toggle('active', step === n);
          s.classList.toggle('done', step < n);
        });
        document.querySelectorAll('.step-line').forEach(function (line, idx) {
          line.classList.toggle('done', idx + 1 < n);
        });
        document.querySelectorAll('.step-panel').forEach(function (p) {
          p.classList.toggle('active', parseInt(p.getAttribute('data-panel'), 10) === n);
        });

        // Footer button visibility per step
        modal.querySelector('.modal-footer').classList.toggle('has-back', n !== 1);
        btnStepBack.style.display = n === 1 ? 'none' : 'inline-flex';
        btnScheduleService.style.display = n === 1 ? 'inline-flex' : 'none';
        btnAddCart.style.display = n === 1 ? 'inline-flex' : 'none';
        btnStepNext.style.display = n === 2 ? 'inline-flex' : 'none';
        btnSubmitRequest.style.display = n === 3 ? 'inline-flex' : 'none';

        if (n === 3) renderReview();

        modal.querySelector('.modal-scroll').scrollTop = 0;
      }

      function renderReview() {
        var unitType = acUnitTypeSelect.value;
        var qty = qtyInput.value;
        var date = document.getElementById('scheduleDate').value || '\u2014';
        var time = document.getElementById('scheduleTime').value || '\u2014';
        var address = document.getElementById('scheduleAddress').value.trim() || '\u2014';
        var contact = document.getElementById('scheduleContact').value.trim() || '\u2014';

        reviewBox.innerHTML =
          '<div class="review-row"><span>Service</span><strong>' + currentService.name + '</strong></div>' +
          '<div class="review-row"><span>AC Unit Type</span><strong>' + unitType + '</strong></div>' +
          '<div class="review-row"><span>Number of Units</span><strong>' + qty + '</strong></div>' +
          '<div class="review-row"><span>Date</span><strong>' + date + '</strong></div>' +
          '<div class="review-row"><span>Time</span><strong>' + time + '</strong></div>' +
          '<div class="review-row"><span>Address</span><strong>' + address + '</strong></div>' +
          '<div class="review-row"><span>Contact</span><strong>' + contact + '</strong></div>' +
          '<div class="review-row total"><span>Starting from</span><strong>' + currentService.price + '</strong></div>';
      }

      // Open modal from any "Request Service" button
      document.querySelectorAll('.btn-request').forEach(function (btn) {
        btn.addEventListener('click', function () {
          var card = btn.closest('.card');
          if (card) openModal(card);
        });
      });

      // Close interactions
      document.getElementById('modalCloseBtn').addEventListener('click', closeModal);
      document.getElementById('modalBackBtn').addEventListener('click', closeModal);
      overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeModal();
      });
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('open')) closeModal();
      });

      // Quantity stepper
      document.querySelectorAll('.qty-btn').forEach(function (b) {
        b.addEventListener('click', function () {
          var val = parseInt(qtyInput.value, 10) || 1;
          if (b.getAttribute('data-action') === 'inc') {
            val += 1;
          } else {
            val = Math.max(1, val - 1);
          }
          qtyInput.value = val;
        });
      });

      // Step navigation
      btnScheduleService.addEventListener('click', function () { goToStep(2); });
      btnStepBack.addEventListener('click', function () { goToStep(Math.max(1, currentStep - 1)); });
      btnStepNext.addEventListener('click', function () { goToStep(3); });

      // Final actions
      btnAddCart.addEventListener('click', function () {
        closeModal();
        alert(currentService.name + ' added to your Service Cart.');
      });
      btnSubmitRequest.addEventListener('click', function () {
        closeModal();
        alert('Your request for ' + currentService.name + ' has been submitted.');
      });
    })();
  </script>

</body>
</html>