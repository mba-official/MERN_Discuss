<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'mern_discuss';

$con = mysqli_connect($server, $username, $password, $database);
if (!$con) {
    echo 'Connection Failed due to'. mysqli_connect_error();
}
?>