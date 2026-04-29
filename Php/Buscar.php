<?php
header('Content-Type: application/json');

$productos = [
    ["id"=>10, "nombre"=>"serum facial", "precio"=>25],
    ["id"=>20, "nombre"=>"crema hidratante", "precio"=>30],
    ["id"=>30, "nombre"=>"protector solar", "precio"=>20]
];

$nombre = strtolower($_GET['nombre'] ?? '');

foreach ($productos as $p) {
    if (str_contains($p['nombre'], $nombre)) {
        echo json_encode(["data"=>$p]);
        exit;
    }
}

echo json_encode(["msj"=>"No encontrado"]);