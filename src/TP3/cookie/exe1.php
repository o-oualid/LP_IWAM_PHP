<?php
if (isset($_POST["login"]) &&
    isset($_POST["password"]) &&
    $_POST["login"] == "oualid" &&
    $_POST["password"] == "pass"
) {
    setcookie("login",$_POST["login"]);
    header("location:./index.php");
} else {

    header("location:./login.php");
}