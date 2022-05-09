<?php

require_once('entete.inc.php');

?>
<?php



//On vérifie que cela provient du formulaire créer dans achetercredits.php avec la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST["credit"] > 0) {

		$credit = $_POST["credit"];

		//Crédits

		$newcredit = $_SESSION["credit"] + $credit; // on prends l'ancienne valeur des crédits qu'on va ajouter à la nouvelle

		// requete qui permet de modifier les credits dans la table users
		$instruction = $db->prepare("update users set credit= :credit where mail='" . $_SESSION['mail'] . "'");
		$instruction->bindParam(":credit", $newcredit, PDO::PARAM_STR);
		$result = $instruction->fetchAll();

		//On met à jour la session avec les nouveau crédits
		$_SESSION["credit"] = $newcredit;

		try {
			$instruction->execute();
			header("location: ../consulProfil.php"); // on renvoit sur la page profil
		} catch (Exception $e) {
			die("erreur : " . $e->getMessage());
		}
	} else {
		header("location: ../achetercredits.php?error=1");
	}
}
?>