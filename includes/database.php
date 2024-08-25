<?php

$db = mysqli_connect('localhost', 'root', 'Mijin67@', 'appsalon_mvc');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
// en el tercer parametro es password