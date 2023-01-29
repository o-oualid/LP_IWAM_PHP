<link href="/shop/style/css/fontawesome.css" rel="stylesheet">
<link href="/shop/style/css/brands.css" rel="stylesheet">
<link href="/shop/style/css/solid.css" rel="stylesheet">
<header>
    <div id="left">
        <a class="logo" href="/shop/index.php">Home</a>
        <a href="/shop/index.php?category%5B%5D=Men">Men</a>
        <a href="/shop/index.php?category%5B%5D=Women">Women</a>
    </div>
    <div id="right">
        <form class="header-search" action="/shop/index.php" method="get">
            <input type="text" name="search" placeholder="Search" value="<?php echo htmlspecialchars($_GET['search'] ?? ""); ?>">
        </form>
        <?php
        if (isset($_COOKIE['username'])) {

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
                        
                        echo '<a href="/shop/admin.php"><i class="fa-regular fa-gear"></i></a>';
                    }
                }


                mysqli_close($db);
            }
            echo '<a href="/shop/cart"><i class="fa-solid fa-cart-shopping"></i></a>';

            echo '<a class="logout" href="/shop/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>';

        } else {
            echo '<a href="/shop/login.php"><i class="fa-regular fa-user"></i></a>';
        }
        ?>
    </div>
</header>