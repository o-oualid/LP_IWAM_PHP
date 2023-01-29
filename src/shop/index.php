<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
    <style>

        .price-input {
            width: 100%;
            display: flex;
            margin: 30px 0 35px;
        }

        .price-input .field {
            height: 20px;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .field input {
            width: 100%;
            height: 100%;
            outline: none;
            font-size: 19px;
            text-align: center;
            border-radius: 5px;
            margin-left: 12px;
            border: 1px solid #999;
        }

    </style>
</head>
<body>
<?php include_once "header.php" ?>
<aside>
    <form method="get">
        <input type="text" hidden="hidden" name="search" value="<?php echo htmlspecialchars($_GET['search'] ?? ""); ?>">
        <details>
            <summary>Price</summary>
            <div class="wrapper">
                <div class="price-input">
                    <div class="field">
                        <span>Min</span>
                        <input type="number" name="min-price" class="input-min" value="0">
                    </div>
                    <div class="field">
                        <span>Max</span>
                        <input type="number" name="max-price" class="input-max" value="100">
                    </div>
                </div>
            </div>
        </details>
        <details>
            <summary>Categories</summary>
            <?php
            include_once "sql.php";
            $db = sqlConnect();

            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }


            $query = "select name from category group by name";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<input type='checkbox' name='category[]' value='$row[name]'";
                    echo isset($_GET['category']) && in_array($row['name'], $_GET['category']) ? "checked" : "";
                    echo ">";
                    echo $row['name'] . "<br>";
                }
            }

            mysqli_close($db);

            ?>
        </details>

        <input type="submit" value="Filter">
    </form>
</aside>
    <main>
    <?php
    include_once "product/products.php"
    ?>

</main>
</body>
</html>
<?php
