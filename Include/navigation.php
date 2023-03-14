<?php if (isset($_SESSION['user'])) { ?>
    <a href="./deconnexion.php">Deconnexion</a>
    <a href="./profil.php">Profil</a>
    <a href="./article.php">Ajouter Article</a>
<?php
} else {
?>
    <a href="./inscription.php">Inscription</a>
    <a href="./connexion.php">Connexion</a>

<?php
} ?>
<a href="./articles.php">Visualiser les articles</a>