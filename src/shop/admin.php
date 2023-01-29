<?php
$isadmin = false;

if (isset($_COOKIE['user_id'])) {

    include_once "sql.php";
    $db = sqlConnect();

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $user_id = mysqli_real_escape_string($db, $_COOKIE['user_id']);


    $query = "SELECT * FROM user WHERE id='$user_id'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($user['type'] == 'admin') {
            $isadmin = true;
        }
    }


    mysqli_close($db);
}
if (!$isadmin) {
    header('Location: login.php');
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Area</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include_once "header.php" ?>
<aside>
    <form method="post">
        <input type="submit" value="Add Product" name="add_product">
        <input type="submit" value="Manage Products" name="manage_product">
        <input type="submit" value="Manage Users" name="manage_user">
        <input type="submit" value="Manage Commands" name="manage_commands">
    </form>

</aside>
<main>
    <?php
    if (isset($_REQUEST["add_product"]))
        include "product/add_product.php";
    elseif (isset($_REQUEST["manage_product"]))
        include "product/manage_products.php";
    elseif (isset($_REQUEST["edit_product"]))
        include "product/edit_product.php";
    else if (isset($_REQUEST["delete_product"])) {
        include "product/delete_product.php";
        include "product/manage_products.php";
    } elseif (isset($_REQUEST["manage_user"]))
        include "users/manage_users.php";
    else if (isset($_REQUEST["edit_user"]))
        include "users/edit_user.php";
    else if (isset($_REQUEST["delete_user"])) {
        include "users/delete_user.php";
        include "users/manage_users.php";
    } else if (isset($_REQUEST["manage_commands"]))
        include "command/manage_commands.php";
    else
        echo "<h1>Welcome to the admin area</h1>";

    ?>
</main>
</body>
</html>
