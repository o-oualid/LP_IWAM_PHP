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
if (isset($_POST["Reference"])) {
    $sql = "UPDATE appdb.Produit 
SET 
    Reference = '$_POST[Reference]',
    Prix= '$_POST[Prix]',
    Designation='$_POST[Designation]',
    Categorie='$_POST[Categorie]',
    PrixAcquisition='$_POST[PrixAcquisition]'
    WHERE
    Reference = $_POST[Reference];";
    $conn->query($sql);
} else if (isset($_POST["Reference"])) {
    $sql = "INSERT INTO  appdb.Produit 
    (Reference,Prix, Designation,Categorie,PrixAcquisition) 
    VALUES ('$_POST[Reference]', '$_POST[Prix]','$_POST[Designation]','$_POST[Categorie]','$_POST[PrixAcquisition]');";
    $conn->query($sql);
}


$page = $_GET["page"] ?? 0;
$offset = ($page + 1) * 50;
$sql = "SELECT Reference, Prix,Designation,Categorie,PrixAcquisition FROM appdb.Produit LIMIT 51 OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
        <tr style='position: sticky; top: 0;background-color: cornflowerblue'>
        <th>Reference</th>
        <th>Prix</th>
        <th>Designation</th>
        <th>Categorie</th>
        <th>PrixAcquisition</th>
        <th></th>
        <th></th>
       </tr>
";
    while ($row = $result->fetch_assoc()) {
        if (isset($_GET['edit']) && $_GET['edit'] == $row['Reference']) {
            echo "<tr>
            <form method='post' action='?page=$page'>
            <td><input type='text' name='Reference' value='$row[Reference]' readonly></td>
            <td><input type='text' name='Prix' placeholder='Prix' value='$row[Prix]'></td>
            <td><input type='text' name='Designation' placeholder='Designation' value='$row[Designation]'></td>
            <td><input type='text' name='Categorie' placeholder='Categorie' value='$row[Categorie]'></td>
            <td><input type='text' name='PrixAcquisition' placeholder='PrixAcquisition' value='$row[Categorie]'></td>
            <td><a href='?page=$page'><button class='btn-edit'>Cancel</button></a></td>
            <td><input class='btn-update' type='submit' value='Update'></td>
            </form>
        </tr>
        ";
        } else {
            echo "<tr>
                <td>$row[Reference]</td>
                <td>$row[Prix]</td>
                <td>$row[Designation]</td>
                <td>$row[Categorie]</td>
                <td>$row[PrixAcquisition]</td>
                <td><a href='?edit=$row[Reference]&page=$page'><button class='btn-edit'>Edit</button></a></td>
                <td><a href='?delete=$row[Reference]&page=$page'><button class='btn-delete'>Delete</button></a></td>
                </tr>";
        }
    }
    echo "<tr>
            <form method='post' action='?page=$page'>
            <td></td>
            <td><input type='text' name='Reference' placeholder='Reference'></td>
            <td><input type='text' name='Prix' placeholder='Prix'></td>
            <td><input type='text' name='Designation' placeholder='Designation'></td>
            <td><input type='text' name='Categorie' placeholder='Categorie'></td>
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