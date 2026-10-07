<?php
require_once __DIR__ . '/includes/db.php';
$pageTitle = 'Frequently Asked Questions';
$pageDesc  = 'Find answers to common questions about our Hajj and Umrah packages, visa processing, payments and more.';
$activePage = 'faq';
require_once __DIR__ . '/includes/header.php';

$faqs = [];
try {
    $faqs = $pdo->query("SELECT * FROM faqs WHERE status=1 ORDER BY sort_order ASC")->fetchAll();
} catch (Exception $e) {}
?>

<section class="page-header">
  <div class="container">
    <h1>Frequently Asked Questions</h1>
    <div class="breadcrumb"><a href="index.php">Home</a> / FAQ</div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="faq-list">
      <?php foreach ($faqs as $i => $f): ?>
      <div class="faq-item reveal <?= $i === 0 ? 'active' : '' ?>">
        <div class="faq-question"><?= h($f['question']) ?> <i class="fas fa-chevron-down"></i></div>
        <div class="faq-answer"><p><?= h($f['answer']) ?></p></div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($faqs)): ?>
        <p class="text-center" style="color:var(--fh-muted)">FAQs will appear here once added from the Admin Panel.</p>
      <?php endif; ?>
    </div>

    <div class="text-center" style="margin-top:50px;">
      <p style="color:var(--fh-muted)">Still have questions?</p>
      <a href="contact.php" class="btn btn-primary">Contact Our Team</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
