<?php
require 'inc/lib.php';
$q = $_GET['q'] ?? '';
$res = $conn->query("SELECT * FROM products WHERE name LIKE '%$q%' OR category LIKE '%$q%'");
$title = 'Recherche';
include 'inc/header.php';
?>
<div class="section-head">
  <h2>Résultats pour : <?php echo $q; ?></h2>
  <span class="muted"><?php echo $res->num_rows; ?> résultat(s)</span>
</div>
<?php if ($res->num_rows === 0) { ?>
  <div class="panel empty">Aucun produit ne correspond à votre recherche.<br><a class="btn" href="/index.php">Voir le catalogue</a></div>
<?php } else { ?>
  <div class="grid">
    <?php while ($p = $res->fetch_assoc()) { echo card($p); } ?>
  </div>
<?php } ?>
<?php include 'inc/footer.php'; ?>
