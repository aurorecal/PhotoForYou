<!DOCTYPE html>
<html>

<head>
  <title>Acheter des crédits</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body></body>
<?php
include("include/entete.inc.php");

if ($_SESSION['type'] != 'client') { // seule les clients ont accés à cette page
  header("Location:index.php");
}
?>
<br>
<br>
<br>
<br>

<div class="d-grid gap-2 col-4 mx-auto">
  <form action="include/bdd_credits.php" method="POST">
    <?php
    if (isset($_GET['error'])) {
      echo 'le montant doit être supérieur à 0';
    }
    ?>
    </br>
    <label for="name"> Montant des crédits: </label>
    <input type="number" name="credit" id="credit" required>

    <button type="submit" class="btn btn-primary">Valider</button>

  </form>
</div>

<?php
include("include/piedDePage.inc.php");
?>

</body>

</html>