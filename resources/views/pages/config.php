<?php

$hostname = "localhost";
$username = "u947756916_proyecto";
$password = "Proyecto+2014";
$database = "u947756916_proyecto";

$conn = mysqli_connect($hostname, $username, $password, $database) or die("Database connection failed");

$base_url = "https://educanube.info/proyecto/";
$my_email = "edufasala@hotmail.com";

$smtp['host'] = "smtp.hostinger.com";
$smtp['user'] = "admin@voiparkas.com";
$smtp['pass'] = "Admin+2014";
$smtp['port'] = 465;
