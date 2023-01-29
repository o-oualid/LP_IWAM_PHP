<?php

if (isset($_POST['submit'])) {
    include "sql.php";

    $db = sqlConnect();

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $valid = true;
    if (strlen($username) < 4) {
        $error = "User name must be at least 4 characters long";
        $valid = false;
    }
    if (!preg_match('/(?=.*\W.*).{8,}/', $password,)) {
        $error = "Invalid password format";
        $valid = false;
    }
    if ($valid) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user (username, password) VALUES ('$username', '$password_hash')";
        if (mysqli_query($db, $query)) {
            header('Location: index.php');
            exit();

        } else {

        }
    }

    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "header.php" ?>
<div class="form-wrap">
    <h1>Create Account</h1>
    <form method="post">
        <input type="text" name="username" placeholder="User name"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <?php echo isset($error) ? "<span class='errors'>$error</span><br>" : ""; ?>
        <input type="submit" name="submit" value="Create Account">
    </form>
    <a href="login.php">Already have an account? Click Here</a>

</div>
</body>
</html>