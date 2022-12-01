<?php
session_start();
if (isset($_COOKIE["login"])) {
    header("location:./index.php");
}
?>
<form method="post" action="exe1.php">
    <label> Login:
        <input type="text" name="login">
    </label><br>
    <label> Password:
        <input type="password" name="password">
    </label><br>
    <input type="submit">
</form>