<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_COOKIE['user_id'])) {
        
        include_once "../sql.php";
        $db = sqlConnect();
        
        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        
        $user_id = mysqli_real_escape_string($db, $_COOKIE['user_id']);
        $product_id = mysqli_real_escape_string($db, $_POST['id']);
        $quantity = mysqli_real_escape_string($db, $_POST['quantity']);;
        if(!is_numeric($quantity)) die("Error");
        $query = "SELECT * FROM cart WHERE user_id=$user_id AND product_id=$product_id";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            
            $query = "UPDATE cart SET quantity=quantity+$quantity WHERE user_id=$user_id AND product_id=$product_id";
            mysqli_query($db, $query);
        } else {
            
            $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)";
            mysqli_query($db, $query);
        }

        
        mysqli_close($db);

        
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        
        header("Location: login.php");
        exit;
    }
}
?>