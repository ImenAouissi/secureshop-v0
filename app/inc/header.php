<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$user = $_SESSION['email'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?? 'Boutique'; ?> · SecureShop</title>
  <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<div class="lab">Laboratoire pédagogique : version v0 volontairement vulnérable. Ne jamais exposer sur Internet.</div>
<header class="nav">
  <div class="wrap nav-in">
    <a class="brand" href="/index.php"><span class="logo">🛡️</span>SecureShop</a>
    <form class="search" action="/search.php" method="get">
      <input type="text" name="q" placeholder="Rechercher un produit...">
      <button type="submit">Rechercher</button>
    </form>
    <nav class="links">
      <a href="/index.php">Catalogue</a>
      <?php if ($user) { ?>
        <span class="who"><?php echo $user; ?></span>
        <a class="btn ghost" href="/logout.php">Déconnexion</a>
      <?php } else { ?>
        <a href="/login.php">Connexion</a>
        <a class="btn" href="/register.php">Créer un compte</a>
      <?php } ?>
    </nav>
  </div>
</header>
<main class="wrap">
