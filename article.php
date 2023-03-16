<?php
include_once("./Include/head-inc.php");
require_once("./class/User.php");
require_once("./Include/config.php");
require_once("./Include/navigation.php");

if (isset($_SESSION['user'])) { ?>
    <form action="" method="POST">

        <label for="article">Article: </label>
        <input type="text" name="article" id="article" required>
        <a href="./categorie"></a>
        <input class="button" type="submit" name="submit" value="Ajouter">
        <a href="./categorie.php">Ajouter une catégorie</a>
        <div id="categorie">
            <?php
            $request = $bdd->prepare("SELECT * FROM categorie");
            $request->execute();
            $result = $request->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $value) {
            ?>

                <br>
                <input type="checkbox" id="<?= $value['nom'] ?>" value="<?= $value['id'] ?>" name="categorie[]">
                <label for="<?= $value['nom'] ?>"><?= $value['nom'] ?></label>
                <br>
            <?php
            }
            ?>
        </div>
    </form>
<?php
} else {
    header('Location: ./connexion.php');
}
?>
<?php
if (isset($_POST['submit'])) {
    $request = $bdd->prepare("INSERT INTO articles (article, id_utilisateur) VALUES (?,?)");
    $request->execute([$_POST['article'], $_SESSION['user']->id]);

    $selectId = $bdd->prepare("SELECT id FROM articles WHERE id_utilisateur = ? ORDER BY id DESC ");
    $selectId->execute([$_SESSION['user']->id]);
    $result = $selectId->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['categorie'])) {
        for ($i = 0; $i < count($_POST['categorie']); $i++) {
            $req = $bdd->prepare("INSERT INTO appartient (id_article,id_categorie) VALUE (?,?)");
            $req->execute([$result['id'], $_POST['categorie'][$i]]);
        }
    }
}
