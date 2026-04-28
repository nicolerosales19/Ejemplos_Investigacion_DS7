<?php
require_once 'Procesador.php';

class Calculadora extends ProcesadorBase {

    //Metodo que recibe los datos JSON del frontend
    public function ejecutarLogica($json) {

        //Obtener valores del JSON, y si no vienen valores se asigna null o default
        $monto = $json['monto'] ?? null;
        $tipo = $json['tipo'] ?? 'general';
        
        //Validacion de que el monto debe ser numerico y mayor a 0
        if (!ValidadorHelper::esMontoValido($monto)) {
            $this->codigoEstado = 400; 
            $this->enviarRespuesta([
                "error" => "El monto debe ser un número mayor a 0"
            ]);
        }

        //Convertir el monto a numero decimal
        $monto = (float)$monto;

        //Definir y calcular monto segun tipo (estudiantes = 20% y general = 5%)
        $desc = ($tipo === 'estudiante') ? 0.20 : 0.05;
        $final = $monto - ($monto * $desc);

        //Enviar respuesta exitosa en JSON
        $this->enviarRespuesta([
            "descuento" => ($desc * 100) . "%",
            "total" => number_format($final, 2)
        ]);
    }
}

$datos = json_decode(file_get_contents('php://input'), true);
$app = new Calculadora();
$app->ejecutarLogica($datos);