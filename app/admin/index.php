<?php
require __DIR__ . '/../inc/lib.php';
session_start();
if (($_SESSION['role'] ?? '') !== 'admin') { header('Location: /login.php'); exit; }

$nbProducts = $conn->query("SELECT COUNT(*) AS n FROM products")->fetch_assoc()['n'];
$nbUsers    = $conn->query("SELECT COUNT(*) AS n FROM users")->fetch_assoc()['n'];
$nbReviews  = $conn->query("SELECT COUNT(*) AS n FROM reviews")->fetch_assoc()['n'];
$nbOut      = $conn->query("SELECT COUNT(*) AS n FROM products WHERE stock = 0")->fetch_assoc()['n'];
$latest     = $conn->query("SELECT * FROM reviews ORDER BY id DESC LIMIT 5");

$title = 'Administration';
include __DIR__ . '/../inc/header.php';
?>
<h1 class="page-title">Administration</h1>
<?php include __DIR__ . '/../inc/adminnav.php'; ?>

<div class="stats">
  <div class="stat"><span>Produits</span><strong><?php echo $nbProducts; ?></strong></div>
  <div class="stat"><span>Utilisateurs</span><strong><?php echo $nbUsers; ?></strong></div>
  <div class="stat"><span>Avis clients</span><strong><?php echo $nbReviews; ?></strong></div>
  <div class="stat warn"><span>Ruptures de stock</span><strong><?php echo $nbOut; ?></strong></div>
</div>

<section class="panel">
  <h2>Derniers avis</h2>
  <?php while ($r = $latest->fetch_assoc()) { ?>
    <div class="review">
      <span class="stars"><?php echo str_repeat('★', (int)$r['rating']); ?></span>
      <strong><?php echo $r['user_email']; ?></strong>
      <p><?php echo $r['comment']; ?></p>
    </div>
  <?php } ?>
</section>
<?php include __DIR__ . '/../inc/footer.php'; ?>
