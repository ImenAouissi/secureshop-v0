<?php
require 'inc/lib.php';
$title = 'Catalogue';
$res = $conn->query("SELECT * FROM products");
include 'inc/header.php';
?>
<section class="hero">
  <span class="pill">Nouveautés tech</span>
  <h1>Le matériel qu'il vous faut, au meilleur prix.</h1>
  <p>Périphériques, audio, écrans et accessoires, livrés rapidement.</p>
</section>

<div class="section-head">
  <h2>Tous les produits</h2>
  <span class="muted"><?php echo $res->num_rows; ?> articles</span>
</div>
<div class="grid">
  <?php while ($p = $res->fetch_assoc()) { echo card($p); } ?>
</div>
<?php include 'inc/footer.php'; ?>
