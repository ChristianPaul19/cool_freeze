<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Services | CoolFreeze</title>

    
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Lexend:wght@500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/cool_freeze/frontend/assets/css/services.css">
</head>
<body>

  <aside class="sidebar">
    <a href="#" class="logo">
      <img class="logo" src="/cool_freeze/frontend/assets/img/CoolFreeze_Logo.svg" alt="">
    </a>

    <nav class="nav" aria-label="Main navigation">
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
    </nav>

    <a href="<?= BASE_URL ?>?page=landing" class="logout">
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
          <img src="/cool_freeze/frontend/assets/img/sample_coolfreeze_technician.jpg" alt="Bright living room with a grey sofa" class="card-img">
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
              <a href="#" class="btn-request">Request Service <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
        </article>

        <!-- AC Repair -->
        <article class="card">
          <img src="/cool_freeze/frontend/assets/img/sample_coolfreeze_technician.jpg" alt="Bright living room with a grey sofa" class="card-img">
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
              <a href="#" class="btn-request">Request Service <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
        </article>

        <!-- AC Maintenance -->
        <article class="card">
          <img src="/cool_freeze/frontend/assets/img/sample_coolfreeze_technician.jpg" alt="Bright living room with a grey sofa" class="card-img">
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
              <a href="#" class="btn-request">Request Service <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
        </article>

        <!-- AC Installation -->
        <article class="card card-wide">
          <img src="/cool_freeze/frontend/assets/img/sample_coolfreeze_technician.jpg" alt="Bright living room with a grey sofa" class="card-img">
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
              <a href="#" class="btn-request">Request Service <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
        </article>

        <!-- Parts replacement -->
        <article class="card card-wide">
          <img src="/cool_freeze/frontend/assets/img/sample_coolfreeze_technician.jpg" alt="Bright living room with a grey sofa" class="card-img">
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
              <a href="#" class="btn-request">Request Service <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
        </article>

      </section>
    </main>
  </div>

</body>
</html>