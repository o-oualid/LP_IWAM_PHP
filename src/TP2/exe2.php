<?php

function printTable($table)
{
    echo "<table>";
    foreach ($table as $row) {
        echo "<tr>";
        foreach ($table as $item=>$value) {
          echo "<td>$value<td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}