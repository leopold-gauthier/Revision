<?php
include_once("./Include/head-inc.php");
require_once("./class/User.php");
require_once("./Include/config.php");
require_once("./Include/navigation.php");

if (isset($_SESSION['user'])) { ?>
    <form action="" method="POST">

        <label for="categorie">Categorie: </label>
        <input type="text" name="categorie" id="categorie" required>
        <input type="submit" name="submit" value="Ajouter">
    </form>
<?php
} else {
    header('Location: ./connexion.php');
}
?>
<?php
if (isset($_POST['submit'])) {
    $request = $bdd->prepare("INSERT INTO categorie (nom, id_utilisateur) VALUES (?,?)");
    $request->execute([$_POST['categorie'], $_SESSION['user']['id']]);
    header("Location: ./article.php");
}
