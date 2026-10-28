<?php
require 'inc/lib.php';
session_start();
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    $r = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
    if ($u = $r->fetch_assoc()) {
        $_SESSION['email'] = $u['email'];
        $_SESSION['role'] = $u['role'];
        header('Location: /index.php');
        exit;
    }
    $err = 'E-mail ou mot de passe incorrect.';
}
$title = 'Connexion';
include 'inc/header.php';
?>
<div class="panel auth">
  <h1>Connexion</h1>
  <p class="muted">Accédez à votre compte SecureShop.</p>
  <?php if (isset($_GET['registered'])) { echo '<div class="alert ok">Compte créé, vous pouvez vous connecter.</div>'; } ?>
  <?php if ($err) { echo '<div class="alert err">' . $err . '</div>'; } ?>
  <form class="form" method="post" action="/login.php">
    <div class="field"><label>E-mail</label><input type="text" name="email" placeholder="vous@exemple.com"></div>
    <div class="field"><label>Mot de passe</label><input type="password" name="password"></div>
    <button class="btn block" type="submit">Se connecter</button>
  </form>
  <p class="muted center">Pas encore de compte ? <a class="link-inline" href="/register.php">Créer un compte</a></p>
</div>
<?php include 'inc/footer.php'; ?>
