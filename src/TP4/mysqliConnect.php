<?php
function sqlConnect(){
    $servername = "database";
    $username = "root";
    $password = "example";
    $database = "appdb";

    return mysqli_connect($servername,$username,$password,$database);
}