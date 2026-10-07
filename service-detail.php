<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$service = null;
try {
    $stmt = $pdo->prepare("SELECT * FROM services WHERE slug = ? AND status = 1 LIMIT 1");
    $stmt->execute([$slug]);
    $service = $stmt->fetch();
} catch (Exception $e) { /* first run */ }

if (!$service) {
    http_response_code(404);
    $pageTitle = 'Service Not Found';
    require_once __DIR__ . '/includes/header.php';
    echo '<section class="section text-center"><div class="container"><h2>Service Not Found</h2><p>The service you are looking for does not exist or has been removed.</p><a href="services.php" class="btn btn-primary">Back to Services</a></div></section>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $service['title'];
$pageDesc  = $service['short_desc'];
$activePage = 'services';
require_once __DIR__ . '/includes/header.php';

$otherServices = [];
try {
    $stmt = $pdo->prepare("SELECT title, slug, icon FROM services WHERE status=1 AND id != ? ORDER BY sort_order ASC LIMIT 5");
    $stmt->execute([$service['id']]);
    $otherServices = $stmt->fetchAll();
} catch (Exception $e) {}
?>

<section class="page-header">
  <div class="container">
    <h1><?= h($service['title']) ?></h1>
    <div class="breadcrumb"><a href="index.php">Home</a> / <a href="services.php">Services</a> / <?= h($service['title']) ?></div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="about-grid">
      <div class="reveal" style="order:2;">
        <div class="icon" style="width:80px;height:80px;border-radius:20px;background:linear-gradient(135deg,var(--fh-green),var(--fh-green-light));display:flex;align-items:center;justify-content:center;color:var(--fh-gold-light);font-size:34px;margin-bottom:20px;">
          <i class="fas <?= h($service['icon']) ?>"></i>
        </div>
        <h2 class="section-title"><?= h($service['title']) ?></h2>
        <?php if (!empty($service['price'])): ?>
          <p class="badge-live" style="margin-bottom:16px;"><span class="dot"></span> <?= h($service['price']) ?></p>
        <?php endif; ?>
        <div style="color:var(--fh-muted);line-height:1.8;"><?= nl2br(h($service['description'])) ?></div>
        <a href="contact.php" class="btn btn-primary" style="margin-top:24px;">Book This Service</a>
        <a href="https://wa.me/<?= h($whatsapp) ?>?text=<?= urlencode('Assalam-o-Alaikum, I am interested in: ' . $service['title']) ?>" target="_blank" rel="noopener" class="btn btn-outline" style="margin-top:24px;border-color:var(--fh-green);color:var(--fh-green);">
          <i class="fab fa-whatsapp"></i> Ask on WhatsApp
        </a>
      </div>
      <div class="about-media reveal" style="order:1;">
        <div class="frame">
          <img src="<?= h($baseUrl) ?>/assets/images/hero-slide-2.svg" alt="<?= h($service['title']) ?>">
        </div>
      </div>
    </div>

    <?php if ($otherServices): ?>
    <div style="margin-top:70px;">
      <h3 class="text-center" style="margin-bottom:30px;">Other Services</h3>
      <div class="services-grid">
        <?php foreach ($otherServices as $o): ?>
        <div class="service-card reveal">
          <div class="icon"><i class="fas <?= h($o['icon']) ?>"></i></div>
          <h3><?= h($o['title']) ?></h3>
          <a class="more" href="service-detail.php?slug=<?= h($o['slug']) ?>">View Details <i class="fas fa-arrow-right"></i></a>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
