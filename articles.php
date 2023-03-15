<?php
include_once("./Include/head-inc.php");
require_once("./class/User.php");
require_once("./Include/config.php");
require_once("./Include/navigation.php");

?>

<?php
if (isset($_GET['order'])) {
    if ($_GET['order'] == "ASC") {
        $order = "DESC";
    } else if ($_GET['order'] == "DESC") {
        $order = "ASC";
    }
} else {
    $order = "DESC";
}
$requestA = $bdd->prepare("SELECT articles.id , article, utilisateurs.firstname FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id ORDER BY articles.id $order ");
$requestA->execute();
$resultA = $requestA->fetchAll(PDO::FETCH_ASSOC);

?>
<div id="product">
    <?php

    foreach ($resultA as $key => $value) {

        $requestB = $bdd->prepare("SELECT categorie.nom ,articles.id FROM categorie INNER JOIN appartient ON categorie.id = appartient.id_categorie INNER JOIN articles ON appartient.id_article = articles.id WHERE articles.id = ?;");
        $requestB->execute([$resultA[$key]['id']]);
        $resultB = $requestB->fetchAll(PDO::FETCH_ASSOC);
    ?>

        <div class="product">
            <br>
            <?php echo "Article : " . $value['article']; ?>
            <br>
            <?php echo "Crée par : " . $value['firstname']; ?>
            <br>
            <?php echo "Catégorie : " ?>
            <?php foreach ($resultB as $k => $val) {
                echo $val['nom'] . "<br>";
            }
            ?>
        </div>
    <?php
    }
    ?>
</div>
<form method="GET">
    <input class="button" type="submit" value="<?= $order ?>" name="order">
</form>