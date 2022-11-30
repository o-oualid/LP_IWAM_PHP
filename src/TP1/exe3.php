<?php

foreach (range(0, 10) as $i)
    $students["student" . $i] = random_int(0, 20);

$moyeen = array_sum($students) / sizeof($students);

echo "le moyeen est: ".$moyeen."<br>";
echo "les etudiants qui ont une note supperieur a ".$moyeen."sont: <br>";
echo "<ul>";
foreach ($students as $student => $value)
    if ($value > $moyeen)
        echo "<li>".$student . " : " . $value . "<br></li>";
echo "<ul>";