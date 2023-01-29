<?php
if (isset($_POST['id']) && sizeof($_POST['id']) > 0) {
    include_once "../sql.php";
    $db = sqlConnect();


    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $cases = "";
    $ids = "";

    for ($i = 0; $i < sizeof($_POST['id']); $i++) {
        $cases .= " WHEN {$_POST['id'][$i]} THEN {$_POST['quantity'][$i]}";
        $ids .= "{$_POST['id'][$i]}, ";
    }
    $ids = rtrim($ids, " ,");


    $query = "UPDATE cart SET quantity = CASE id $cases END WHERE id IN($ids)";
    mysqli_query($db, $query);
    mysqli_close($db);

}
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
