<nav>
    <a href="./articles.php">Product</a>
    <a href="./index.php">Home</a>
    <?php if (!isset($_SESSION['user'])) { ?>
        <a href="./inscription.php">Sign Up</a>
        <a href="./connexion.php">Connect</a>
    <?php
    } else {
    ?>
        <a href="./article.php">Add product</a>
        <a href="./profil.php">Profil</a>
        <a href="./deconnexion.php"><i class="fa-solid fa-right-from-bracket"></i></a>

    <?php
    } ?>
</nav>