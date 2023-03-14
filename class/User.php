<?php
session_start();

class User
{


    public $login;
    public $password;
    public $email;
    public $firstname;
    public $lastname;
    public $bdd;

    // CONSTRUCTOR
    public function __construct($login, $password, $email, $firstname, $lastname)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->bdd = new PDO('mysql:host=localhost;dbname=revisions', "root", '');
    }

    // GET
    public function getLogin()
    {
        return $this->login;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function getLastname()
    {
        return $this->lastname;
    }
    // __________________________________ //

    // SET
    public function setLogin($login)
    {
        $this->login = $login;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    // ___________________________________ //

    // FUNCTION

    // VERIFY
    public function verify_password()
    {
        if ($_POST['password'] == $_POST['password_confirm']) {
            return true;
        } else {
            return false;
        }
    }

    public function verify_empty()
    {
        if (empty($_POST['login']) || empty($_POST['email']) || empty($_POST['firstname']) || empty($_POST['lastname'])) {
            return false;
        } else {
            return true;
        }
    }

    public function verify_login()
    {
        $login = htmlspecialchars($_POST['login']);
        $recupUser = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $recupUser->execute([$login]);
        if ($recupUser->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    // ---------------------------------------------- //

    // OTHER FUNCTION
    public function register()
    {
        if ($this->verify_login() == true && $this->verify_empty() == true && $this->verify_password() == true) {
            $register = $this->bdd->prepare("INSERT INTO `utilisateurs` (`login` , `password`, `email` , `firstname` , `lastname`) VALUES (?, ? , ?, ? ,?);");
            $register->execute([$this->login, $this->password, $this->email, $this->firstname, $this->lastname]);
        } else {
            return false;
        }
    }

    public function connect($login, $password)
    {
        $connect = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ? ");
        $connect->execute([$login, $password]);
        $result = $connect->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user'] = $result;
        var_dump($_SESSION);
    }

    public function disconnect()
    {
        unset($_SESSION['user']);
        var_dump($_SESSION);
    }

    public function isConnected()
    {
        if (isset($_SESSION['user'])) {
            echo "--connected--";
            return true;
        } else {
            echo "--disconnect--";
            return false;
        }
    }
    public function Update($login, $password, $email, $firstname, $lastname)
    {
        if ($this->verify_empty() == true && $this->verify_password() == true) {
            $update = $this->bdd->prepare("UPDATE `utilisateurs` SET `login` = ?, `password` = ?, `email` = ?, `firstname` = ?, `lastname` = ? WHERE `utilisateurs`.`id` = ?;");
            $update->execute([$login, $password, $email, $firstname, $lastname, $_SESSION['user']['id']]);
        } else {
            return false;
        }
    }
}

$user = new User(NULL, NULL, NULL, NULL, NULL);
// var_dump($user);
// $user->register();
// $user->connect("DropZ", "mdp");
// $user->disconnect();
// $user->isConnected();
// $user->Update('reded', 'reded', 'reded@gmail.com', 'reded', 'reded');