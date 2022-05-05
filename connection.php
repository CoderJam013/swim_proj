<?php

$dbhost = "localhost";
$dbuser = "swimming_admin";
$dbpass = "swimming123";
$dbname = "swimming";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("Failed to connect.");
}