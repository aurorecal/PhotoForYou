<?php
include("include/entete.inc.php");

if ($_SESSION['type'] == 'admin') { // protection seulement ceux qui sont connecté et qui sont de type admin ont accés à cette page

  if ($_SESSION['login'] != true) {
    header("Location:connexion.php");
  }
?>
  <div class="container">
    <div class="jumbotron">
      <h1 class="display-4">Suppression d'un utilisateur ou d'une image </h1>
      <p class="lead text-center ">!!! Attention suppression !!!</p>
    </div>

    <?php
    if (isset($_GET['suppuser'])) {
      $sql1 = "DELETE from users where id_users = '" . $_GET['suppuser'] . "'";
      $req1 = $db->query($sql1);
      $sql2 = "DELETE from images where id_photographe = '" . $_GET['suppuser'] . "'";
      $req2 = $db->query($sql2);
    }
    if (isset($_GET['suppimage'])) {
      $sql1 = "DELETE from images where id = '" . $_GET['suppimage'] . "'";
      $req1 = $db->query($sql1);
    }

    $req = $db->prepare('select * from users');
    $req->execute();
    ?>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Action</th>
          <th scope="col">Mail utilisateur</th>
        </tr>

        <?php
        while ($user = $req->fetch(PDO::FETCH_OBJ)) {


        ?>
          <tr>
            <td>
              <a class="btn btn-primary" href="?suppuser=<?php echo $user->id_users; ?>"> Supprimer</a>
            </td>
            <td>
              <?php echo $user->mail; ?>
            </td>
          </tr>

        <?php
        }
        ?>
    </table>

    <?php

    $req = $db->prepare('select * from images');
    $req->execute();
    ?>

    <br>

    <table class="table">
      <thead class="thead-light">

        <tr>
          <th scope="col">Action</th>
          <th scope="col"> Titre de l'image </th>
        </tr>


        <?php
        while ($image = $req->fetch(PDO::FETCH_OBJ)) {

        ?>
          <tr>
            <td>
              <a class="btn btn-primary" href="?suppimage=<?php echo $image->id; ?>"> Supprimer </a>
            </td>
            <td>
              <?php echo $image->titre; ?>
            </td>
          </tr>

        <?php
        }
        ?>
    </table>
  </div>

<?php
} else {

  echo '<div class="container" >vous n\'avez pas accés à cette page</div>';
}
include("include/piedDePage.inc.php");
?>