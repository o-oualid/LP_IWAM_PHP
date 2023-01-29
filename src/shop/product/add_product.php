<?php
if (!isset($isadmin) || !$isadmin) {
    header("Location: index.php");
}


if (isset($_POST['submit'])) {
    include_once "sql.php";
    $db = sqlConnect();

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $categories = explode(',', mysqli_real_escape_string($db, $_POST['categories']));
    $file_name = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_type = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $allowed_types = array('jpg', 'jpeg', 'png');
        if (in_array(strtolower($file_type), $allowed_types)) {

            $file_name = uniqid() . "." . $file_type;

            $path = "product/images/$file_name";


            move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
    } else {

        $path = "product/images/default.jpg";
        $file_name = "default.jpg";

    }

    $query = "INSERT INTO product (name, description, price, image) VALUES ('$name', '$description', '$price', '$file_name')";
    if (mysqli_query($db, $query)) {
        $id = mysqli_insert_id($db);
        if (count($categories) > 0) {
            $query = "INSERT INTO category (product_id,name) VALUES";
            foreach ($categories as $category) {
                $category = trim($category);
                $query .= "('$id','$category'),";
            }
            $query = rtrim($query, " ,") . ";";
            if (mysqli_query($db, $query))
                echo "Product added successfully!";
        } else {
            echo "Product added successfully!";
        }
    }

    mysqli_close($db);
}
?>
<div class="form-wrap">
    <form action="" method="post" enctype="multipart/form-data">
        <input hidden="hidden" name="add_product" value="add_product">
        <input type="text" name="name" placeholder="Name"><br>
        <input type="text" name="description" placeholder="Description"><br>
        <input type="text" name="price" placeholder="Price"><br>
        <input type="file" name="image" placeholder="Image"><br>
        <input type="text" name="categories" placeholder="Categories"><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>