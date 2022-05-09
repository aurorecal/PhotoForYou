<?php
require_once('include/entete.inc.php');
?>

<?php
require_once('include/accessbase.php');

$id = $_GET['id'];
$sql = "SELECT * from images where id = '$id'";
$req = $db->query($sql);
$result = $req->fetch(PDO::FETCH_OBJ);
$message = "";
//echo $result->titre;


if (isset($_POST['acheter'])) {
    $credit = $_SESSION['credit'];
    $prix = $result->credit_image;


    $newCredit = $credit - $prix;

    $idOwner = $_SESSION['id'];
    if ($credit > $prix) {


        $sql = $db->prepare("UPDATE users SET credit = " . $newCredit . " WHERE id_users = '$idOwner'");
        echo $idOwner;
        $sql->execute();
        $_SESSION['credit'] = $newCredit;

        $req2 = $db->prepare("UPDATE images SET statut = 1, id_proprio = " . $idOwner . " WHERE id = '$id'");
        $req2->execute();
        $message = "achat effectué";
    } else {
        $message = "Pas assez de crédit !";
    }
}
?>
<div class="container">


    <?php
    $req = $db->prepare("select * from images WHERE id = '$id'");
    $req->execute();

    while ($reponse = $req->fetch(PDO::FETCH_OBJ)) {
        if ($reponse->statut == 0) {

    ?>

            <div class="d-grid gap-2 col-4 mx-auto">
                <form action="" method="POST">

                    <img src="<?php echo $reponse->lien ?>" class="card-img-top" alt="...">
                    <label for="name"> Cliquez sur le bouton pour confirmer votre achat </label>
                    <input type="submit" value="Valider" class="btn btn-primary" name="acheter" />
                </form>

        <?php
        }
    }
        ?>
        <?php

        echo $message;
        ?>
            </div>