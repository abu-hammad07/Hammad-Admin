<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "huner";

$conn  = mysqli_connect($server , $username , $password ,$database);
if (!$conn){
    die("database not conected " .mysqli_connect_error());
}
?>