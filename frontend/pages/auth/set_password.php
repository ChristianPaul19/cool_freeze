<?php if (empty($_SESSION['reset_verified_email'])) { header('Location: ' . BASE_URL . '?page=forget'); exit; } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password | CoolFreeze</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="<?= BASE_URL . 'frontend/assets/js/eye-password.js' ?>"></script>
    <link rel="stylesheet" href="<?= BASE_URL . 'frontend/assets/css/auth/set_password.css' ?>">
  </head>

  <body>
    <div class="page">
      <!-- Left Side: Form -->
      <div class="form-side">
        <div class="form-column">
          <div class="main-content">
            <div class="top-row">
              <a href="<?= BASE_URL ?>?page=login" class="back-link" aria-label="Back">
                <img src="<?= BASE_URL . 'frontend/assets/img/back-arrow.svg' ?>" alt="Back">
              </a>
            </div>
            <h1 class="title">
              Set a new <span class="title-accent">Password</span>
            </h1>
            <p class="subtitle">
              Enter a new password with at least 8 characters, then confirm it below.
            </p>
            <div id="form-message" class="hidden"></div>
            <form id="reset-form" method="post" action="<?= BASE_URL . 'backend/api/reset-password.php' ?>" novalidate>
              <div>
                <label for="password" class="label">Password</label>
                <div class="password-wrap">
                  <input type="password" id="password" name="password" autocomplete="new-password" required
                    class="input" placeholder="Enter your password">
                  <i class="bi bi-eye toggle-password" data-target="password"></i>
                </div>
                <p class="field-error hidden" data-for="password"></p>
              </div>
              <div>
                <label for="confirm_password" class="label">Confirm Password</label>
                <div class="password-wrap">
                  <input type="password" id="confirm_password" name="confirm_password" autocomplete="new-password"
                    required class="input" placeholder="Confirm your password">
                  <i class="bi bi-eye toggle-password" data-target="confirm_password"></i>
                </div>
                <p class="field-error hidden" data-for="confirm_password"></p> <!-- NEW -->
              </div>
              <button type="submit" class="btn-update">
                Update Password
              </button>
            </form>
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

    <script src="<?= BASE_URL ?>frontend/assets/js/api.js"></script>
    <script>
    (function() {
      var form = document.getElementById('reset-form');
      var msg = document.getElementById('form-message');
      var btn = form.querySelector('button[type="submit"]');

      function show(text, ok) {
        msg.className = (ok ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700');
        msg.textContent = text;
      }

      function clearErrors() {
        msg.className = 'hidden';
        document.querySelectorAll('.field-error').forEach(function(p) {
          p.classList.add('hidden');
          p.textContent = '';
        });
      }

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        clearErrors();
        btn.disabled = true;
        btn.textContent = 'Updating...';
        cfPost(form.action, new FormData(form)).then(function(res) {
          if (res.success) {
            show(res.message, true);
            setTimeout(function() {
              window.location.replace(res.redirect);
            }, 1200);
            return;
          }
          if (res.errors) {
            Object.keys(res.errors).forEach(function(f) {
              var p = document.querySelector('.field-error[data-for="' + f + '"]');
              if (p) {
                p.textContent = res.errors[f];
                p.classList.remove('hidden');
              }
            });
          } else {
            show(res.message, false);
            if (res.redirect) {
              setTimeout(function() {
                window.location.replace(res.redirect);
              }, 1500);
            }
          }
          btn.disabled = false;
          btn.textContent = 'Update Password';
        });
      });
    })();
    </script>
  </body>
</html>