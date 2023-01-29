<?php

if (isset($_POST['submit'])) {

    include "sql.php";
    $db = sqlConnect();

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);


    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {

            setcookie('user_id', $user['id'], time() + (86400 * 30), '/');
            setcookie('username', $user['username'], time() + (86400 * 30), '/');
            header('Location: index.php');
            exit();
        } else {
            $error = "Incorrect user name or password";
        }
    } else {
        $error = "Incorrect user name or password";
    }


    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "header.php" ?>
<div>
    <div class="form-wrap">
        <form method="post">
            <h1>Login</h1>
            <input type="text" name="username" placeholder="User name"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <?php echo isset($error) ? "<span class='errors'>$error</span><br>" : ""; ?>
            <input type="submit" name="submit" value="Log in">
        </form>
        <a href="register.php">No account? Sign up.</a>
    </div>
</div>
</body>
</html>