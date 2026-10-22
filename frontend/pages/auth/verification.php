<?php if (empty($_SESSION['reset_email']))  { header('Location: ' . BASE_URL . '?page=forget'); exit; } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code | CoolFreeze</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'frontend/assets/css/auth/verification.css' ?>">
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
              Check your email for
              <span class="title-accent">Verification code!</span>
            </h1>
            <p class="subtitle">
              We sent a reset link to your email, enter the 5 digit code that is mentioned in the email.
            </p>
            <div id="form-message" class="hidden"></div>
            <form method="post" id="verify-form" action="<?= BASE_URL . 'backend/api/verify-code.php' ?>" novalidate>
              <label class="otp-label" for="otp-1">5-Digit Code</label>
              <div id="otp-group">
                <input id="otp-1" name="code[]" data-otp type="text" inputmode="numeric" pattern="[0-9]" maxlength="1"
                  required autocomplete="one-time-code" aria-label="Digit 1" class="otp-input">
                <input id="otp-2" name="code[]" data-otp type="text" inputmode="numeric" pattern="[0-9]" maxlength="1"
                  required aria-label="Digit 2" class="otp-input">
                <input id="otp-3" name="code[]" data-otp type="text" inputmode="numeric" pattern="[0-9]" maxlength="1"
                  required aria-label="Digit 3" class="otp-input">
                <input id="otp-4" name="code[]" data-otp type="text" inputmode="numeric" pattern="[0-9]" maxlength="1"
                  required aria-label="Digit 4" class="otp-input">
                <input id="otp-5" name="code[]" data-otp type="text" inputmode="numeric" pattern="[0-9]" maxlength="1"
                  required aria-label="Digit 5" class="otp-input">
              </div>
              <button type="submit" class="btn-verify">
                Verify Code
              </button>
            </form>
            <p class="resend-text">
              Haven't got the code yet?
              <a href="#" id="resend-link" class="link-underline">Resend code</a>
            </p>
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
      var form = document.getElementById('verify-form');
      var msg = document.getElementById('form-message');
      var btn = form.querySelector('button[type="submit"]');
      var inputs = Array.prototype.slice.call(document.querySelectorAll('[data-otp]'));

      function show(text, ok) {
        msg.className = (ok ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700');
        msg.textContent = text;
      }

      inputs.forEach(function(input, i) {
        input.addEventListener('input', function() {
          input.value = input.value.replace(/\D/g, '').slice(0, 1);
          if (input.value && inputs[i + 1]) {
            inputs[i + 1].focus();
          }
        });
        input.addEventListener('keydown', function(e) {
          if (e.key === 'Backspace' && !input.value && inputs[i - 1]) {
            inputs[i - 1].focus();
          }
        });
        input.addEventListener('paste', function(e) {
          var text = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0,
            inputs.length);
          if (!text) {
            return;
          }
          e.preventDefault();
          text.split('').forEach(function(ch, k) {
            inputs[k].value = ch;
          });
          inputs[Math.min(text.length, inputs.length - 1)].focus();
        });
      });

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        btn.disabled = true;
        btn.textContent = 'Verifying...';
        cfPost(form.action, new FormData(form)).then(function(res) {
          if (res.success) {
            show(res.message, true);
            window.location.replace(res.redirect);
            return;
          }
          show(cfFirstError(res), false);
          if (res.redirect) {
            setTimeout(function() {
              window.location.replace(res.redirect);
            }, 1500);
          }
          btn.disabled = false;
          btn.textContent = 'Verify Code';
        });
      });

      document.getElementById('resend-link').addEventListener('click', function(e) {
        e.preventDefault();
        cfPost('<?= BASE_URL ?>backend/api/resend-code.php', {}).then(function(res) {
          show(res.message || 'Something went wrong.', !!res.success);
        });
      });
    })();
    </script>
  </body>

</html>