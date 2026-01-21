<?php
  $page = $system->router->getCurrentPage();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?= ucfirst($page) ?> | Aggregator</title>

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <!-- Global custom styles -->
  <link rel="stylesheet" href="<?= PROJECT_URL ?>/layouts/assets/styles/main.css">
  <link rel="stylesheet" href="<?= PROJECT_URL ?>/layouts/assets/styles/navbar.css">
  <link rel="stylesheet" href="<?= PROJECT_URL ?>/layouts/assets/styles/footer.css">

  <!-- Page custom styles -->
  <?php if (file_exists(CSS_PATH . $page . '.css')): ?>
    <link rel="stylesheet" href="<?= PROJECT_URL ?>/layouts/assets/styles/<?= $page ?>.css">
  <?php endif; ?>
</head>
<body>

<header class="navbar">
  <div class="navbar-inner">

    <div class="navbar-logo">
      <a href="<?= PROJECT_URL ?>">🧭 TravelSys</a>
    </div>

    <nav class="navbar-menu">
      <a href="?page=home" class="<?= $page === 'home' ? 'active' : '' ?>">Kezdőlap</a>
      <a href="?page=trips" class="<?= $page === 'trips' ? 'active' : '' ?>">Utazási tervek</a>
    </nav>

    <div class="navbar-actions">
      <a href="?page=auth-google" class="btn btn-google">
        <i class="fab fa-google"></i> Bejelentkezés Google-lel
      </a>
    </div>

  </div>
</header>

<main class="container">