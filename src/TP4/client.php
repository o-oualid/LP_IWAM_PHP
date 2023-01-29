<?php
require 'mysqliConnect.php';

if (isset($_POST["delete"])) {
    $connection = sqlConnect();
    if (!$connection) die("Connection failed!");
    $sql = "DELETE FROM Client WHERE ID=$_POST[id]";
    mysqli_query($connection, $sql);
    mysqli_close($connection);
    header("location:./client.php");
} else if (isset($_POST["update"])) {
    $connection = sqlConnect();
    if (!$connection) die("Connection failed!");
    $sql = "UPDATE appdb.Client 
SET 
    Nom = '$_POST[nom]',
    Adresse= '$_POST[address]',
    Tel='$_POST[tel]',
    Ville='$_POST[city]'
WHERE
    ID = $_POST[id];";
    mysqli_query($connection,$sql);
    mysqli_close($connection);
} else if (isset($_POST["insert"])) {
    $connection = sqlConnect();
    if (!$connection) die("Connection failed!");
    $sql = "INSERT INTO  appdb.Client 
    (Nom,Adresse, Tel,Ville) 
    VALUES ('$_POST[nom]', '$_POST[address]','$_POST[tel]','$_POST[city]');";
    mysqli_query($connection, $sql);
    $commandId = mysqli_insert_id($connection);
    mysqli_close($connection);
    header("location:?client=$commandId");
}
if (isset($_GET['client'])) {
    $connection = sqlConnect();
    if (!$connection) die("Connection failed!");
    $sql = "SELECT ID, Nom, Adresse,Tel,Ville FROM appdb.Client where ID='$_GET[client]'";
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "
<fieldset style='float: left'>
    <legend>Update Client</legend>
    <form method='post' action='?client=$_GET[client]'>
    <table>
        <tr><th>ID</th><td><input type='text' name='id'  value='$row[ID]' readonly></td></tr>
        <tr><th>Nom</th><td><input type='text' name='nom' placeholder='Nom' value='$row[Nom]'></td></tr>
        <tr><th>Address</th><td><input type='text' name='address' placeholder='Address' value='$row[Adresse]'></td></tr>
        <tr><th>Tel</th><td><input type='tel' name='tel' placeholder='Tel' value='$row[Tel]'></td></tr>
        <tr><th>Ville</th><td><input type='text' name='city' placeholder='Ville' value='$row[Ville]'></td></tr>
        <tr><td colspan='2'>
        <input name='update' type='submit' value='Update'>
        <input type='submit' name='delete' value='Delete'>
        </td></tr>
        </table>    
    </form>
</fieldset>

    ";
    } else {
        echo "<b>Client not found!</b>";
    }
    mysqli_close($connection);
}

echo "
<fieldset style='float: left'>
    <legend>Insert Client</legend>
    <form method='post'>
    <table>
        <tr><th>Nom</th><td><input type='text' name='nom' placeholder='Nom'></td></tr>
        <tr><th>Address</th><td><input type='text' name='address' placeholder='Address'></td></tr>
        <tr><th>Tel</th><td><input type='tel' name='tel' placeholder='Tel' ></td></tr>
        <tr><th>Ville</th><td><input type='text' name='city' placeholder='Ville'></td></tr>
        <tr><td><input name='insert' type='submit' value='Insert'></td><td><input type='reset'></td></tr>
        </table>    
    </form>
</fieldset>
    ";
?>
<fieldset style="float: left">
    <legend>Find Client</legend>
<form method="get">
    <input type="text" name="client" placeholder="Client ID">
    <input type="submit" value="Find Client">
</form>
</fieldset>