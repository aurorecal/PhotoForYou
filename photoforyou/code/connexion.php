<?php
include("include/entete.inc.php");
require_once('include/accessbase.php');
?>
<div class="container">
  <?php
  if (isset($_POST['identifier'])) {
    $mail =  htmlentities($_POST['mail']);
    $motdepasse = md5($_POST['motdepasse']);
    $requete = 'SELECT id_users from PhotoForYou.users where mail = :mail and mdp = :motDePasse';
    $instruction = $db->prepare($requete);
    $instruction->bindParam(':mail', $mail, PDO::PARAM_STR);
    $instruction->bindParam(':motDePasse', $motdepasse, PDO::PARAM_STR);
    $instruction->execute();
    $num = $instruction->fetchAll();

    if (count($num) > 0) {
      /* On récupère le prénom pour le message d'acceuil */
      $_SESSION['login'] = true;

      //Modif On se reconnecte à la db pour récupérer le type des users
      $sql1 = "SELECT * from users where mail = '$mail';";
      $req = $db->query($sql1);
      $result = $req->fetch();
      //création des sessions
      $_SESSION['type'] = htmlentities($result['type']);
      $_SESSION['nom'] = htmlentities($result['nom']);
      $_SESSION['prenom'] = htmlentities($result['prenom']);
      $_SESSION['mail'] = htmlentities($result['mail']);
      $_SESSION['credit'] = htmlentities($result['credit']);
      $_SESSION['id'] = htmlentities($result['id_users']);

      header('Location: membres.php'); // renvoit sur la page membres pour confirmer qu'on est bien connecté
    } else {
      echo "<p class='lead'>Utilisateur inconnu</p>";
    }
  }
  ?>
  <!--Mise en page de connexion -->
  <div class="jumbotron">
    <h1 class="display-4">Connexion</h1>
    <p class="lead">Merci de vous identifier</p>
  </div>
  <form method="post" id="formId" novalidate>
    <div class="form-group row">
      <div class="col-md-4 mb-3">
        <label for="email">Adresse électronique : </label>
        <input type="text" class="form-control" name="mail" id="email">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-4 mb-3">
        <label for="motDePasse1">Mot de passe :</label>
        <input type="password" class="form-control" name="motdepasse">
      </div>
      <div class="invalid-feedback">
        Vous devez fournir un mot de passe.
      </div>
    </div>
    <input type="submit" value="Valider" class="btn btn-primary" name="identifier" />
  </form>
</div>

<?php
include("include/piedDePage.inc.php");
?>