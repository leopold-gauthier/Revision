<?php
include_once("./Include/head-inc.php");
require_once("./class/User.php");
require_once("./Include/navigation.php")
?>
<form action="" method="post">
    <label for="name">Login: </label>
    <input type="text" name="login" id="login">

    <label for="email">Email: </label>
    <input type="email" name="email" id="email">

    <label for="firstname">Firstname: </label>
    <input type="text" name="firstname" id="firstname">

    <label for="lastname">Lastname: </label>
    <input type="text" name="lastname" id="lastname">

    <label for="password">Password: </label>
    <input type="password" name="password" id="password">

    <label for="password">Password Confirm: </label>
    <input type="password" name="password_confirm" id="password">

    <input class="button" type="submit" name="submit" value="S'inscrire">
</form>


<?php


if (isset($_POST['submit'])) {
    $user = new User($_POST["login"], $_POST["password"], $_POST["email"], $_POST["firstname"], $_POST["lastname"]);
    $user->register();
    header('Location: ./inscription.php');
}
