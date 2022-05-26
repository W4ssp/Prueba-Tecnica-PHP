<?php
include ("db_connection.php");

// $direccion = $_GET["direccion"];
$ciudad = $_GET["ciudad"];
$telefono = $_GET["telefono"];
$codigo_postal = $_GET["codigo_postal"];
$tipo = $_GET["tipo"];
$precio = $_GET["precio"];

// echo $direccion;
echo $ciudad;
echo $telefono;
echo $codigo_postal;
echo $tipo;
echo $precio;
$insert = "INSERT INTO bienes(id, direccion, ciudad, telefono, cod_postal, tipo, precio) VALUE (NULL, '', '$ciudad', '$telefono', '$codigo_postal', '$tipo', '$precio')";

$resultado = mysqli_query($conn, $insert);

if($resultado){
    echo "<script>alert('Se ha insertado la informacion'); 
    windows.location='/index.php';</script>";
}else{
    echo "<script>alert('Error');";
}
header('Location: index.php');

mysqli_close($conn);
