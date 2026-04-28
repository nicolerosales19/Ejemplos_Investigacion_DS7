<?php
// 1. Interfaz
interface RespuestaInterfase {
    public function enviarRespuesta($datos);
}

// 2. Clase Abstracta
abstract class ProcesadorBase implements RespuestaInterfase {
    protected $codigoEstado = 200;

    // Constructor para que se pueda cambiar el estado (ej: 404 si no hay producto)
    public function __construct($estado = 200) {
        $this->codigoEstado = $estado;
    }

    public function enviarRespuesta($datos) {
        http_response_code($this->codigoEstado);
        header('Content-Type: application/json');
        echo json_encode($datos);
        exit;
    }

    abstract public function ejecutarLogica($input);
}

// 3. Utilidades
class ValidadorHelper {
    // Limpia texto para evitar errores o inyecciones básicas
    public static function limpiar($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    //Método para validar que el monto no sea negativo ni vacío
    public static function esMontoValido($monto) {
        return is_numeric($monto) && $monto > 0;
    }
}