<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | CoolFreeze</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="<?= BASE_URL . 'frontend/assets/js/eye-password.js' ?>"></script>
    <link rel="stylesheet" href="<?= BASE_URL . 'frontend/assets/css/auth/register.css' ?>">
  </head>

  <body>
    <div class="page">
      <!-- LEFT SIDE (hidden on mobile, shown from md and up) -->
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

      <!-- RIGHT SIDE -->
      <div class="form-side">
        <div class="form-wrap">
          <h2 class="brand-mobile">COOLFREEZE</h2>
          <div class="top-row">
            <a href="<?= BASE_URL ?>?page=landing" class="back-link" aria-label="Back to home">
              <img src="<?= BASE_URL . 'frontend/assets/img/back-arrow.svg' ?>" alt="Back">
            </a>
            <small>
              Already have an account?
              <a href="<?= BASE_URL ?>?page=login" class="link-blue">Login</a>
            </small>
          </div>
          <h2 class="title">
            Create Your Account
          </h2>
          <p class="subtitle">
            Join CoolFreeze and get access to our products and services
          </p>

          <div id="form-message" class="hidden"></div>

          <form id="register-form" method="post" action="<?= BASE_URL . 'backend/api/register.php' ?>" novalidate>
            <div>
              <label for="username" class="label">Username</label>
              <input type="text" id="username" name="username" autocomplete="username" required class="input"
                placeholder="Enter your user name">
              <p class="field-error hidden" data-for="username"></p> <!-- NEW -->
            </div>

            <div>
              <label for="email" class="label">Email Address</label>
              <input type="email" id="email" name="email" autocomplete="email" required class="input"
                placeholder="Enter your email address">
              <p class="field-error hidden" data-for="email"></p> <!-- NEW -->
            </div>

            <div>
              <label for="phone" class="label">Phone Number</label>
              <input type="tel" id="phone" name="phone" autocomplete="tel" inputmode="tel" required class="input"
                placeholder="Enter your phone number">
              <p class="field-error hidden" data-for="phone"></p> <!-- NEW -->
            </div>

            <div>
              <label for="password" class="label">Password</label>
              <div class="password-wrap">
                <input type="password" id="password" name="password" autocomplete="new-password" required class="input"
                  placeholder="Enter your password">
                <i class="bi bi-eye toggle-password" data-target="password"></i>
              </div>
              <p class="field-error hidden" data-for="password"></p>
            </div>

            <div>
              <label for="confirm_password" class="label">Confirm Password</label>
              <div class="password-wrap">
                <input type="password" id="confirm_password" name="confirm_password" autocomplete="new-password" required
                  class="input" placeholder="Confirm your password">
                <i class="bi bi-eye toggle-password" data-target="confirm_password"></i>
              </div>
              <p class="field-error hidden" data-for="confirm_password"></p> <!-- NEW -->
            </div>

            <div>
              <div class="terms-row">
                <input class="checkbox" type="checkbox" id="terms" name="terms" value="1" required>
                <label for="terms">
                  I agree to the
                  <a href="terms" class="link-blue">Terms of Service</a>
                  and
                  <a href="privacy" class="link-blue">Privacy Policy</a>
                </label>
              </div>
              <p class="field-error hidden" data-for="terms"></p> <!-- NEW -->
            </div>
            <button type="submit" class="btn-register">
              Register
            </button>
          </form>
        </div>
      </div>
    </div>

    <script>
    $(function() {
      const $form = $('#register-form');
      const $msg = $('#form-message');
      const $btn = $form.find('button[type="submit"]');

      $(window).on('pageshow', function(e) {
        if (e.originalEvent.persisted) {
          $form[0].reset();
          clearErrors();
          $btn.prop('disabled', false).text('Register');
        }
      });

      function showMessage(text, ok) {
        $msg.removeClass('hidden bg-red-50 text-red-700 bg-green-50 text-green-700')
          .addClass(ok ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700')
          .text(text);
      }

      function clearErrors() {
        $msg.addClass('hidden');
        $('.field-error').addClass('hidden').text('');
      }

      $form.on('submit', function(e) {
        e.preventDefault();
        clearErrors();
        $btn.prop('disabled', true).text('Creating account...');

        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json'
          })
          .done(function(res) {
            $form[0].reset();
            showMessage(res.message, true);
            setTimeout(function() {
              window.location.replace(res.redirect);
            }, 1200);
          })
          .fail(function(xhr) {
            const res = xhr.responseJSON || {};
            if (res.errors) {
              $.each(res.errors, function(field, text) {
                $('.field-error[data-for="' + field + '"]').text(text).removeClass('hidden');
              });
            } else {
              showMessage(res.message || 'Network error. Please try again.', false);
            }
            $btn.prop('disabled', false).text('Register');
          });
      });
    });
    </script>
  </body>
</html>