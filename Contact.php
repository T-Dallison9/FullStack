<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="Styles.css">

  <title>Skewer House - Contact</title>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="/Index.html">SKEWER HOUSE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/FullStack/Index.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/FullStack/Menu.html">Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="includes/shop.php">Services</a></li>
            <li class="nav-item"><a class="nav-link active" href="/FullStack/Contact.php">Contact</a></li>
          </ul>
          <div class="nav-buttons">
            <button id="dark-mode-toggle">Dark Mode</button>
            <a href="/includes/login.php" class="login-btn">Login</a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="content-wrapper">
    <div class="main-box">
      <main class="container my-5">
        <h2 class="text-center mb-4">Get in Touch</h2>

        <div class="row g-4">
          <div class="col-md-6">
            <div class="form-box">
              <h3 class="form-title">Contact Form</h3>
              <form action="#" method="POST">
                <div class="mb-3">
                  <input type="text" class="form-input" placeholder="Your Name" required>
                </div>
                <div class="mb-3">
                  <input type="email" class="form-input" placeholder="Your Email" required>
                </div>
                <div class="mb-3">
                  <textarea class="form-input" rows="5" placeholder="Your Message" required></textarea>
                </div>
                <div class="text-center">
                  <button type="submit" class="form-btn">Send Message</button>
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-box">
              <h3 class="form-title">Contact Information</h3>
              <p><i class="bi bi-envelope-fill"></i> <a href="mailto:skewerhousetaunton@gmail.com" class="text-warning">skewerhousetaunton@gmail.com</a></p>
              <p><i class="bi bi-telephone-fill"></i> +44 1234 567890</p>
              <p><i class="bi bi-geo-alt-fill"></i> 123 Madeira Lane, Taunton, UK</p>
              <div class="mt-4">
                <a href="#" class="text-light me-3"><i class="bi bi-instagram" style="font-size: 1.5rem;"></i></a>
                <a href="#" class="text-light"><i class="bi bi-facebook" style="font-size: 1.5rem;"></i></a>
              </div>
            </div>
          </div>
        </div>

        <hr class="my-5">

        <div class="row">
        <div class="col-md-12">
            <div class="form-box">
            <h3 class="form-title">Leave a Review</h3>
            <form action="includes/submit-review.php" method="POST">
                <div class="mb-3">
                <input type="text" class="form-input" name="name" placeholder="Your Name" required>
                </div>
                <div class="mb-3">
                <input type="email" class="form-input" name="email" placeholder="Your Email (optional)">
                </div>
                <div class="mb-3">
                <textarea class="form-input" name="message" rows="5" placeholder="Your Review" required></textarea>
                </div>
                <div class="text-center">
                <button type="submit" class="form-btn">Submit Review</button>
                </div>
            </form>
            </div>
        </div>
        </div>

        <div class="row mt-5">
        <div class="col-md-12">
            <h4 class="text-center mb-4"> Recent Reviews</h4>
            <div class="reviews-box">
            <?php
            require_once 'includes/dbh.inc.php';
            try {
                $stmt = $pdo->prepare("SELECT name, message, created_at FROM reviews ORDER BY created_at DESC LIMIT 5");
                $stmt->execute();
                $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($reviews):
                    foreach ($reviews as $review): ?>
                        <div class="p-3 mb-3 border rounded">
                            <strong><?= htmlspecialchars($review['name']) ?></strong> 
                            <small class="text-muted">on <?= date('j M Y', strtotime($review['created_at'])) ?></small>
                            <p class="mt-2"><?= nl2br(htmlspecialchars($review['message'])) ?></p>
                        </div>
                    <?php endforeach;
                else:
                    echo "<p class='text-center'>No reviews yet — be the first to share your thoughts!</p>";
                endif;
            } catch (PDOException $e) {
                echo "<p class='text-danger'>Failed to load reviews.</p>";
            }
            ?>
            </div>
        </div>
        </div>


      </main>
    </div>
  </div>

  <footer class="mt-auto">
    <div class="container">
      <p class="mb-0"><a href="mailto:skewerhousetaunton@gmail.com" class="text-warning">skewerhousetaunton@gmail.com</a></p>
      <p>
        <a href="#" class="text-light me-2"><i class="bi bi-instagram"></i></a>
        <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
      </p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="Scripts.js"></script>
</body>
</html>
