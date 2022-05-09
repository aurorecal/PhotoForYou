<?php
session_start();
if (!isset($_SESSION['type'])) {
  $_SESSION['type'] = "visiteur";
}
require_once('accessbase.php');

// echo $_SESSION['type'];
?>
<!DOCTYPE html>
<html>

<head>
  <title>PhotoForYou</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Liaison au fichier css de Bootstrap -->
  <link href="Bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <style>
    .carousel-item {
      width: 100%;
      height: auto;
      background-color: #5f666d;
      color: white;
    }
  </style>
  <link href="css/perso.css" rel="stylesheet">
</head>

<body>
  <header>
    <!-- nav est un élément HTML servant à la navigation -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

      <a class="navbar-brand" href="index.php">PhotoForYou</a>
      <!-- Pour passer en mode hamburger si on est sur un petit écran -->

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>




      <?php
      // On regarde le niveau d'habilitation
      // include("accessbase.php");
      // switch ($_SESSION['type']) {
      //   case "client":
      //     $niveauHab = "%C%";
      //     break;
      //   case "photographe":
      //     $niveauHab = "%P%";
      //     break;
      //   case "visiteur":
      //     $niveauHab = "%V%";
      //     break;
      //   case "admin":
      //     $niveauHab = "%A%";
      //     break;
      // }

      // $niveauHab = isset($_POST['valeur']); 

      // // On récupère l'ensemble des itérations dans Menu
      // $requete = "SELECT id_menu, nom_menu, lien from menu where habilitation LIKE '" . $niveauHab . "'";
      // $instruction = $db->prepare($requete);
      // $instruction->execute();
      // $num = $instruction->fetchAll(); // Tout se trouve maintenant dans le tableau $num
      ?>


      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">

          <!-- Afficher la navbar en fonction de son statut -->

          <?php
          if (!isset($_SESSION['login'])) {
            echo '
            <ul class="navbar-nav mr-right">
              <li class="nav-item">
                <a class="nav-link btn btn-outline-dark" href="inscription.php">S\'inscrire</a></li>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-dark"  type="submit"  href="connexion.php">S\'identifier</a>
              </li>
            </ul>
            ';
          } else {
            echo '
             <ul class="nav navbar-nav navbar-right" style="position: fixed;right: 10px; top : 15px">
              <li class="nav-item">
                <a href="deconnexion.php"  type="submit" value="Deconnexion"  class="btn btn-primary" name="deconnexion" /> Déconnexion</a>
              </li>
            </ul>
            ';
          }
          ?>
          <?php
          switch ($_SESSION['type']) {
              //  case "visiteur":
              //   echo '
              //       <li class="nav-item"></li>
              //   ';break;
            case "client":
              //le client peut voir son profil, acheter des photos et des crédits, visualiser la galerie et voir les photos acheter
              echo '
              <nav class="navbar navbar-light">
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">

                      <a class="nav-link" href="consulProfil.php"/> Profil</a>
                      <a class="nav-link" href="acheterPhotos.php"/> Acheter Photos</a>
                      <a class="nav-link" href="achetercredits.php"/> Acheter Crédits </a>
                      <a class="nav-link" href="mesphotos.php"/> Ma blibliothéque </a>
                      
                    </div>
                  </div>
                </div>
              </nav>

                ';
              break;

            case "photographe":
              //le photographe peut voir son profil, ajouter des photos, voir ses photos postés
              echo '
              <nav class="navbar navbar-light" >
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">

                      <a class="nav-link" href="consulProfil.php"/> Profil</a>
                      <a class="nav-link" href="ajoutPhoto.php"/> Vendre mes photos</a>
                      <a class="nav-link"  href="suppUser.php"/> Parametres </a>
                      
                      
                    </div>
                  </div>
                </div>
              </nav>


                ';
              break;

            case "admin":
              // Accés à tout
              echo '
                  <nav class="navbar navbar-light">
                  <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                      <div class="navbar-nav">
  
                        <a class="nav-link"  href="consulProfil.php"/> Profil</a>
                        <a class="nav-link"  href="suppUser.php"/> Parametres </a>
                        
                        
                      </div>
                    </div>
                  </div>
                </nav>
                  ';
              break;
          } ?>
          </form>
      </div>
    </nav>
    <?php
    // echo ($_SESSION['type'])
    ?>
  </header>