<?php
include "../sql.php";
$db = sqlConnect();


if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


$id = $_GET['id'];


$query = "SELECT * FROM product WHERE id='$id'";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
}

$query = "SELECT * FROM category WHERE product_id='$id'";
$result = mysqli_query($db, $query);

$categories = "";
if (mysqli_num_rows($result) > 0) {
    while ($category = mysqli_fetch_assoc($result))
        $categories .= "<a href='/shop/index.php?category%5B%5D=$category[name]'>$category[name]</a> ";
}

mysqli_close($db);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<?php include "../header.php" ?>
<div class="product-content form-wrap">
    <img style="display: inline-block" src="images/<?php echo $product['image']; ?>"
         alt="<?php echo $product['name']; ?>">
    <div style="text-align:left;display: inline-block;vertical-align: top">
        <h1><?php echo $product['name']; ?></h1>
        <p><?php echo $product['description']; ?></p>
        <p>Price: $<?php echo $product['price']; ?></p>
        <p>Categories: <?php echo $categories ?></p>
        <form action="/shop/cart/add_to_cart.php" class="flex" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
            <input type="number" name="quantity" value="1">
            <button type="submit">Add to cart</button>
        </form>
    </div>
</div>
</body>
</html>
