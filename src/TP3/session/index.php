<?php
session_start();
if (isset($_GET["logout"])) {
    session_destroy();
    header("location:./login.php");
}
if (isset($_SESSION["login"])) {
    echo "Hello " . $_SESSION["login"];
    echo "<br><a href='./index.php?logout=true'>Logout</a>";
} else {
    header("location:./login.php");
}
