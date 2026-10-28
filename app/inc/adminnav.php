<?php $cur = basename($_SERVER['SCRIPT_NAME']); ?>
<div class="tabs">
  <a class="<?php echo $cur == 'index.php' ? 'on' : ''; ?>" href="/admin/index.php">Tableau de bord</a>
  <a class="<?php echo $cur == 'products.php' ? 'on' : ''; ?>" href="/admin/products.php">Produits</a>
  <a class="<?php echo $cur == 'users.php' ? 'on' : ''; ?>" href="/admin/users.php">Utilisateurs</a>
</div>
