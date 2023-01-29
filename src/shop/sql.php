<?php
function sqlConnect(){
    $servername = "database";
    $username = "root";
    $password = "example";
    $database = "shopdb";

    return mysqli_connect($servername,$username,$password,$database);
}