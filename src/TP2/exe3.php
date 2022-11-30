<?php
if (isset($_POST["clients"])) {
    echo "<table>";
    $clients = $_POST["clients"];
    sort($clients,SORT_FLAG_CASE|SORT_STRING);
    foreach ($clients as $client)
        echo "<tr><td>$client</td></tr>";
    echo "</table>";
} else {
    echo "No clients!!";
}