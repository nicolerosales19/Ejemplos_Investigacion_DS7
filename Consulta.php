<?php
require_once 'Procesador.php';

class Buscador extends ProcesadorBase {

    //Metodo principal que recibe el ID
    public function ejecutarLogica($id) {

        //Base de datos sulada (con array)
        $db = [
            "10" => ["nombre" => "Serum Facial", "precio" => 25],
            "20" => ["nombre" => "Crema Hidratante", "precio" => 15],
            "30" => ["nombre" => "Protector Solar", "precio" => 18]
        ];

        //Verificar si el ID existe en el array
        if (array_key_exists($id, $db)) {

            //Respuesta exitosa
            $this->enviarRespuesta(["status" => "ok", "data" => $db[$id]]);
        } else {

            //Si no existe se devuele el error 404
            $this->codigoEstado = 404;
            $this->enviarRespuesta(["status" => "error", "msj" => "No existe"]);
        }
    }
}

$id = ValidadorHelper::limpiar($_GET['id'] ?? '');
$app = new Buscador();
$app->ejecutarLogica($id);