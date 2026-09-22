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

    <div class="container-fluid min-vh-100 d-flex align-items-center">
      <div class="row w-100">

        <!-- LEFT SIDE -->
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


          <!-- RIGHT SIDE -->
          <div class="col-md-6 p-5">

              <div class="d-flex justify-content-between align-center mb-4">

                  <span class=""><a href="<?= BASE_URL ?>?page=home" class="text-decoration-none">←</a></span>

                  <small class="text-secondary">
                      Already have an account?
                      <a href="<?= BASE_URL ?>?page=login">Login</a>
                  </small>

              </div>

              <h2 class="fw-bold">
                  Create Your Account
              </h2>

              <p class="text-secondary small">
                  Join CoolFreeze and get access to our products and services
              </p>


              <form>

                  <label class="form-label fw-bold small">
                      Username
                  </label>

                  <input
                      type="text"
                      class="form-control bg-light border-0 mb-3"
                      placeholder="Enter your user name"
                  >


                  <label class="form-label fw-bold small">
                      Email Address
                  </label>

                  <input
                      type="email"
                      class="form-control bg-light border-0 mb-3"
                      placeholder="Enter your email address"
                  >


                  <label class="form-label fw-bold small">
                      Phone Number
                  </label>

                  <input
                      type="text"
                      class="form-control bg-light border-0 mb-3"
                      placeholder="Enter your phone number"
                  >


                  <label class="form-label fw-bold small">
                      Password
                  </label>

                  <input
                      type="password"
                      class="form-control bg-light border-0 mb-3"
                      placeholder="Enter your password"
                  >


                  <label class="form-label fw-bold small">
                      Confirm Password
                  </label>

                  <input
                      type="password"
                      class="form-control bg-light border-0 mb-3"
                      placeholder="Enter your password"
                  >


                  <div class="form-check small mb-3">

                      <input
                          class="form-check-input"
                          type="checkbox"
                          id="terms"
                      >

                      <label class="form-check-label" for="terms">
                          I agree to the
                          <a href="#">Terms of Service</a>
                          and
                          <a href="#">Privacy Policy</a>
                      </label>

                  </div>


                  <button class="btn btn-primary w-100">
                      Register
                  </button>

              </form>

        </div>
      </div>
    </div>
    
    
  </body>

</html>