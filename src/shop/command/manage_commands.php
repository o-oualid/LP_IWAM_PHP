<?php
if (!isset($isadmin) || !$isadmin) {
    header("Location: index.php");
}
include_once "sql.php";
$db = sqlConnect();


if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['delete'])) {
    
    $id = mysqli_real_escape_string($db, $_POST['id']);

    
    $query = "DELETE FROM command WHERE id=$id";
    if (mysqli_query($db, $query)) {
        
        header("Location: commands.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($db);
    }
}


$query = "SELECT * FROM command";
$result = mysqli_query($db, $query);


echo "<table>";
echo "<tr><th>ID</th><th>Date</th><th>Client ID</th><th>Shipping address</th></tr>";
while ($command = mysqli_fetch_assoc($result)) {
    $id = $command['id'];
    $date = $command['date'];
    $client_id = $command['client_id'];
    $shipping_address=$command['shipping_address'];
    echo "<tr>";
    echo "<td>$id</td><td>$date</td><td>$client_id</td><td>$shipping_address</td>";
    echo "<td>";
    echo "<form action='/shop/command/delete_command.php' method='post'>";
    echo "<input type='hidden' name='id' value='$id'>";
    echo "<input type='submit' name='delete' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr><tr><td colspan='4'>";
    echo "<details>";
    echo " <summary>Details</summary>";
    $query = "SELECT * FROM command_row WHERE command_id=$id";
    $command_rows_result = mysqli_query($db, $query);
    echo "<table>";
    echo "<tr><th>Product ID</th><th>Quantity</th></tr>";
    while ($command_row = mysqli_fetch_assoc($command_rows_result)) {
        $product_id = $command_row['product_id'];
        $quantity = $command_row['quantity'];
        echo "<tr>";
        echo "<td>$product_id</td><td>$quantity</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</details>";
    echo "</td></tr>";
}
echo "</table>";


mysqli_close($db);
?>

