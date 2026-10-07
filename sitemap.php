<?php
/**
 * Dynamic XML Sitemap
 * Automatically includes all static pages, services and blog posts.
 */
require_once __DIR__ . '/includes/db.php';

header('Content-Type: application/xml; charset=utf-8');

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$baseUrl = $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

$staticPages = ['index.php', 'about.php', 'services.php', 'blogs.php', 'faq.php', 'contact.php'];

$services = [];
$blogs = [];
try {
    $services = $pdo->query("SELECT slug, updated_at FROM services WHERE status=1")->fetchAll();
    $blogs = $pdo->query("SELECT slug, updated_at FROM blogs WHERE status=1")->fetchAll();
} catch (Exception $e) {}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($staticPages as $page) {
    echo "  <url><loc>" . htmlspecialchars($baseUrl . '/' . $page) . "</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>\n";
}
foreach ($services as $s) {
    $loc = $baseUrl . '/service-detail.php?slug=' . urlencode($s['slug']);
    echo "  <url><loc>" . htmlspecialchars($loc) . "</loc><lastmod>" . date('Y-m-d', strtotime($s['updated_at'])) . "</lastmod><priority>0.7</priority></url>\n";
}
foreach ($blogs as $b) {
    $loc = $baseUrl . '/blog-detail.php?slug=' . urlencode($b['slug']);
    echo "  <url><loc>" . htmlspecialchars($loc) . "</loc><lastmod>" . date('Y-m-d', strtotime($b['updated_at'])) . "</lastmod><priority>0.6</priority></url>\n";
}

echo '</urlset>';
