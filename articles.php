<?php
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
$request = $bdd->prepare("SELECT article, utilisateurs.firstname FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id ORDER BY articles.article $order ");
$request->execute();
$result = $request->fetchAll(PDO::FETCH_ASSOC);
?>

<?php

foreach ($result as $key => $value) { ?>

    <br>
    <?php echo "Article : " . $value['article']; ?>
    <br>
    <?php echo "Crée par : " . $value['firstname']; ?>
    <br>
<?php
}
?>
<form method="GET">
    <input type="submit" value="<?= $order ?>" name="order">
</form>