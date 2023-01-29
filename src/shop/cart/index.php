<?php
if (!isset($_COOKIE['user_id'])) {
    header("Location: login.php");
    exit;
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
    <form method="post" action="update.php">
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th></th>
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
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td><a href='/shop/product/product.php?id=$row[product_id]'>$row[name]</a></td>
                        <td>$row[price]</td>
                        <td>
                            <input type='hidden' name='id[]' value='$row[id]'>
                            <input type='number' name='quantity[]' value='$row[quantity]'>
                        </td>
                        <td><a class='button del' href='/shop/cart/remove_from_cart.php?id=$row[product_id]'>Remove from Cart</a></td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Your cart is empty</td></tr>";
            }


            mysqli_close($db);
            ?>
        </table>
        <?php
        if (mysqli_num_rows($result) > 0) { ?>
        <div class="flex">
            <input type="submit" value="Update">
            <a class='button edit' href='/shop/command/checkout.php'>Checkout</a>
        </div>
    </form>
    <?php } ?>
</div>
</body>
</html>

