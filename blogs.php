<?php
require_once __DIR__ . '/includes/db.php';
$pageTitle = 'Blogs';
$pageDesc  = 'Read our latest articles, guides and tips for Hajj and Umrah pilgrims.';
$activePage = 'blogs';
require_once __DIR__ . '/includes/header.php';

$perPage = 6;
$page = max(1, (int)($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;

$blogs = [];
$total = 0;
try {
    $total = (int) $pdo->query("SELECT COUNT(*) c FROM blogs WHERE status=1")->fetch()['c'];
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE status=1 ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $blogs = $stmt->fetchAll();
} catch (Exception $e) { /* first run */ }

$totalPages = max(1, (int) ceil($total / $perPage));
?>

<section class="page-header">
  <div class="container">
    <h1>Blogs & Articles</h1>
    <div class="breadcrumb"><a href="index.php">Home</a> / Blogs</div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="blog-grid">
      <?php foreach ($blogs as $b): ?>
      <div class="blog-card reveal">
        <div class="img">
          <img src="<?= $b['image'] ? h($baseUrl.'/uploads/blogs/'.$b['image']) : h($baseUrl.'/assets/images/hero-slide-3.svg') ?>" alt="<?= h($b['title']) ?>">
        </div>
        <div class="content">
          <div class="meta"><?= date('d M, Y', strtotime($b['created_at'])) ?> • <?= h($b['author']) ?></div>
          <h3><?= h($b['title']) ?></h3>
          <p><?= h($b['excerpt'] ?: excerpt($b['content'], 20)) ?></p>
          <a class="read-more" href="blog-detail.php?slug=<?= h($b['slug']) ?>">Read More <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($blogs)): ?>
        <p style="grid-column:1/-1;color:var(--fh-muted)" class="text-center">No blog posts yet. Please check back soon!</p>
      <?php endif; ?>
    </div>

    <?php if ($totalPages > 1): ?>
    <div class="text-center" style="margin-top:40px;display:flex;justify-content:center;gap:10px;">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" class="btn <?= $i === $page ? 'btn-primary' : 'btn-outline' ?> btn-sm" style="<?= $i === $page ? '' : 'border-color:var(--fh-green);color:var(--fh-green);' ?>"><?= $i ?></a>
      <?php endfor; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
