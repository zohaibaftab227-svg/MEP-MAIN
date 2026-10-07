<?php
require_once __DIR__ . '/includes/db.php';
$pageTitle = 'Our Services';
$pageDesc  = 'Explore our full range of Hajj, Umrah, visa processing, flight booking, hotel reservation and Ziyarat tour services.';
$activePage = 'services';
require_once __DIR__ . '/includes/header.php';

$services = [];
try {
    $services = $pdo->query("SELECT * FROM services WHERE status=1 ORDER BY sort_order ASC")->fetchAll();
} catch (Exception $e) { /* first run */ }
?>

<section class="page-header">
  <div class="container">
    <h1>Our Services</h1>
    <div class="breadcrumb"><a href="index.php">Home</a> / Services</div>
  </div>
</section>

<section class="section">
  <div class="container text-center">
    <span class="section-tag">Complete Travel Solutions</span>
    <h2 class="section-title">Everything You Need for a Blessed Journey</h2>
    <p class="section-desc">We handle every aspect of your Hajj and Umrah trip so you can focus entirely on your Ibadah.</p>
    <div class="services-grid">
      <?php foreach ($services as $s): ?>
      <div class="service-card reveal">
        <div class="icon"><i class="fas <?= h($s['icon']) ?>"></i></div>
        <h3><?= h($s['title']) ?></h3>
        <p><?= h($s['short_desc']) ?></p>
        <?php if (!empty($s['price'])): ?><p style="font-weight:700;color:var(--fh-green)"><?= h($s['price']) ?></p><?php endif; ?>
        <a class="more" href="service-detail.php?slug=<?= h($s['slug']) ?>">View Details <i class="fas fa-arrow-right"></i></a>
      </div>
      <?php endforeach; ?>
      <?php if (empty($services)): ?>
        <p style="grid-column:1/-1;color:var(--fh-muted)">Services will appear here once added from the Admin Panel.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section-sm" style="background:#fff;">
  <div class="container">
    <div class="cta-band reveal">
      <div>
        <h3>Not Sure Which Package Fits You?</h3>
        <p>Send us a message and our travel consultants will help you choose the right service.</p>
      </div>
      <a href="https://wa.me/<?= h($whatsapp) ?>" target="_blank" rel="noopener" class="btn btn-gold"><i class="fab fa-whatsapp"></i> WhatsApp Us</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
