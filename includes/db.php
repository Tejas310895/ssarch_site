<?php

if ($_SERVER['HTTP_HOST'] == 'localhost') {

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "ssarch";
    $port = 3306;
} else {
    $host = "localhost";
    $username = "u404775056_ssarch";
    $password = "Ssarchtech@11";
    $database = "u404775056_ssarch";
}

$con = new mysqli($host, $username, $password, $database, $port);

if ($con->connect_error) {
    echo $con->connect_error;
}
