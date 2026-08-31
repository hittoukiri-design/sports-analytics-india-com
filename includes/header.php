<?php
require_once __DIR__ . '/config.php';
$meta = page_meta($meta ?? []);
$body_class = $body_class ?? '';
?>
<!doctype html>
<html lang="en-IN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($meta['title']) ?></title>
  <meta name="description" content="<?= e($meta['description']) ?>">
  <meta name="robots" content="<?= e($meta['robots'] ?? 'index, follow') ?>">
  <link rel="canonical" href="<?= e($meta['canonical']) ?>">
  <link rel="icon" href="/assets/img/favicon-32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/assets/img/favicon-64.png" sizes="64x64" type="image/png">
  <link rel="shortcut icon" href="/favicon.png" type="image/png">
  <link rel="apple-touch-icon" href="/assets/img/favicon-192.png">
  <link rel="preload" href="/assets/css/styles.css?v=2026051101" as="style">
  <link rel="stylesheet" href="/assets/css/styles.css?v=2026051101">
  <meta property="og:title" content="<?= e($meta['title']) ?>">
  <meta property="og:description" content="<?= e($meta['description']) ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= e($meta['canonical']) ?>">
  <meta property="og:image" content="<?= e($site['url']) ?>/assets/img/bobi-gamehub-logo.webp">
  <meta name="twitter:card" content="summary_large_image">
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "<?= e($site['name']) ?>",
    "url": "<?= e($site['url']) ?>",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "<?= e($site['url']) ?>/search/?q={search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
  </script>
  <?php if (!empty($schema_items) && is_array($schema_items)): ?>
  <script type="application/ld+json">
  <?= json_encode(['@context' => 'https://schema.org', '@graph' => $schema_items], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
  </script>
  <?php endif; ?>
</head>
<body class="<?= e($body_class) ?>" data-register-url="<?= e($site['register_url']) ?>" data-visit-endpoint="/api/visit-signal.php">
  <a class="skip-link" href="#main">Skip to content</a>
  <header class="site-header">
    <div class="top-strip">
      <span>Independent GameHub guide</span>
      <span>India betting games</span>
      <span>Fast UPI access</span>
      <span>18+ play responsibly</span>
    </div>
    <nav class="nav-shell" aria-label="Main navigation">
      <a class="brand" href="/" aria-label="Best Online Betting India home">
        <img src="/assets/img/bobi-gamehub-logo-header.webp" alt="Best Online Betting India" width="128" height="128">
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-menu">Menu</button>
      <div class="nav-menu" id="site-menu">
        <a href="/" class="nav-item">Home</a>
        <a href="/best-online-betting-india/" class="nav-item">Best Betting</a>
        <a href="/aviator-betting-india/" class="nav-item">Aviator</a>
        <a href="/teen-patti-online/" class="nav-item">Teen Patti</a>
        <a href="/fast-withdrawal-betting-india/" class="nav-item">Withdraw</a>
        <a href="/blog/" class="nav-item">Guides</a>
      </div>
      <div class="nav-actions">
        <a class="btn btn-primary" href="<?= e($site['register_url']) ?>" rel="nofollow noopener" target="_blank">Open Register</a>
      </div>
    </nav>
  </header>
  <main id="main">
