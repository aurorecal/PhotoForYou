<?php
include("include/entete.inc.php");
if ($_SESSION['login'] != true) {
	header("Location:connexion.php");
}
if ($_SESSION['type'] != 'client') { // seule les clients ont accés à cette page
	header("Location:index.php");
}
?>

<div class="container text-center">
	<div class="py-5 text-center">
		<img class="d-block mx-auto mb-2" src="images/logo.png" alt="logo photoforyou" width="170" height="115">
		<h1 class="display-5">Acheter des photos</h1>
		<p class="lead">Des pros au service des professionnels de la communication.</p>

		<?php
		// include("include/accessbase.inc.php");

		$req = $db->prepare('select * from images'); // requête préparée
		$req->execute();

		while ($reponse = $req->fetch(PDO::FETCH_OBJ)) {
			if ($reponse->statut == 0) {
		?>

				<div class="card-deck mb-3 text-center">

					<div class="card mb-4 box-shadow">
						<div class="card-header">
							<h4 class="my-0 font-weight-normal">Prix : <?php echo $reponse->credit_image ?></h4>
						</div>

						<div class="card-body">

							<img src="<?php echo $reponse->lien ?>" class="card-img-top" alt="...">
							<ul class="list-unstyled mt-3 mb-4">
								<a href="single_view.php?id=<?php echo $reponse->id ?>" class="btn btn-secondary">Voir image</a>
							</ul>
						</div>
					</div>
				</div>

		<?php
			}
		}
		?>



		<?php
		include("include/piedDePage.inc.php");
		?>