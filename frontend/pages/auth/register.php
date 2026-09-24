<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account | CoolFreeze</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<!-- h-dvh + overflow-hidden: the page is exactly one screen tall and never scrolls -->
<body class="h-dvh overflow-hidden bg-white text-gray-900 antialiased">

  <div class="flex h-full flex-col md:flex-row">

    <!-- LEFT SIDE (hidden on mobile, shown from md and up) -->
    <div class="relative hidden h-full overflow-hidden md:block md:w-1/2">
      <!-- Background: fills the panel exactly, cropped to fit -->
      <img
        src="<?= BASE_URL . 'frontend/assets/img/login_register_background.jpg' ?>"
        class="absolute inset-0 h-full w-full object-cover"
        alt=""
      >

      <!-- Text over image -->
      <!-- Text sits in the top ~40% of the panel, above the aircon in the image.
           Headline size follows both width and height so it shrinks on short screens. -->
      <div class="absolute left-0 top-0 p-6 lg:p-10">
        <h2 class="text-xl font-bold text-blue-600 lg:text-2xl">COOLFREEZE</h2>
        <h1 class="mt-[3vh] text-[clamp(1.75rem,min(4vw,6vh),3rem)] font-bold leading-tight text-gray-900">
          Stay Cool,<br>
          Stay Comfortable
        </h1>
        <p class="mt-2 max-w-sm text-sm text-gray-600 lg:text-base">
          Quality air conditioning products and professional services
          for your home and business.
        </p>
      </div>
    </div>


    <!-- RIGHT SIDE (only this panel scrolls, and only if a very short screen can't fit the form) -->
    <div class="flex h-full w-full overflow-y-auto px-5 py-4 sm:px-8 md:w-1/2 md:px-10 lg:px-14">
      <!-- m-auto centers vertically without clipping the top when content overflows -->
      <div class="m-auto w-full max-w-lg">

        <!-- Brand (mobile only, since the left panel is hidden) -->
        <h2 class="mb-2 text-xl font-bold text-blue-600 md:hidden">COOLFREEZE</h2>

        <div class="mb-3 flex items-center justify-between gap-3">
          <a href="<?= BASE_URL ?>?page=home" class="inline-flex" aria-label="Back to home">
            <img
              class="h-6 w-6"
              src="<?= BASE_URL . 'frontend/assets/img/back-arrow.svg' ?>"
              alt="Back"
            >
          </a>
          <small class="text-sm text-gray-500">
            Already have an account?
            <a href="<?= BASE_URL ?>?page=login" class="text-blue-600 hover:underline">Login</a>
          </small>
        </div>

        <h2 class="text-2xl font-bold">
          Create Your Account
        </h2>

        <p class="mt-1 text-sm text-gray-500">
          Join CoolFreeze and get access to our products and services
        </p>

        <form class="mt-4 space-y-3" method="post" action="">

          <div>
            <label for="username" class="mb-1 block text-sm font-bold">Username</label>
            <input
              type="text"
              id="username"
              name="username"
              autocomplete="username"
              required
              class="w-full rounded-md bg-gray-100 px-3 py-2 text-base outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Enter your user name"
            >
          </div>

          <div>
            <label for="email" class="mb-1 block text-sm font-bold">Email Address</label>
            <input
              type="email"
              id="email"
              name="email"
              autocomplete="email"
              required
              class="w-full rounded-md bg-gray-100 px-3 py-2 text-base outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Enter your email address"
            >
          </div>

          <div>
            <label for="phone" class="mb-1 block text-sm font-bold">Phone Number</label>
            <input
              type="tel"
              id="phone"
              name="phone"
              autocomplete="tel"
              inputmode="tel"
              required
              class="w-full rounded-md bg-gray-100 px-3 py-2 text-base outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Enter your phone number"
            >
          </div>

          <div>
            <label for="password" class="mb-1 block text-sm font-bold">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              autocomplete="new-password"
              required
              class="w-full rounded-md bg-gray-100 px-3 py-2 text-base outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Enter your password"
            >
          </div>

          <div>
            <label for="confirm_password" class="mb-1 block text-sm font-bold">Confirm Password</label>
            <input
              type="password"
              id="confirm_password"
              name="confirm_password"
              autocomplete="new-password"
              required
              class="w-full rounded-md bg-gray-100 px-3 py-2 text-base outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Confirm your password"
            >
          </div>

          <div class="flex items-start gap-2 text-sm">
            <input
              class="mt-1 h-4 w-4 shrink-0 rounded border-gray-300 accent-blue-600"
              type="checkbox"
              id="terms"
              name="terms"
              required
            >
            <label for="terms">
              I agree to the
              <a href="#" class="text-blue-600 hover:underline">Terms of Service</a>
              and
              <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>
            </label>
          </div>

          <button
            type="submit"
            class="w-full cursor-pointer rounded-md bg-blue-600 px-4 py-2.5 font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
          >
            Register
          </button>
        </form>

      </div>
    </div>

  </div>

</body>
</html>