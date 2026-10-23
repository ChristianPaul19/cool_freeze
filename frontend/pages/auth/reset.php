<?php if (empty($_SESSION['reset_verified_email'])) { header('Location: ' . BASE_URL . '?page=forget'); exit; } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset | CoolFreeze</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'frontend/assets/css/auth/reset.css' ?>">
  </head>

  <body>
    <div class="page">
      <!-- Left Side: Content -->
      <div class="form-side">
        <div class="form-column">
          <div class="main-content">
            <div class="top-row">
              <a href="<?= BASE_URL ?>?page=login" class="back-link" aria-label="Back">
                <img src="<?= BASE_URL . 'frontend/assets/img/back-arrow.svg' ?>" alt="Back">
              </a>
            </div>
            <h1 class="title">
              Password Reset
            </h1>
            <p class="subtitle">
              Your code has been verified. Continue to choose a new password.            
            </p>
            <a href="<?= BASE_URL ?>?page=set_password" class="btn-confirm">
              Set New Password
            </a>
            <hr class="divider">
            <p class="bottom-text">
              Remembered it?
              <a href="<?= BASE_URL ?>?page=login" class="link-underline">Back to Login</a>
            </p>
          </div>
        </div>
      </div>

      <!-- Right Side: Image -->
      <div class="image-side">
        <img src="<?= BASE_URL . 'frontend/assets/img/login_register_background.jpg' ?>" alt="">
        <div class="image-content">
          <h2 class="brand-desktop">COOLFREEZE</h2>
          <h1 class="headline">
            Stay Cool,<br>
            Stay Comfortable
          </h1>
          <p class="tagline">
            Quality air conditioning products and professional services
            for your home and business.
          </p>
        </div>
      </div>
    </div>

  </body>

</html>