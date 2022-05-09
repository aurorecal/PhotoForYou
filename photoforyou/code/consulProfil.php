<?php
include("include/entete.inc.php");
include("include/bdd_credits.php");
include('include/accessbase.php');
if ($_SESSION['login'] != true or $_SESSION['type'] == 'visiteur') {
  header("Location:connexion.php");
}
?>

<div class="container">
  <div class="jumbotron">

    <h1 class="display-4">Votre profil de <?php echo $_SESSION['type'] ?></h1>
    <?php echo '<p class="lead">Bonjour ' . $_SESSION['nom'] . ' !</p>' ?>

    <hr class="my-4">

    <?php echo "<p class='lead'>Nom : " . $_SESSION['nom'] . "</p>" ?>
    <?php echo "<p class='lead'>Prénom : " . $_SESSION['prenom'] . "</p>" ?>
    <?php echo "<p class='lead'>Courriel : " . $_SESSION['mail'] . "</p>" ?>
    <?php echo "<p class='lead'>Vos crédits : " . $_SESSION['credit'] . "</p>" ?>
  </div>
  <?php
  include("include/piedDePage.inc.php");
  ?>