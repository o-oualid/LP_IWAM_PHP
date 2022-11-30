<?php
foreach (range(0, 10) as $i)
    $users["user" . $i] = random_int(0, 100);

foreach ($users as $user => $value)
    echo $user . " : " . $value . "<br>";