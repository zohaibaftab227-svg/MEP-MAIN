# Fiza e Haram Travel & Tours — Website

A complete, dynamic PHP + MySQL website for a Hajj & Umrah travel agency, with a
full admin panel to manage everything.

---

## 1. What's Included

- **Public website**: Home, About, Services (list + detail), Blogs (list + detail),
  FAQ, Contact — fully responsive, animated, with a floating WhatsApp button and
  an AI chat assistant widget.
- **Admin Panel** (`/admin`): login, dashboard, Services manager, Blogs manager,
  FAQ manager, Contact messages inbox, AI Assistant knowledge base editor,
  Site Settings (edit all text/contact info site-wide), and Change Password.
- **Database**: `database/fizaeharam.sql` — import this once to create all tables
  and seed sample content (services, blogs, FAQs, default admin, etc).

---

## 2. Requirements

- PHP 7.4+ (PHP 8.x recommended) with the **PDO MySQL** extension enabled.
- MySQL 5.7+ / MariaDB 10.3+.
- Apache with `mod_rewrite`, `mod_deflate`, `mod_expires`, `mod_headers` (used by `.htaccess`).
  On Nginx or other servers, translate the `.htaccess` rules manually.

---

## 3. Installation (Local or Shared Hosting / cPanel)

1. **Upload all files** to your server (e.g. `public_html/` or a subfolder).
2. **Create a MySQL database** (e.g. `fizaeharam`) from your hosting control panel
   or phpMyAdmin.
3. **Import the database**: open phpMyAdmin → select your new database →
   Import → choose `database/fizaeharam.sql` → Go.
4. **Set your database credentials** in `includes/db.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'fizaeharam');
   define('DB_USER', 'your_db_username');
   define('DB_PASS', 'your_db_password');
   ```
5. Make sure the `uploads/services/` and `uploads/blogs/` folders are **writable**
   (chmod 755 or 775 depending on your host) — this is where images you upload
   from the Admin Panel are stored.
6. Visit your domain — the website should now be live.

No hardcoded paths are used, so the site works whether it's installed at the
domain root or inside a subfolder.

---

## 4. Admin Panel Access

- URL: `https://yourdomain.com/admin/login.php`
- Default username: **admin**
- Default password: **admin123**

**Important:** Please log in and change this password immediately from
**Admin Panel → Change Password**.

From the Admin Panel you can:
- Add/edit/delete **Services** (with images, pricing notes, descriptions).
- Add/edit/delete **Blog posts** (with a featured image and rich content).
- Add/edit/delete **FAQs**.
- View and manage **Contact form submissions**.
- Edit the **AI Assistant's** keyword-based knowledge base.
- Edit **all site-wide text and contact info** (hero title, about text, phone,
  WhatsApp number, email, Facebook/Instagram links, address) from **Site Settings**
  — no code editing needed for routine content updates.

---

## 5. About the AI Assistant

The chat bubble in the corner of the website (`ai-agent.php`) is a lightweight,
**keyword-matching assistant** driven entirely by the `ai_knowledge` database
table, editable from **Admin Panel → AI Assistant**. It doesn't require any
external API key or cost, and works out of the box.

If you'd later like a true LLM-powered agent (e.g. connected to an AI provider's
API for open-ended conversation), a developer can extend `ai-agent.php` — the
file already includes comments showing exactly where to plug that in, while
keeping the same simple JSON response format the frontend expects.

---

## 6. Hero Background Artwork

The animated homepage hero currently uses custom-illustrated SVG night-sky /
Kaaba-silhouette artwork (`assets/images/hero-slide-1.svg`, `-2.svg`, `-3.svg`)
that gently crossfades — this avoids any copyright issues from using photos we
don't have licensing rights to. If you have your own high-resolution, licensed
Kaaba/Haramain photographs, simply replace these three files (keep the same
filenames, or update the `background-image` paths in `index.php`) for a fully
photographic hero slideshow.

---

## 7. Logo, Favicon & Branding

Your uploaded logo (`assets/images/logo.jpg`) is automatically used as:
- The website favicon (shows in the browser tab and Google search results once indexed).
- The header and footer logo.
- The Open Graph share image (shown when the site is shared on social media).

---

## 8. SEO & Technical Health

To keep the site free of common SEO/audit errors, the following are already in place:
- Unique `<title>` and meta description per page, canonical tags, Open Graph tags.
- `robots.txt` and a **dynamic** `sitemap.php` (auto-includes every service & blog post).
- Custom 404 and 500 error pages.
- `.htaccess` with GZIP compression, browser caching, and security headers.
- Semantic HTML, descriptive `alt` attributes on images, a single `<h1>` per page,
  proper viewport meta tag, and UTF-8 declared encoding.
- All forms use prepared statements (PDO) to prevent SQL injection; output is
  escaped with `htmlspecialchars()` to prevent XSS.

**Note:** A number of the issues in the audit list you shared (SSL certificate
status, HSTS, DNS, sitemap submission in Google Search Console, server response
codes) depend on your **hosting/server configuration and domain setup**, not the
application code — these should be checked once the site is live on your actual
domain with SSL enabled.

---

## 9. Folder Structure

```
/
├── index.php, about.php, services.php, service-detail.php,
│   blogs.php, blog-detail.php, faq.php, contact.php
├── ai-agent.php          # AI chat backend
├── sitemap.php           # dynamic XML sitemap
├── 404.php, 500.php      # error pages
├── includes/             # db.php, functions.php, header.php, footer.php
├── admin/                # full admin panel
│   └── includes/         # auth.php, admin_header.php, admin_footer.php
├── assets/
│   ├── css/ (style.css, admin.css)
│   ├── js/  (main.js)
│   └── images/ (logo.jpg, hero-slide-*.svg)
├── uploads/
│   ├── services/         # service images uploaded via admin
│   └── blogs/            # blog images uploaded via admin
└── database/fizaeharam.sql
```

---

## 10. Quick Content Checklist After Going Live

1. Change the admin password.
2. Update Site Settings with your final phone/WhatsApp/email/social links (already pre-filled with the details you provided, but double check).
3. Replace sample services/blogs with your real content, or edit the seeded ones.
4. Replace the hero SVG artwork with real photos if you have licensed images.
5. Enable HTTPS/SSL on your domain, then uncomment the force-HTTPS lines in `.htaccess`.
6. Submit `sitemap.php` to Google Search Console.

اردو خلاصہ: تمام ویب سائٹ فائلیں اپلوڈ کریں، ڈیٹا بیس `database/fizaeharam.sql` امپورٹ
کریں، `includes/db.php` میں اپنی ڈیٹا بیس تفصیلات درج کریں، اور `/admin/login.php` پر
یوزرنیم **admin** اور پاسورڈ **admin123** سے لاگ ان ہو کر پاسورڈ فوری تبدیل کر لیں۔
