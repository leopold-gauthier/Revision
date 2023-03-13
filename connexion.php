<?php
require_once("./class/User.php");
require_once("./Include/navigation.php")
?>
<form action="" method="post">
    <label for="name">Login: </label>
    <input type="text" name="login" id="login" required>

    <label for="password">Password: </label>
    <input type="password" name="password" id="password" required>

    <input type="submit" name="submit" value="S'inscrire">
</form>


<?php
if (isset($_POST['submit'])) {
    $User = new User($_POST["login"], $_POST["password"], NULL, NULL, NULL);
    $User->connect($_POST['login'], $_POST['password']);
    header("Location: ./connexion.php");
    $user->isConnected();
} else if (empty($_SESSION['user'])) {
    echo "Aucun utilisateur trouvées";
}
var_dump($_SESSION);
?>