<?php
include("include/entete.inc.php");
if ($_SESSION['login'] != true) {
  header("Location:connexion.php");
}
?>
<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Page des utilisateurs de PhotoForYou</h1>
    <p class="lead">Vous êtes Connecté</p>
    <hr class="my-4">
  </div>
  <?php
  include("include/piedDePage.inc.php");
  ?>