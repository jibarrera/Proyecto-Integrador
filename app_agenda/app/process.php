<?php
session_start();
switch($_GET["action"]) {
    case "login":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = (isset($_POST["email"]));
            //ctype_alnum($_POST["email"]) ? $_POST["email"] : null;
            $pass = (isset($_POST["pass"])) ? $_POST["pass"] : null;
            $salt = '$2a$07$my.salt.mUy.Secr3t0';

        if (isset($email, $pass) && (crypt($email . $pass, $salt) ==
                crypt("admintest", $salt))) {
                $_SESSION["email"] = $_POST["email"];
            }
        }
        break;
    case "logout":
        $_SESSION = array();
        session_destroy();
        break;
}
header("Location: index.php");
?>