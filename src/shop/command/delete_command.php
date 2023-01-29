<?php

if (isset($_POST['id'])) {
    include_once "../sql.php";
    $db = sqlConnect();
    if (!$db) die("Connection failed: " . mysqli_connect_error());


    $command_id = mysqli_real_escape_string($db, $_POST['id']);
    $query = "DELETE FROM command WHERE id= $command_id";
    $result = mysqli_query($db, $query);
    mysqli_close($db);
    header("Location: " . $_SERVER['HTTP_REFERER']."?manage_commands=true");
} else {
    header("Location: /shop/index.php");
}
exit;

?>