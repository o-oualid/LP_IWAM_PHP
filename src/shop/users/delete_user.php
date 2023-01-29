<?php
if (!isset($isadmin) || !$isadmin) {
    header("Location: index.php");
}

include_once "sql.php";
$db = sqlConnect();


if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['delete_user'])) {
    
    $id = mysqli_real_escape_string($db, $_POST['id']);

    
    $query = "DELETE FROM user WHERE id=$id";
    if (mysqli_query($db, $query)) {
        
    } else {
    }
}


mysqli_close($db);
?>
