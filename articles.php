<?php
require_once("./class/User.php");
require_once("./Include/config.php");
require_once("./Include/navigation.php");

?>
<br><a href="articles.php?order=DESC">DESC</a> || <a href="articles.php?order=ASC">ASC</a>
<?php

if (isset($_GET['order']) == 'DESC') {
    $request = $bdd->prepare("SELECT article, utilisateurs.firstname FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id ORDER BY articles.article DESC");
} elseif (isset($_GET['order']) == 'ASC') {
    $request = $bdd->prepare("SELECT article, utilisateurs.firstname FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id ORDER BY articles.article ASC");
}
var_dump($request);
$request->execute();
$result = $request->fetchAll(PDO::FETCH_ASSOC);
header('refresh:0');
foreach ($result as $key => $value) { ?>

    <br>
    <?php echo "Article : " . $value['article']; ?>
    <br>
    <?php echo "Crée par : " . $value['firstname']; ?>
    <br>
<?php
}
?>