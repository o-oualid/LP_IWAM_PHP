<?php
if (isset($_GET["logout"])) {
    setcookie("login","",0);
    header("location:./login.php");
}
if (isset($_COOKIE["login"])) {
    echo "Hello " . $_COOKIE["login"];
    echo "<br><a href='./index.php?logout=true'>Logout</a>";

} else {
    header("location:./login.php");
}