<?php

if (isset($_GET['id'])) {
    
    include_once "../sql.php";
    $db = sqlConnect();
    
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $product_id = mysqli_real_escape_string($db, $_GET['id']);
    $user_id = mysqli_real_escape_string($db, $_COOKIE['user_id']);

    
    $query = "DELETE FROM cart WHERE product_id=$product_id AND user_id=$user_id";
    $result = mysqli_query($db, $query);

    
    mysqli_close($db);

    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    
    header("Location: index.php");
    exit;
}
?>