<?php
include_once "sql.php";

$db = sqlConnect();

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


$search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : "";
$categories = $_GET['category'] ?? array();

$price_check = "";
if (isset($_GET['min-price']) && isset($_GET['max-price'])) {
    $min_price = mysqli_real_escape_string($db, $_GET['min-price']);
    $max_price = mysqli_real_escape_string($db, $_GET['max-price']);
    $price_check = "AND p.price BETWEEN $min_price AND $max_price";
}
$category_where = "";
$NumberOfCategories = count($categories);

if ($NumberOfCategories > 0) {
    $category_where = "AND ( ";
    for ($i = 0; $i < count($categories); $i++) {
        $category_where .= " c.name = '" . mysqli_real_escape_string($db, $categories[$i]) . "' OR ";
    }
    $category_where = rtrim($category_where, " OR") . ")";
}

$query = "SELECT p.* FROM product p left join category c on p.id = c.product_id WHERE (p.name LIKE '%$search%' OR p.description LIKE '%$search%' OR c.name LIKE '%$search%') $price_check $category_where  GROUP BY p.id ";
if ($NumberOfCategories > 0)
    $query .= "HAVING COUNT(DISTINCT c.name) =$NumberOfCategories";

$result = mysqli_query($db, $query);


mysqli_close($db);
?>
<div id="products">
    <?php
    if (mysqli_num_rows($result) > 0) {

        while ($product = mysqli_fetch_assoc($result)) {
            echo '<a href="/shop/product/product.php?id=' . htmlspecialchars($product['id']) . '" class="product">';
            echo '<img src="/shop/product/images/' . htmlspecialchars($product['image']) . '">';
            echo '<div>';
            echo '<span>' . htmlspecialchars($product['name']) . '</span>';
            echo '<span>$' . number_format($product['price'], 2) . '</span>';
            echo '</div>';
            echo '</a>';
        }
    } else {

        echo '<p>No products found</p>';
    }
    ?>
</div>


