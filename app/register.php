<?php
require 'inc/lib.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    $conn->query("INSERT INTO users (email, password, role) VALUES ('$email', '$pass', 'client')");
    header('Location: /login.php?registered=1');
    exit;
}
$title = 'Créer un compte';
include 'inc/header.php';
?>
<div class="panel auth">
  <h1>Créer un compte</h1>
  <p class="muted">Rejoignez SecureShop en quelques secondes.</p>
  <form class="form" method="post" action="/register.php">
    <div class="field"><label>E-mail</label><input type="text" name="email" placeholder="vous@exemple.com"></div>
    <div class="field"><label>Mot de passe</label><input type="password" name="password"></div>
    <button class="btn block" type="submit">Créer mon compte</button>
  </form>
  <p class="muted center">Déjà inscrit ? <a class="link-inline" href="/login.php">Se connecter</a></p>
</div>
<?php include 'inc/footer.php'; ?>
