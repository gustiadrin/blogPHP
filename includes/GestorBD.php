<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "blog";

$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

if(!isset($_SESSION)){
    session_start();
}
?>