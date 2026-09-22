<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account | CoolFreeze</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo BASE_URL . 'frontend/assets/css/auth.css'?>">
</head>

  <body>

    <div class="container-fluid min-vh-100 d-flex p-0">
      <div class="row g-0 w-100 min-vh-100">

        <!-- LEFT SIDE -->
        <div class="col-md-6 p-5">
          <div class="d-flex justify-content-between align-center mb-4">
            <span class=""><a href="<?= BASE_URL ?>?page=home" class="text-decoration-none">←</a></span>
            <small class="text-secondary">
                Don't have an account?
                <a href="<?= BASE_URL ?>?page=register">Register</a>
            </small>
          </div>

          <h2 class="fw-bold">
              Welcome Back!
          </h2>

          <p class="text-secondary small">
              Log in to your account to continue to CoolFreeze
          </p>


          <form>
            <label class="form-label fw-bold small">
                Email Address
            </label>

            <input
                type="text"
                class="form-control bg-light border-0 mb-3"
                placeholder="Enter your email address"
            >

            <label class="form-label fw-bold small">
                Password
            </label>

            <input
                type="email"
                class="form-control bg-light border-0 mb-3"
                placeholder="Enter your password"
            >

            <div class="form-check small mb-3">
                <input
                    class="form-check-input "
                    type="checkbox"
                    id="remember"
                >
                <label class="form-check-label" for="remember" style="margin-inline-end: 43em;">
                    Remember me
                </label>

                <a href="">Forgot password?</a>
            </div>

            <button class="btn btn-primary w-100">
                Login
            </button>
          </form>
        </div>

        <!-- Right SIDE -->
        <div class="col-md-6 position-relative p-0 overflow-hidden">
          <!-- Background -->
          <img
              src="<?php echo BASE_URL . 'frontend/assets/img/login_register_background.jpg'?>"
              class="w-100 vh-100 fit-cover"
              alt=""
          >

          <!-- Text over image -->
          <div class="position-absolute top-0 start-0 p-5">
              <h2 class="text-primary">COOLFREEZE</h2>
              <h1 class="fw-bold text-dark mt-5 display-3">
                  Stay Cool,<br>
                  Stay Comfortable
              </h1>
              <p class="text-secondary h5" style="max-width: 500px;">
                  Quality air conditioning products and professional services
                  for your home and business.
              </p>
          </div>
        </div>

      </div>
    </div>