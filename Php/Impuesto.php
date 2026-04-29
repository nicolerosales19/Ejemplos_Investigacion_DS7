<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$monto = $data['monto'] ?? 0;
$total = $monto * 1.07;

echo json_encode(["total"=>$total]);