<?php
require_once('include/entete.inc.php');

require_once('include/accessbase.php');

$id = $_SESSION['id'];

if (isset($_GET['supp'])) {
    $sql1 = "DELETE from images where id = '" . $_GET['supp'] . "'";
    $req1 = $db->query($sql1);
}

$sql = "SELECT * from images where id_proprio = '" . $id . "'";
$req = $db->query($sql);
$resultat = $req->fetchall();



?>
<br>
<?php foreach ($resultat as $item) { ?>
    <form>
        <!-- On affiche le titre -->
        <div class="text-center ">
            <h2>Titre de la photo : <?php echo $item['titre'] ?></h2>
        </div>
        <!-- On affiche la photo acheter -->
        <div>
            <img src="<?php echo $item['lien'] ?>" class="rounded mx-auto d-block" />
        </div>
        <!-- On télécharge la photo -->

        <div class="text-center">
            <a class='btn btn-outline-success flex-shrink-0' href="<?php echo $item["lien"] ?>" download="<?php echo $item["lien"] ?>"><i class='bi bi-download'></i> Télécharger l'image</a>

            <a href="?supp=<?php echo $item["id"] ?>"> supprimer</a> </br><br>
        </div>
    </form>
<?php } ?>