<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$blog = null;
try {
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE slug = ? AND status = 1 LIMIT 1");
    $stmt->execute([$slug]);
    $blog = $stmt->fetch();
} catch (Exception $e) {}

if (!$blog) {
    http_response_code(404);
    $pageTitle = 'Blog Not Found';
    require_once __DIR__ . '/includes/header.php';
    echo '<section class="section text-center"><div class="container"><h2>Blog Post Not Found</h2><p>The article you are looking for does not exist or has been removed.</p><a href="blogs.php" class="btn btn-primary">Back to Blogs</a></div></section>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $blog['title'];
$pageDesc  = $blog['excerpt'] ?: excerpt($blog['content'], 25);
$activePage = 'blogs';
require_once __DIR__ . '/includes/header.php';

$recent = [];
try {
    $stmt = $pdo->prepare("SELECT title, slug, created_at FROM blogs WHERE status=1 AND id != ? ORDER BY created_at DESC LIMIT 4");
    $stmt->execute([$blog['id']]);
    $recent = $stmt->fetchAll();
} catch (Exception $e) {}
?>

<section class="page-header">
  <div class="container">
    <h1><?= h($blog['title']) ?></h1>
    <div class="breadcrumb"><a href="index.php">Home</a> / <a href="blogs.php">Blogs</a> / <?= h($blog['title']) ?></div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="about-grid" style="align-items:start;">
      <div class="reveal" style="grid-column:1/-1;max-width:850px;margin:0 auto;">
        <div class="frame" style="margin-bottom:30px;">
          <img src="<?= $blog['image'] ? h($baseUrl.'/uploads/blogs/'.$blog['image']) : h($baseUrl.'/assets/images/hero-slide-1.svg') ?>" alt="<?= h($blog['title']) ?>">
        </div>
        <div class="meta" style="margin-bottom:14px;color:var(--fh-gold);font-weight:600;">
          <i class="fas fa-user"></i> <?= h($blog['author']) ?> &nbsp;•&nbsp;
          <i class="fas fa-calendar"></i> <?= date('d M, Y', strtotime($blog['created_at'])) ?>
        </div>
        <div style="color:var(--fh-text);line-height:1.9;font-size:16px;">
          <?= $blog['content'] /* trusted content, entered via Admin Panel */ ?>
        </div>

        <?php if ($recent): ?>
        <div style="margin-top:60px;border-top:1px solid #eee;padding-top:30px;">
          <h3 style="margin-bottom:20px;">More Articles</h3>
          <ul class="about-list">
            <?php foreach ($recent as $r): ?>
              <li><i class="fas fa-angle-right"></i> <a href="blog-detail.php?slug=<?= h($r['slug']) ?>" style="font-weight:600;"><?= h($r['title']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
