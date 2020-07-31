<?php

$servername="localhost";
$dbUserName="shanybi_root";
$dbPassword="12345";
$dbName="shanybi_sadnaB_dr_homework";

$connection = mysqli_connect($servername,$dbUserName,$dbPassword,$dbName);

if (!connection){
    die("Connection Failed: ".mysqli_connect_error());
}