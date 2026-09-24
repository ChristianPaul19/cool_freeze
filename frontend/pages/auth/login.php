<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Account | CoolFreeze</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<!-- h-dvh + overflow-hidden: the page is exactly one screen tall and never scrolls -->
<body class="h-dvh overflow-hidden bg-white text-gray-900 antialiased">

  <div class="flex h-full flex-col md:flex-row">

    <!-- LEFT SIDE: form (only this panel scrolls, and only if a very short screen can't fit it) -->
    <div class="flex h-full w-full overflow-y-auto px-5 py-4 sm:px-8 md:w-1/2 md:px-10 lg:px-14">
      <!-- m-auto centers vertically without clipping the top when content overflows -->
      <div class="m-auto w-full max-w-lg">

        <!-- Brand (mobile only, since the image panel is hidden) -->
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
            Don't have an account?
            <a href="<?= BASE_URL ?>?page=register" class="text-blue-600 hover:underline">Register</a>
          </small>
        </div>

        <h2 class="text-2xl font-bold">
          Welcome Back!
        </h2>

        <p class="mt-1 text-sm text-gray-500">
          Log in to your account to continue to CoolFreeze
        </p>

        <form class="mt-4 space-y-3" method="post" action="">

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
            <label for="password" class="mb-1 block text-sm font-bold">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              autocomplete="current-password"
              required
              class="w-full rounded-md bg-gray-100 px-3 py-2 text-base outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Enter your password"
            >
          </div>

          <div class="flex items-center justify-between gap-3 text-sm">
            <div class="flex items-center gap-2">
              <input
                class="h-4 w-4 shrink-0 rounded border-gray-300 accent-blue-600"
                type="checkbox"
                id="remember"
                name="remember"
              >
              <label for="remember">Remember me</label>
            </div>

            <a href="<?= BASE_URL ?>?page=forget" class="text-blue-600 hover:underline">Forgot password?</a>
          </div>

          <button
            type="submit"
            class="w-full cursor-pointer rounded-md bg-blue-600 px-4 py-2.5 font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
          >
            Login
          </button>
        </form>

      </div>
    </div>


    <!-- RIGHT SIDE: image (hidden on mobile, shown from md and up) -->
    <div class="relative hidden h-full overflow-hidden md:block md:w-1/2">
      <!-- Background: fills the panel exactly, cropped to fit -->
      <img
        src="<?= BASE_URL . 'frontend/assets/img/login_register_background.jpg' ?>"
        class="absolute inset-0 h-full w-full object-cover -scale-x-100"
        alt=""
      >

      <!-- Text sits in the top ~40% of the panel, above the aircon in the image.
           Headline size follows both width and height so it shrinks on short screens. -->
      <div class="absolute right-0 top-0 flex flex-col items-end p-6 text-right p-6 lg:p-10">
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

  </div>

</body>
</html>