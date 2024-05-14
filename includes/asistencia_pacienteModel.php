<?php
// asistencia_pacienteModel.php
class AsistenciaPacienteModel {
    private $conection;
    private $error_message = "";

    public function __construct($conection) {
        $this->conection = $conection;
    }

    public function getPacienteInfo($id_paciente) {
        $consulta = "SELECT nombres, apellidos FROM paciente WHERE id_paciente = ?";
        $stmt = $this->conection->prepare($consulta);
        $stmt->bind_param("i", $id_paciente);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($paciente_nombres, $paciente_apellidos);
            $stmt->fetch();
            return array($paciente_nombres, $paciente_apellidos);
        } else {
            $this->error_message = "No se encontró ningún paciente con ese ID.";
            return null;
        }
    }
    public function insertarSesion($id_paciente, $id_profesional, $fecha_sesion) {
        // Agregar una línea para depurar el valor de $id_profesional
        error_log("id_profesional: $id_profesional");
    
        $sql = "INSERT INTO sesion (id_paciente, id_profesional, fecha_sesion) VALUES (?, ?, ?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("iis", $id_paciente, $id_profesional, $fecha_sesion);
    
        // Agregar una validación para asegurarse de que $id_profesional tenga un valor
        if ($id_profesional == null) {
            $this->error_message = "El ID del profesional no puede ser nulo";
            return false;
        }
    
        if ($stmt->execute()) {
            return $this->conection->insert_id;
        } else {
            $this->error_message = "Error al crear la sesión: " . $stmt->error;
            return false;
        }
    }   
    public function updateAsistencia($asistio, $reporte, $id_paciente, $id_sesion, $id_diagnostico) {
        $sql = "UPDATE sesion SET asistencia = ?, reporte_sesion = ?, id_diagnostico = ? WHERE id_paciente = ? AND id_sesion = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param("issii", $asistio, $reporte, $id_diagnostico, $id_paciente, $id_sesion);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $this->error_message = "Error al guardar la asistencia y el reporte: " . $stmt->error;
            return false;
        }
    }
    // Nueva función obtenerSesion
    public function obtenerSesion($id_paciente, $id_profesional) {
        $consulta = "SELECT id_sesion FROM sesion WHERE id_paciente = ? AND id_profesional = ?";
        $stmt = $this->conection->prepare($consulta);
        $stmt->bind_param("ii", $id_paciente, $id_profesional);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id_sesion);
            $stmt->fetch();
            return array('id_sesion' => $id_sesion);
        } else {
            return false;
        }
    }
        // Nueva función actualizarDiagnosticoSesion
        public function actualizarDiagnosticoSesion($id_diagnostico, $id_sesion) {
            $sql = "UPDATE sesion SET id_diagnostico = ? WHERE id_sesion = ?";
            $stmt = $this->conection->prepare($sql);
            $stmt->bind_param("ii", $id_diagnostico, $id_sesion);
    
            if ($stmt->execute()) {
                return true;
            } else {
                $this->error_message = "Error al actualizar el diagnóstico de la sesión: " . $stmt->error;
                return false;
            }
        }
    
        // Nueva función obtenerDiagnosticos
        public function obtenerDiagnosticos() {
            $consulta = "SELECT id_diagnostico, descripcion FROM diagnostico";
            $stmt = $this->conection->prepare($consulta);
            $stmt->execute();
            $stmt->store_result();
    
            $diagnosticos = [];
    
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id_diagnostico, $descripcion);
                while ($stmt->fetch()) {
                    $diagnosticos[] = ['id_diagnostico' => $id_diagnostico, 'descripcion' => $descripcion];
                }
            }
    
            return $diagnosticos;
        }
    public function getErrorMessage() {
        return $this->error_message;
    }

}
?>