<?php
require_once __DIR__ . '/includes/db.php';
http_response_code(404);
$pageTitle = 'Page Not Found';
$pageDesc = 'The page you are looking for could not be found.';
require_once __DIR__ . '/includes/header.php';
?>
<section class="section text-center" style="padding:120px 0;">
  <div class="container">
    <h1 style="font-size:100px;color:var(--fh-gold);margin-bottom:0;">404</h1>
    <h2>Page Not Found</h2>
    <p style="color:var(--fh-muted);max-width:500px;margin:0 auto 30px;">Sorry, the page you are looking for doesn't exist or has been moved.</p>
    <a href="<?= h($baseUrl) ?>/index.php" class="btn btn-primary">Back to Home</a>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
