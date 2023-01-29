<?php
if (!isset($isadmin) || !$isadmin) {
    header("Location: index.php");
}

include_once "sql.php";
$db = sqlConnect();


if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $categories = explode(',', mysqli_real_escape_string($db, $_POST['categories']));
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $id = mysqli_real_escape_string($db, $_POST['id']);

    $query = "UPDATE product SET name='$name', description='$description',price='$price' WHERE id='$id'";
    mysqli_query($db, $query);


    $query = "DELETE from category where product_id=$id;";
    mysqli_query($db, $query);
    if (count($categories) > 0 && $categories[0] != "") {
        $query = "INSERT INTO category (product_id,name) VALUES";
        foreach ($categories as $category) {
            $category = trim($category);
            $query .= "('$id','$category'),";
        }
        $query = rtrim($query, " ,") . ";";
        mysqli_query($db, $query);
    }
}


if (!isset($_POST['id'])) {
    exit();
}


$id = mysqli_real_escape_string($db, $_POST['id']);
$query = "SELECT * FROM product WHERE id='$id'";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) == 1) {
    $query = "SELECT * FROM category WHERE product_id='$id'";
    $categories_result = mysqli_query($db, $query);
    $categories = "";
    while ($category = mysqli_fetch_assoc($categories_result)) {
        $categories .= $category['name'] . ",";
    }
    $categories = rtrim($categories, ", ");
    $row = mysqli_fetch_assoc($result);

    echo "
<div class='form-wrap'>
    <form  method='post'>
        <input type='hidden' name='edit_product' value='edit_product'>
        <input type='hidden' name='id' value='{$row['id']}'>
        <input type='text' name='name' value='{$row['name']}' placeholder='Name'>
        <input type='text' name='description' value='{$row['description']}' placeholder='Description'>
        <input type='text' name='price' value='{$row['price']}' placeholder='Price'>
        <input type='text' name='categories' value='{$categories}' placeholder='Categories'>
        <input type='submit' name='submit' value='Submit'>
    </form>
</div>";
}

mysqli_close($db);
?>
