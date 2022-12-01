<?php
if (isset($_POST["login"]) &&
    isset($_POST["password"]) &&
    $_POST["login"] == "oualid" &&
    $_POST["password"] == "pass"
) {
    session_start();
    $_SESSION["login"] = $_POST["login"];
    header("location:./index.php");
} else {

    header("location:./login.php");

}