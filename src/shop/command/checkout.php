<?php
if (!isset($_COOKIE['user_id'])) {
    header("Location: ../login.php");
    exit;
}
if (isset($_POST["buy"])) {
    include_once "../sql.php";
    $db = sqlConnect();


    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $user_id = $_COOKIE['user_id'];

    $shipping_address=$_POST['shipping_address'];
    $query = "INSERT INTO command (date, client_id,shipping_address) VALUES (NOW(), $user_id,'$shipping_address')";
    mysqli_query($db, $query);


    $command_id = mysqli_insert_id($db);


    $query = "SELECT * FROM cart WHERE user_id=$user_id";
    $result = mysqli_query($db, $query);


    while ($item = mysqli_fetch_assoc($result)) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $query = "INSERT INTO command_row (command_id, product_id, quantity) VALUES ($command_id, $product_id, $quantity)";
        mysqli_query($db, $query);
        $query = "DELETE FROM cart WHERE user_id=$user_id AND product_id=$product_id";
        mysqli_query($db, $query);
    }
    mysqli_close($db);
    header("Location: ../index.php");

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="../style.css">

</head>
<body>
<?php include "../header.php"; ?>
<div class="form-wrap">
    <form method="post">
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php

            include_once "../sql.php";
            $db = sqlConnect();

            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $user_id = mysqli_real_escape_string($db, $_COOKIE['user_id']);
            $query = "SELECT cart.id as id, product.name, product_id,quantity,price  FROM cart left join product on product_id=product.id WHERE user_id=$user_id";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<form method='post' action='update.php'>";
                $total=0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $total+=$row['quantity']*$row['price'];
                    echo "<tr>
                        <td><a href='/shop/product/product.php?id=$row[product_id]'>$row[name]</a></td>
                        <td>$row[price]\$</td>
                        <td>$row[quantity]</td>
                      </tr>";
                }
                echo "<tr>
                        <th colspan='2'>Total</th>
                        <td>$total\$</td>  
                      </tr>
                      <tr>
                        <td colspan='3'><input type='text' name='shipping_address' placeholder='Shipping address'></td>
                      </tr>
                     ";
            } else {
                echo "<tr><td colspan='5'>Your cart is empty</td></tr>";
            }


            mysqli_close($db);
            ?>
        </table>
        <?php
        if (mysqli_num_rows($result) > 0) { ?>
        <div class="flex">
            <input type="submit" name="buy" value="Buy">
        </div>
    </form>
    <?php } ?>
</div>
</body>
</html>

