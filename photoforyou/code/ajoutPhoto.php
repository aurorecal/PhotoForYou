<?php
include("include/entete.inc.php");

$db = new PDO('mysql:host=localhost;dbname=photoforyou', 'root', '');

//vérifier si la photo c'est bien envoyé 
$photo = $_SESSION['id'];
if (isset($_POST['addimage'])) {

    $dataImage = [
        'img_link' => 'images/' . $_FILES['image']['name'],
        'img_file' => $_FILES['image']['tmp_name'] // tmp name état de transition
    ];

    $data = [
        'title' => htmlspecialchars($_POST['title']),
        'img_link' => $dataImage['img_link']

    ];
    //déplacer l'image dans le dossier images
    // img_file on recupere l'image pour le stocker dans le img_link
    move_uploaded_file($dataImage['img_file'], $dataImage['img_link']);


    $prix_image = $_POST['prix_image'];



    //SQL 

    $addImage = $db->prepare("INSERT INTO images (titre, lien,credit_image,id_photographe)VALUES(:title, :img_link,+" . $prix_image . ",+" . $photo . ")"); //ajoute les images dans la BD
    // $addImage->bindParam(':prix', $prix_image, PDO::PARAM_STR);
    $addImage->execute($data); // va executer le tableau $data

}
// Pour récupérer les différents éléments

$getDataImages = $db->prepare("SELECT * FROM images WHERE id_photographe= '$photo'");
$getDataImages->execute();

$images = $getDataImages->fetchAll(PDO::FETCH_ASSOC);
//var_dump($images); vérifie si on récupére bien toutes les photos

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ajoutPhoto.css">
    <title>Ajout Images</title>
</head>

<body>
    <div class="containerAP">
        <div class="addimages">
            <!-- premiere zone du formulaire -->
            <h1>Ajouter une image</h1>
            <div class="addimages__form">
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="title">Nom de la photo</label>
                        <input type="text" name="title">
                    </div>
                    <div>
                        <label for="prix_image">Prix</label>
                        <input type="text" name="prix_image">
                    </div>
                    <div>
                        <label for="photo">Choisir une photo</label>
                        <!-- c'est ici que l'on va récupérer la photo -->
                        <input type="file" accept="images/png, images/jpeg" name="image">
                        <!--on définit le format d'images que l'on accepte -->
                    </div>
                    <button type="submit" name="addimage">Envoyer la photo</button>
                </form>
            </div>
        </div>

        </br>
        <h1 class=text-center> Mes ajouts photos </h1>

        <div class="showimagesAP">

            <?php foreach ($images as $image) { ?>
                <div class="card-body">
                    <div class="photoforyou__image">
                        <h4 class="my-0 font-weight-normal text-center">Prix : <?php echo $image['credit_image']; ?></h4>
                        <img src="<?php echo $image['lien']; ?>" alt="<?php echo $image['titre']; ?>">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>

<?php
include("include/piedDePage.inc.php");
?>