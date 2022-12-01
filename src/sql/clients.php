<style>
    table {
        padding: 0;
        border: solid;
        border-collapse: collapse;
    }

    td, th {
        margin: 0;
        border: solid;
    }

    .btn-delete {
        background-color: firebrick;
        width:100%;
    }

    .btn-edit {
        background-color: dodgerblue;
        width:100%;
    }

    .btn-update {
        background-color: mediumseagreen;
        width:100%;
    }
</style>
<?php
$servername = "database";
$username = "root";
$password = "example";

$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST["id"])) {
    $sql = "UPDATE appdb.Client 
SET 
    Nom = '$_POST[nom]',
    Adresse= '$_POST[address]',
    Tel='$_POST[tel]',
    Ville='$_POST[city]'
WHERE
    ID = $_POST[id];";
    $conn->query($sql);
} else if (isset($_POST["nom"])) {
    $sql = "INSERT INTO  appdb.Client 
    (Nom,Adresse, Tel,Ville) 
    VALUES ('$_POST[nom]', '$_POST[address]','$_POST[tel]','$_POST[city]');";
    $conn->query($sql);
}


$page = $_GET["page"] ?? 0;
$offset = ($page + 1) * 50;
$sql = "SELECT ID, Nom, Adresse,Tel,Ville FROM appdb.Client LIMIT 51 OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
        <tr style='position: sticky; top: 0;background-color: cornflowerblue'>
        <th>ID</th>
        <th>Nom</th>
        <th>Adresse</th>
        <th>Tel</th>
        <th>Ville</th>
        <th></th>
        <th></th>
       </tr>
";
    while ($row = $result->fetch_assoc()) {
        if (isset($_GET['edit']) && $_GET['edit'] == $row['ID']) {
            echo "<tr>
            <form method='post' action='?page=$page'>
            <td><input type='text' name='id' value='$row[ID]' readonly></td>
            <td><input type='text' name='nom' placeholder='Nom' value='$row[Nom]'></td>
            <td><input type='text' name='address' placeholder='Address' value='$row[Adresse]'></td>
            <td><input type='tel' name='tel' placeholder='Tel' value='$row[Tel]'></td>
            <td><input type='text' name='city' placeholder='Ville' value='$row[Ville]'></td>
            <td><a href='?page=$page'><button class='btn-edit'>Cancel</button></a></td>
            <td><input class='btn-update' type='submit' value='Update'></td>
            </form>
        </tr>
        ";
        } else {
            echo "<tr>
                <td>$row[ID]</td>
                <td>$row[Nom]</td>
                <td>$row[Adresse]</td>
                <td>$row[Tel]</td>
                <td>$row[Ville]</td>
                <td><a href='?edit=$row[ID]&page=$page'><button class='btn-edit'>Edit</button></a></td>
                <td><a href='?delete=$row[ID]&page=$page'><button class='btn-delete'>Delete</button></a></td>
                </tr>";
        }
    }
    echo "<tr>
            <form method='post' action='?page=$page'>
            <td></td>
            <td><input type='text' name='nom' placeholder='Nom'></td>
            <td><input type='text' name='address' placeholder='Address'></td>
            <td><input type='tel' name='tel' placeholder='Tel'></td>
            <td><input type='text' name='city' placeholder='Ville'></td>
            <td><input type='reset'></td>
            <td><input type='submit'></td>
            </form>
        </tr>
        ";
    echo "</table>";
    $prevPage = $page - 1;
    if ($page != 0) {
        echo "<a href='?page=$prevPage'><button>Previous</button></a>";
    }
    $nextPage = $page + 1;
    if ($result->num_rows == 51)
        echo "<a href='?page=$nextPage'><button>Next</button></a>";

} else {
    echo "0 results";
}
$conn->close();