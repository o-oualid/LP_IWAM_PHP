<?php
if (!isset($isadmin) || !$isadmin) {
    header("Location: index.php");
}
include_once "sql.php";
$db = sqlConnect();


if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = "SELECT * FROM user";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    
    echo "<table>";
    echo "<tr><th>ID</th><th>Username</th><th>Type</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>
                <form method='post' class='flex'>
                    <input type='hidden' name='id' value=' $row[id]'>
                    <input class='edit' type='submit' name='edit_user' value='Edit'>
                    <input class='del' type='submit' name='delete_user' value='Delete'>
                </form>
                </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found";
}


mysqli_close($db);
?>