<?php
$users = [
    "Chrissy" => ["prenom" => "Dodridge", "ville" => "Zhangcaizhuang", "age" => 73],
    "Annelise" => ["prenom" => "Satteford", "ville" => "Stavropol", "age" => 22],
    "Zabrina" => ["prenom" => "Godilington", "ville" => "Zhanaozen", "age" => 79],
    "Kennan" => ["prenom" => "Escott", "ville" => "Yataity del Norte", "age" => 22],
];
?>

<table>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Ville</th>
        <th>Age</th>
    </tr>
    <?php
    foreach ($users as $nom => $values) {
        echo "<tr>";
        echo "<td>" . $nom . "</td>";
        foreach ($values as $key => $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
