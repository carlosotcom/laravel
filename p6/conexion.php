<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'p6_producto2';

$conection = @mysqli_connect($host,$user,$password,$db);

if(!$conection){
    echo "Error en la conexion";
}

?>