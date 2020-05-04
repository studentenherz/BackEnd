<?php

// Local Host
// $dbservername = "localhost";
// $dbusername = "root";
// $dbpassword = "";
// $dbname= "test";

// Heroku db
$dbservername = "us-cdbr-iron-east-01.cleardb.net";
$dbusername = "bda1832a94bdaf";
$dbpassword = "f96bd5ef";
$dbname= "heroku_3017ab9bd457826";


$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

$frontEndUrl = "http://127.0.0.1/FrontEnd/";
// $frontEndUrl = "https://studentenherz.github.io/FrontEnd/";
$filesFolder = '../avatar/';
