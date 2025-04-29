<?php
// header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="/FullStack/Styles.css">


  <title>Skewer House</title>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="/FullStack/Index.html">SKEWER HOUSE</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/FullStack/Index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/FullStack/Menu.html">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="/shop.php">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="/Contact.html">Contact</a></li>
        </ul>
        <div class="nav-buttons">
          <button id="dark-mode-toggle">Dark Mode</button>
          <a href="/includes/login.php" class="login-btn">Login</a>
        </div>
      </div>
    </div>
  </nav>
</header>

