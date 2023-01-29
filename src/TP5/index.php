<form method="POST">
    <input type="submit" name="clients" value="Afficher les clients">
</form>
<form method="POST">
    ID du client: <input type="text" name="client">
    <input type="submit" name="commandes_client" value="Afficher les commandes">
</form>
<form method="POST">
    Catégorie: <input type="text" name="categorie">
    <input type="submit" name="produits_categorie" value="Afficher les produits">
</form>
<form method="POST">
    Date: <input type="date" name="date">
    <input type="submit" name="commandes_date" value="Afficher les commandes">
</form>
<form method="POST">
    Numero client: <input type="text" name="client">
    <input type="submit" name="produit_commander" value="Afficher les produits commander par un client">
</form>

<?php
include "mysqliConnect.php";

if (isset($_POST['clients'])) {

    $conn = sqlConnect();


    $query = "SELECT * FROM Client LIMIT 50";


    $result = mysqli_query($conn, $query);


    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Nom</th><th>Tel</th><th>Ville</th><th>Adresse</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $row['ID'] . '</td>';
        echo '<td>' . $row['Nom'] . '</td>';
        echo '<td>' . $row['Tel'] . '</td>';
        echo '<td>' . $row['Ville'] . '</td>';
        echo '<td>' . $row['Adresse'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';


    mysqli_close($conn);
}
?>

<?php
if (isset($_POST['commandes_client'])) {

    $conn = sqlConnect();


    $client_id = $_POST['client'];


    $query = "SELECT * FROM Commande WHERE NumClt = $client_id LIMIT 50";


    $result = mysqli_query($conn, $query);


    echo '<table border="1">';
    echo '<tr><th>Num</th><th>Date</th><th>NumClt</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $row['Num'] . '</td>';
        echo '<td>' . $row['Date'] . '</td>';
        echo '<td>' . $row['NumClt'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';


    mysqli_close($conn);
}
?>

<?php
if (isset($_POST['produits_categorie'])) {

    $conn = sqlConnect();


    $categorie = $_POST['categorie'];


    $query = "SELECT * FROM Produit WHERE Categorie = '$categorie' LIMIT 50";


    $result = mysqli_query($conn, $query);


    echo '<table border="1">';
    echo '<tr><th>Référence</th><th>Prix</th><th>Désignation</th><th>Catégorie</th><th>Prix d\'acquisition</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $row['Reference'] . '</td>';
        echo '<td>' . $row['Prix'] . '</td>';
        echo '<td>' . $row['Designation'] . '</td>';
        echo '<td>' . $row['Categorie'] . '</td>';
        echo '<td>' . $row['PrixAcquisition'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    mysqli_close($conn);
}
?>

<?php
if (isset($_POST['commandes_date'])) {

    $conn = sqlConnect();

    $date = $_POST['date'];

    $query = "SELECT * FROM Commande WHERE Date = '$date' LIMIT 50";

    $result = mysqli_query($conn, $query);

    echo '<table border="1">';
    echo '<tr><th>Num</th><th>Date</th><th>NumClt</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $row['Num'] . '</td>';
        echo '<td>' . $row['Date'] . '</td>';
        echo '<td>' . $row['NumClt'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    mysqli_close($conn);
}
?>

<?php
if (isset($_POST['produit_commander'])) {

    $conn = sqlConnect();

    $client_id = $_POST['client'];

    $query = "SELECT *  FROM Commande CM left join LigneDeCommande LDC on CM.Num = LDC.NumCmd left join Produit P on LDC.Refprod=P.Reference where CM.NumClt='$client_id'";

    $result = mysqli_query($conn, $query);
    echo '<table border="1">';
    echo '<tr><th>Num command</th><th>Date command</th><th>Produit Reference</th><th>Prix</th><th>Designation</th><th>Categorie</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $row['Num'] . '</td>';
        echo '<td>' . $row['Date'] . '</td>';
        echo '<td>' . $row['Reference'] . '</td>';
        echo '<td>' . $row['Prix'] . '</td>';
        echo '<td>' . $row['Designation'] . '</td>';
        echo '<td>' . $row['Categorie'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    mysqli_close($conn);
}
?>
