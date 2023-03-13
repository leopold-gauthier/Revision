<?php
require_once("./class/User.php");
require_once("./Include/config.php");
require_once("./Include/navigation.php");

if (isset($_SESSION['user'])) { ?>
    <form action="" method="post">

        <label for="article">Article: </label>
        <input type="text" name="article" id="article" required>

        <input type="submit" name="submit" value="Ajouter">
    </form>
<?php
} else {
    header('Location: ./connexion.php');
}


?>
<?php
var_dump($_SESSION);
if (isset($_POST['submit'])) {
    $request = $bdd->prepare("INSERT INTO articles (article, id_utilisateur) VALUES (?,?)");
    $request->execute([$_POST['article'], $_SESSION['user']['id']]);
}
