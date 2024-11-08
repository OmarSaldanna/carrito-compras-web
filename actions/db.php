<?php

function connect_db () {
    // conexion a la db
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "carrito";
    // Crear conexion
    // version para mysql
    $conn = new mysqli($servername, $username, $password, $dbname);
    // version para psql
    // $conn = pg_connect("host=127.0.0.1 port=5432 dbname=$dbname user=$username password=$password");
    // retornar el cursor
    return $conn;
}

function query ($conn, $q) {
    // ejecutar la query
    return $conn->query($q);
}

function disconnect_db ($conn) {
    // cerrar la conexion
    // solo hay en mysql
    $conn->close();
}

// funcion para redirigir
function redirect ($to, $msg) {
    header("Location: $to?alert=$msg");
    exit();
}

?>