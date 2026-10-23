<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | CoolFreeze</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'frontend/assets/css/auth/forget.css' ?>">
  </head>

  <body>
    <div class="page">
      <!-- Left Side: Form -->
      <div class="form-side">
        <div class="form-column">
          <div>
            <h2 class="brand-mobile">COOLFREEZE</h2>
          </div>
          <div class="main-content">
            <div class="top-row">
              <a href="<?= BASE_URL ?>?page=login" class="back-link" aria-label="Back">
                <img src="<?= BASE_URL . 'frontend/assets/img/back-arrow.svg' ?>" alt="Back">
              </a>
            </div>
            <h1 class="title">
              Forgotten your password?
            </h1>
            <p class="subtitle">
               Enter your email address. If it is registered, we'll send you a 5-digit password reset code.
            </p>
            <div id="form-message" class="hidden"></div>
            <form id="forgot-form" method="post"
              action="<?= BASE_URL . 'backend/api/forgot-password.php' ?>" novalidate>
              <div>
                <label for="email" class="label">Email Address</label>
                <div class="input-wrap">
                  <svg class="input-icon"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                    <path d="m22 7-10 6L2 7"></path>
                  </svg>
                  <input type="email" id="email" name="email" autocomplete="email" required
                    class="input"
                    placeholder="Enter your email address">
                </div>
                <p class="field-error hidden" data-for="email"></p>
              </div>
              <button type="submit" class="btn-send">
                Send Code
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


      <!-- Right Side: Image-->
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
      var form = document.getElementById('forgot-form');
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
        btn.textContent = 'Sending...';
        cfPost(form.action, new FormData(form)).then(function(res) {
          if (res.success) {
            show(res.message, true);
            setTimeout(function() {
              window.location.replace(res.redirect);
            }, 900);
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
          }
          btn.disabled = false;
          btn.textContent = 'Send Code';
        });
      });
    })();
    </script>
  </body>

</html>