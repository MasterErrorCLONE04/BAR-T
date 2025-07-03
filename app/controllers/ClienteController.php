<?php
class ClienteController extends Controller {
    
    public function __construct() {
        $this->requireAuth(['cliente']);
    }
    
    public function dashboard() {
        $citaModel = $this->model('Cita');
        $cliente_id = $_SESSION['user_id'];
        
        $data = [
            'proxima_cita' => $citaModel->getProximaCitaByCliente($cliente_id),
            'citas_recientes' => $citaModel->getCitasRecientesByCliente($cliente_id, 5)
        ];
        
        $this->view('cliente/dashboard', $data);
    }
    
    public function agendar() {
        $servicioModel = $this->model('Servicio');
        $userModel = $this->model('Usuario');
        $citaModel = $this->model('Cita');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente_id = $_SESSION['user_id'];
            $barbero_id = $_POST['barbero_id'];
            $servicio_id = $_POST['servicio_id'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            
            if ($citaModel->create($cliente_id, $barbero_id, $servicio_id, $fecha, $hora)) {
                $data['success'] = 'Cita agendada exitosamente';
            } else {
                $data['error'] = 'Error al agendar la cita';
            }
        }
        
        $data['servicios'] = $servicioModel->getAll();
        $data['barberos'] = $userModel->getByRole('barbero');
        
        $this->view('cliente/agendar', $data ?? []);
    }
    
    public function historial() {
        $citaModel = $this->model('Cita');
        $cliente_id = $_SESSION['user_id'];
        
        $data = ['citas' => $citaModel->getCitasByCliente($cliente_id)];
        $this->view('cliente/historial', $data);
    }
}
?>