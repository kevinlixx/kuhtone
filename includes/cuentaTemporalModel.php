<?php
class CuentaTemporal {
    private $conection;

    public function __construct($conection) {
        $this->conection = $conection;
    }

    public function obtenerCuentasTemporales() {
        $consulta = mysqli_query($this->conection, "SELECT * FROM cuentas_temporales") or die ("Error al traer los datos");
        $cuentas = [];
        if(mysqli_num_rows($consulta) > 0) {
            while($consulta_total= mysqli_fetch_array($consulta)) {
                $datos_usuario = json_decode($consulta_total["datos_usuario"], true);
                if ($datos_usuario === null) {
                    continue;
                }
                $ruta_imagen = ltrim($datos_usuario["foto_perfil"], '.');
                $correo = "No disponible";
                if ($consulta_total["tipo_usuario"] == "profesional" && array_key_exists("correo_profesional", $datos_usuario)) {
                    $correo = $datos_usuario["correo_profesional"];
                } elseif (array_key_exists("correo", $datos_usuario)) {
                    $correo = $datos_usuario["correo"];
                }
                $cuenta = [
                    'tipo_usuario' => $consulta_total["tipo_usuario"],
                    'nombres' => $datos_usuario["nombres"],
                    'apellidos' => $datos_usuario["apellidos"],
                    'correo' => $correo,
                    'telefono_movil' => $datos_usuario["telefono_movil"],
                    'ruta_imagen' => $ruta_imagen
                ];
                if ($consulta_total["tipo_usuario"] == "profesional" && array_key_exists("especializacion", $datos_usuario)) {
                    $cuenta['especializacion'] = html_entity_decode($datos_usuario["especializacion"], ENT_QUOTES, 'UTF-8');
                }
                $cuentas[] = $cuenta;
            }
        }
        return $cuentas;
    }
    
    public function restaurarCuenta($tipo_usuario, $correo) {
        if ($tipo_usuario == 'administrador') {
            $tabla = 'administrador';
            $campo_correo = 'correo';
        } elseif ($tipo_usuario == 'paciente') {
            $tabla = 'paciente';
            $campo_correo = 'correo';
        } elseif ($tipo_usuario == 'profesional') {
            $tabla = 'profesional';
            $campo_correo = 'correo_profesional';
        } else {
            return "Tipo de usuario inválido";
        }

        $consulta = "UPDATE $tabla SET estado_cuenta = 1 WHERE $campo_correo = '$correo'";
        $resultado = mysqli_query($this->conection, $consulta);

        if ($resultado) {
            return true;
        } else {
            return mysqli_error($this->conection);
        }
    }
    public function eliminarCuentaTemporal($tipo_usuario, $correo) {
        if ($tipo_usuario == 'administrador') {
            $campo_correo = 'correo';
        } elseif ($tipo_usuario == 'paciente') {
            $campo_correo = 'correo';
        } elseif ($tipo_usuario == 'profesional') {
            $campo_correo = 'correo_profesional';
        } else {
            return "Tipo de usuario inválido";
        }

        $consulta = "DELETE FROM cuentas_temporales WHERE tipo_usuario = '$tipo_usuario' AND JSON_EXTRACT(datos_usuario, '$.$campo_correo') = '$correo'";
        $resultado = mysqli_query($this->conection, $consulta);

        if ($resultado) {
            return true;
        } else {
            return mysqli_error($this->conection);
        }
    }
}
?>