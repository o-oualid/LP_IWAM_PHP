<?php
$links = ["Faculté" => "http://www.fsr.ac.ma", "Université" => "http://www.um5.ac.ma/um5r/", "Presse-marocaine" => "https://presse-marocaine.fr"];

echo "<ul>";

foreach ($links as $site => $Link)
    echo "<li><a href='$Link'>$site</a></li>";
echo "</ul>";

