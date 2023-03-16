<?php
include_once("./Include/head-inc.php");
require_once("./class/User.php");
require_once("./Include/config.php");
require_once("./Include/navigation.php");
if (!isset($_SESSION['user'])) { ?>
    <p>Hello</p>
<?php
} else { ?>
    <p>Hello <?php echo $_SESSION['user']->firstname . " " . $_SESSION['user']->lastname ?></p>
<?php
}
?>