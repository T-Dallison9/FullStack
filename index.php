<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  
  <link rel="stylesheet" href="Styles.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="Index.html">SKEWER HOUSE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="Index.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="Menu.html">Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Takeaway</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
          </ul>
          <div class="nav-buttons">
            <button id="dark-mode-toggle">Dark Mode</button>
            <a href="includes/login.php" class="login-btn">Login</a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="content-wrapper">

  <main class="container my-5">
    <?php output_username(); ?>

    <?php if (!isset($_SESSION['user_id'])): ?>

      <div class="form-box mb-4">
        <h2 class="form-title">Login</h2>
        <form action="includes/login.inc.php" method="post">
          <input class="form-input" type="text" name="username_or_email" placeholder="Username or Email...">
          <input class="form-input" type="password" name="pwd" placeholder="Password...">
          <button class="form-btn">Login</button>
        </form>
        <?php check_login_errors(); ?>
      </div>

      <div class="form-box mb-4">
        <h2 class="form-title">Signup</h2>
        <form action="includes/signup.inc.php" method="post">
          <?php signup_inputs(); ?>
          <button class="form-btn">Signup</button>
        </form>
        <?php check_signup_errors(); ?>
      </div>

    <?php else: ?>

      <div class="form-box mb-4">
        <h2 class="form-title">Logout</h2>
        <form action="includes/logout.inc.php" method="post">
          <button class="form-btn">Logout</button>
        </form>
      </div>

    <?php endif; ?>
  </main>

  <footer>
      <p><a href="" class="text-warning">skewerhousetaunton@gmail.com</a></p>
      <p>
        <a href="#" class="text-light me-2"><i class="bi bi-instagram"></i></a>
        <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
      </p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="Scripts.js"></script>
</body>
</html>
