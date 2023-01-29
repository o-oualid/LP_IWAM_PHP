<?php
if (!isset($isadmin) || !$isadmin) {
    header("Location: index.php");
}

include_once "sql.php";
$db = sqlConnect();


if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


$id = $_POST['id'];


$query = "SELECT * FROM user WHERE id=$id";
$result = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($result);


$username = $user['username'];
$type = $user['type'];


if (isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $id = mysqli_real_escape_string($db, $_POST['id']);


    $query = "UPDATE user SET username='$username', type='$type' WHERE id=$id";
    if (mysqli_query($db, $query)) {

    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($db);
    }
}


mysqli_close($db);
?>
<div class="form-wrap">
    <form method="post">
        <input type='hidden' name='edit_user' value='edit_user'>
        <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">

        <select name="type">
            <option selected <?php echo $type=="admin"?"selected":""; ?> >admin</option>
            <option <?php echo $type=="normal"?"selected":""; ?>>normal</option>
        </select>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
