<?php
//database_connection.php

$connect = new mysqli('localhost', 'root', '','testing2');

if($connect->connect_error){
    die("error : " . $connect->connect_error);
}

?>