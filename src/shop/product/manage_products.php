<?php
if (!isset($isadmin) || !$isadmin) {
    header("Location: index.php");
}

include_once "sql.php";
$db = sqlConnect();

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = "SELECT * FROM product";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>
                <form method='post' class='flex'>
                    <input type='hidden' name='id' value=' $row[id]'>
                    <input class='edit' type='submit' name='edit_product' value='Edit'>
                    <input class='del' type='submit' name='delete_product' value='Delete'>
                </form>
                </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}


mysqli_close($db);
?>