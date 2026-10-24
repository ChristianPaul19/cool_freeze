<?php 
require_once dirname(__DIR__, 3) . '/backend/bootstrap.php';
require_once BACKEND_PATH . '/helpers/admin_guard.php';

$userName = $_SESSION['username'] ?? 'Admin';
$currentPage = 'admin_home';


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CoolFreeze | Admin</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>frontend/assets/css/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require FRONTEND_PATH . 'includes/admin_sidebar.php' ?>

        <!-- MOBILE OVERLAY -->
        <div class="overlay" id="overlay"></div>

        <!-- MAIN CONTENT -->
            <div class="main">
            <!-- Topbar -->
            <?php require FRONTEND_PATH . 'includes/admin_topbar.php'?>

            <!-- PAGE CONTENT -->
            <main class="content">

            </main>

        </div>

    </div>
    
</body>
</html>