<?php
require 'inc/lib.php';
session_start();
$id = $_GET['id'] ?? 1;
$res = $conn->query("SELECT * FROM products WHERE id=$id");
$p = $res->fetch_assoc();
$msg = '';

if ($p && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['email'])) {
    $who = $_SESSION['email'];
    $rating = $_POST['rating'] ?? 5;
    $comment = $_POST['comment'] ?? '';
    $conn->query("INSERT INTO reviews (product_id, user_email, rating, comment) VALUES ($id, '$who', $rating, '$comment')");
    $msg = 'Merci, votre avis est publié.';
}

$title = $p ? $p['name'] : 'Produit introuvable';
include 'inc/header.php';

if (!$p) {
    echo '<div class="panel empty">Produit introuvable.<br><a class="btn" href="/index.php">Retour au catalogue</a></div>';
    include 'inc/footer.php';
    exit;
}
$reviews = $conn->query("SELECT * FROM reviews WHERE product_id=$id ORDER BY id DESC");
?>
<a class="back" href="/index.php">&larr; Retour au catalogue</a>
<section class="detail">
  <div class="tile big"><?php echo $p['icon']; ?></div>
  <div>
    <span class="cat"><?php echo $p['category']; ?></span>
    <h1><?php echo $p['name']; ?></h1>
    <p class="lead"><?php echo $p['description']; ?></p>
    <div class="price"><?php echo money($p['price']); ?></div>
    <?php if ($p['stock'] > 0) { ?>
      <span class="badge ok"><?php echo $p['stock']; ?> en stock</span>
    <?php } else { ?>
      <span class="badge no">Rupture de stock</span>
    <?php } ?>
  </div>
</section>

<section class="panel">
  <h2>Avis clients</h2>
  <?php if ($msg) { echo '<div class="alert ok">' . $msg . '</div>'; } ?>
  <?php while ($r = $reviews->fetch_assoc()) { ?>
    <div class="review">
      <div><span class="stars"><?php echo str_repeat('★', (int)$r['rating']); ?></span>
        <strong><?php echo $r['user_email']; ?></strong></div>
      <p><?php echo $r['comment']; ?></p>
    </div>
  <?php } ?>

  <?php if (isset($_SESSION['email'])) { ?>
    <form class="form" method="post" action="/product.php?id=<?php echo $id; ?>">
      <h3>Donner votre avis</h3>
      <div class="field">
        <label>Note</label>
        <select name="rating">
          <option value="5">5 - Excellent</option>
          <option value="4">4 - Très bien</option>
          <option value="3">3 - Correct</option>
          <option value="2">2 - Décevant</option>
          <option value="1">1 - Mauvais</option>
        </select>
      </div>
      <div class="field">
        <label>Commentaire</label>
        <textarea name="comment" rows="3"></textarea>
      </div>
      <button class="btn" type="submit">Publier mon avis</button>
    </form>
  <?php } else { ?>
    <p class="muted"><a class="link-inline" href="/login.php">Connectez-vous</a> pour publier un avis.</p>
  <?php } ?>
</section>
<?php include 'inc/footer.php'; ?>
