<?php
require __DIR__ . '/../inc/lib.php';
session_start();
if (!isset($_SESSION['email'])) { header('Location: /login.php'); exit; }

$list = $conn->query("SELECT * FROM users ORDER BY id");
$title = 'Administration · Utilisateurs';
include __DIR__ . '/../inc/header.php';
?>
<h1 class="page-title">Administration</h1>
<?php include __DIR__ . '/../inc/adminnav.php'; ?>

<section class="panel tablebox">
  <h2>Utilisateurs (<?php echo $list->num_rows; ?>)</h2>
  <table class="table">
    <tr><th>ID</th><th>E-mail</th><th>Mot de passe</th><th>Rôle</th></tr>
    <?php while ($u = $list->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $u['id']; ?></td>
        <td><?php echo $u['email']; ?></td>
        <td><code><?php echo $u['password']; ?></code></td>
        <td><span class="role <?php echo $u['role']; ?>"><?php echo $u['role']; ?></span></td>
      </tr>
    <?php } ?>
  </table>
</section>
<?php include __DIR__ . '/../inc/footer.php'; ?>
