<?php

//Definir las constantes para la conexion a la base de datos
define('SERVIDOR','fuchibol.ddns.net');
define('PUERTO','3306');
define('USUARIO','root');
define('PASSWORD','*Royner123123*');
define('BD','caro_net');

//Definir la variable $servidor con los datos de la conexion
$servidor = "mysql:host=".SERVIDOR.";port=".PUERTO.";dbname=".BD;

try{
    //Realizar la conexion a la base de datos
    $pdo = new PDO($servidor,USUARIO,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    /* echo "La conexión a la base de datos fue con exito"; */
}catch (PDOException $e){
    //print_r($e);
    echo "Error al conectar a la base de datos";
}

//Definir la variable $URL con la ruta del sistema
$URL = "https://fuchibol.ddns.net/caro_net/";

//Definir la zona horaria
date_default_timezone_set("America/lima");
//Definir la fecha y hora actual
$fecha = date('Y-m-d');
$hora = date('H:i:s');
$fechaHora = $fecha.' '.$hora;





