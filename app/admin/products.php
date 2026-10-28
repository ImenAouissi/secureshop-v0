<?php
require __DIR__ . '/../inc/lib.php';
session_start();
if (($_SESSION['role'] ?? '') !== 'admin') { header('Location: /login.php'); exit; }

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");
    header('Location: /admin/products.php?done=1');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $desc = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $cat = $_POST['category'] ?? '';
    $icon = $_POST['icon'] ?? '📦';
    if ($id === '') {
        $conn->query("INSERT INTO products (name, description, price, stock, category, icon) VALUES ('$name', '$desc', $price, $stock, '$cat', '$icon')");
    } else {
        $conn->query("UPDATE products SET name='$name', description='$desc', price=$price, stock=$stock, category='$cat', icon='$icon' WHERE id=$id");
    }
    header('Location: /admin/products.php?done=1');
    exit;
}

$edit = null;
if (isset($_GET['edit'])) {
    $e = $_GET['edit'];
    $edit = $conn->query("SELECT * FROM products WHERE id=$e")->fetch_assoc();
}
$list = $conn->query("SELECT * FROM products ORDER BY id");

$title = 'Administration · Produits';
include __DIR__ . '/../inc/header.php';
?>
<h1 class="page-title">Administration</h1>
<?php include __DIR__ . '/../inc/adminnav.php'; ?>
<?php if (isset($_GET['done'])) { echo '<div class="alert ok">Modification enregistrée.</div>'; } ?>

<section class="panel">
  <h2><?php echo $edit ? 'Modifier le produit' : 'Ajouter un produit'; ?></h2>
  <form class="form grid2" method="post" action="/admin/products.php">
    <input type="hidden" name="id" value="<?php echo $edit['id'] ?? ''; ?>">
    <div class="field"><label>Nom</label><input type="text" name="name" value="<?php echo $edit['name'] ?? ''; ?>"></div>
    <div class="field"><label>Catégorie</label><input type="text" name="category" value="<?php echo $edit['category'] ?? ''; ?>"></div>
    <div class="field"><label>Prix (€)</label><input type="text" name="price" value="<?php echo $edit['price'] ?? ''; ?>"></div>
    <div class="field"><label>Stock</label><input type="text" name="stock" value="<?php echo $edit['stock'] ?? ''; ?>"></div>
    <div class="field"><label>Icône (emoji)</label><input type="text" name="icon" value="<?php echo $edit['icon'] ?? '📦'; ?>"></div>
    <div class="field full"><label>Description</label><textarea name="description" rows="2"><?php echo $edit['description'] ?? ''; ?></textarea></div>
    <div class="full">
      <button class="btn" type="submit"><?php echo $edit ? 'Enregistrer' : 'Ajouter'; ?></button>
      <?php if ($edit) { echo '<a class="btn ghost" href="/admin/products.php">Annuler</a>'; } ?>
    </div>
  </form>
</section>

<section class="panel tablebox">
  <h2>Catalogue (<?php echo $list->num_rows; ?>)</h2>
  <table class="table">
    <tr><th></th><th>Nom</th><th>Catégorie</th><th>Prix</th><th>Stock</th><th>Actions</th></tr>
    <?php while ($p = $list->fetch_assoc()) { ?>
      <tr>
        <td class="ico"><?php echo $p['icon']; ?></td>
        <td><?php echo $p['name']; ?></td>
        <td><?php echo $p['category']; ?></td>
        <td><?php echo money($p['price']); ?></td>
        <td><?php echo $p['stock']; ?></td>
        <td class="actions">
          <a href="/admin/products.php?edit=<?php echo $p['id']; ?>">Modifier</a>
          <a class="del" href="/admin/products.php?delete=<?php echo $p['id']; ?>">Supprimer</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</section>
<?php include __DIR__ . '/../inc/footer.php'; ?>
