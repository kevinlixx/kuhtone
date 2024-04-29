<?php
class crudPerfil
{
    private $conection;

    public function __construct($conection)
    {
        $this->conection = $conection;
    }

    public function obtenerPerfil($tabla, $id, $campo_id)
    {
        $consulta = "SELECT * FROM $tabla WHERE $campo_id = $id";
        $resultado = mysqli_query($this->conection, $consulta) or die("Error al traer los datos");
        return mysqli_fetch_array($resultado);
    }


    public function actualizarPerfil($tabla, $datos, $id, $campo_id)
    {
        // Filtrar los datos para asegurarse de que todas las claves corresponden a las columnas de la tabla
        $datos = $this->filtrarDatos($tabla, $datos);

        $campos_valores = $this->generarCamposValores($datos);
        $consulta = "UPDATE $tabla SET $campos_valores WHERE $campo_id = $id";
        echo $consulta; // Imprimir la consulta SQL
        $resultado = mysqli_query($this->conection, $consulta) or die(mysqli_error($this->conection));
        if (!$resultado) {
            echo "Error al actualizar los datos: " . mysqli_error($this->conection);
        }
        return $resultado;
    }

    private function filtrarDatos($tabla, $datos)
    {
        // Obtener las columnas de la tabla
        $consulta = "SHOW COLUMNS FROM $tabla";
        $resultado = mysqli_query($this->conection, $consulta) or die(mysqli_error($this->conection));
        $columnas = array();
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $columnas[] = $fila['Field']; // Quitar la conversión a minúsculas
        }

        // Filtrar los datos
        $datos_filtrados = array();
        foreach ($datos as $clave => $valor) {
            if (in_array($clave, $columnas)) { // Quitar la conversión a minúsculas
                $datos_filtrados[$clave] = $valor;
            }
        }

        return $datos_filtrados;
    }


    public function inhabilitarCuenta($tabla, $id, $campo_id)
    {
        $consulta_inhabilitar = "UPDATE $tabla SET estado_cuenta = '2' WHERE $campo_id = $id";
        $resultado = mysqli_query($this->conection, $consulta_inhabilitar) or trigger_error("Query Failed! SQL-Error: " . mysqli_error($this->conection), E_USER_ERROR);

        if ($resultado) {
            $consulta_datos = "SELECT * FROM $tabla WHERE $campo_id = $id";
            $resultado_datos = mysqli_query($this->conection, $consulta_datos) or trigger_error("Query Failed! SQL-Error: " . mysqli_error($this->conection), E_USER_ERROR);
            $datos_usuario = mysqli_fetch_assoc($resultado_datos);

            $datos_usuario_JSON = json_encode($datos_usuario);
            $insertar_temporal_SQL = "INSERT INTO cuentas_temporales (id_original, tipo_usuario, fecha_eliminacion, datos_usuario) VALUES ('$id', '$tabla', NOW(), '$datos_usuario_JSON')";
            mysqli_query($this->conection, $insertar_temporal_SQL) or trigger_error("Query Failed! SQL-Error: " . mysqli_error($this->conection), E_USER_ERROR);

            return true;
        } else {
            return false;
        }
    }

    private function generarCamposValores($datos)
    {
        $campos_valores = "";
        foreach ($datos as $campo => $valor) {
            $campos_valores .= "$campo = '$valor', ";
        }
        $campos_valores = rtrim($campos_valores, ", ");
        return $campos_valores;
    }
}
