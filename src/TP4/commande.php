<?php
$servername = "database";
$username = "root";
$password = "example";
$database = "appdb";

if (isset($_POST['clientID'])) {
    $date = date('Y-m-d');
    $conn = new mysqli($servername, $username, $password, $database);
    $InsertCommandSql = "INSERT INTO Commande (`Date`,NumClt) Values ('$date','$_POST[clientID]')";
    $conn->query($InsertCommandSql);
    $commandId = mysqli_insert_id($conn);
    $values = "";
    foreach ($_POST['products'] as $line) {
        $values .= " ($line[id],$commandId,$line[quantity]),";
    }
    $values=rtrim($values, ",");
    $InsertLinesOfCommandsSql = "INSERT INTO LigneDeCommande VALUES $values;";
    $conn->query( $InsertLinesOfCommandsSql);
    header("location:?commande=$commandId");
}

if (isset($_GET['commande'])) {
    $conn = new mysqli($servername, $username, $password, $database);

    $InsertCommandSql = "SELECT * FROM Commande inner join LigneDeCommande on Commande.Num = LigneDeCommande.NumCmd inner join Produit P on LigneDeCommande.Refprod = P.Reference where Commande.Num='$_GET[commande]'";
    $result = $conn->query($InsertCommandSql);
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>Product Reference</th>
                <th>Designation</th>
                <th>PrixAcquisition</th>
                <th>Quantite</th>
              </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>$row[Refprod]</td>
                <td>$row[Designation]</td>
                <td>$row[PrixAcquisition]</td>
                <td>$row[Quantite]</td>
            </tr>
        ";
        }
        echo "</table>";
    }
    $conn->close();
} else {
    echo "<form id='form' method='post'>
        <input type='number' name='clientID' placeholder='Client ID'><br>
        <div id='productsList'>
            <input type='number' name='products[0][id]' placeholder='Product ID'>
            <input type='number' name='products[0][quantity]' placeholder='Quantity'><br>
        </div>
        <input type='submit'>
        <button id='addProduct' type='button'>Add Product</button>
    </form>";
}

?>


<div id="output">
</div>

<script>
    let id = 1;
    document.getElementById("addProduct").onclick = (event) => {
        let productID = document.createElement("input");
        productID.setAttribute('name', "products[" + id + "][id]");
        productID.setAttribute('type', "number");
        productID.setAttribute('placeholder', "Product ID");
        document.getElementById("productsList").appendChild(productID);

        let quantity = document.createElement("input");
        quantity.setAttribute('name', "products[" + id + "][quantity]");
        quantity.setAttribute('type', "number");
        quantity.setAttribute('placeholder', "Quantity");
        document.getElementById("productsList").appendChild(quantity);

        let breakLine = document.createElement("br");
        document.getElementById("productsList").append(breakLine);
        id++;
    };
</script>
