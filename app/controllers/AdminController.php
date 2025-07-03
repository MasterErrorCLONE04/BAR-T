<?php
class AdminController extends Controller {
    
    public function __construct() {
        $this->requireAuth(['admin']);
    }
    
    public function dashboard() {
    $citaModel = $this->model('Cita');
    $userModel = $this->model('Usuario');
    $comisionModel = $this->model('Comision');

    $data = [
        'total_citas' => $citaModel->getTotalCitas(),
        'total_barberos' => $userModel->getTotalByRole('barbero'),
        'total_clientes' => $userModel->getTotalByRole('cliente'),
        'comisiones_pendientes' => $comisionModel->getTotalPendientes(),
        'citas_recientes' => $citaModel->getRecientes(5),
        'saldo_admin' => $userModel->getSaldoAdmin() // ✅ nuevo dato
    ];

    $this->view('admin/dashboard', $data);
}

    
    public function usuarios() {
        $userModel = $this->model('Usuario');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            
            if ($action === 'create_barbero') {
                $nombre = $_POST['nombre'];
                $usuario = $_POST['usuario'];
                $password = $_POST['password'];
                $correo = $_POST['correo'];
                $comision = $_POST['comision'];
                
                if ($userModel->createBarbero($nombre, $usuario, $password, $correo, $comision)) {
                    $data['success'] = 'Barbero creado exitosamente';
                } else {
                    $data['error'] = 'Error al crear barbero';
                }
            }
        }
        
        $data['barberos'] = $userModel->getByRole('barbero');
        $data['clientes'] = $userModel->getByRole('cliente');
        
        $this->view('admin/usuarios', $data ?? []);
    }
    
    public function servicios() {
        $servicioModel = $this->model('Servicio');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            
            if ($action === 'create') {
                if ($servicioModel->create($_POST['nombre'], $_POST['descripcion'], $_POST['precio'])) {
                    $data['success'] = 'Servicio creado exitosamente';
                } else {
                    $data['error'] = 'Error al crear servicio';
                }
            }
        }
        
        $data['servicios'] = $servicioModel->getAll();
        $this->view('admin/servicios', $data ?? []);
    }
    
    public function citas() {
        $citaModel = $this->model('Cita');
        $data = ['citas' => $citaModel->getAllWithDetails()];
        $this->view('admin/citas', $data);
    }
    
    public function comisiones() {
        $comisionModel = $this->model('Comision');
        $data = ['comisiones' => $comisionModel->getAllWithDetails()];
        $this->view('admin/comisiones', $data);
    }
    
    public function pagos() {
        $comisionModel = $this->model('Comision');
        $pagoModel = $this->model('Pago');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $barbero_id = $_POST['barbero_id'] ?? '';
            
            if (!empty($barbero_id)) {
                // Get all pending commissions for this barber
                $sql = "SELECT GROUP_CONCAT(id) as comisiones_ids FROM comisiones WHERE barbero_id = ? AND estado = 'pendiente'";
                $result = $comisionModel->fetch($sql, [$barbero_id]);
                
                if ($result && !empty($result['comisiones_ids'])) {
                    if ($pagoModel->procesarPago($barbero_id, $result['comisiones_ids'])) {
                        $data['success'] = 'Pago procesado exitosamente';
                    } else {
                        $data['error'] = 'Error al procesar el pago';
                    }
                } else {
                    $data['error'] = 'No hay comisiones pendientes para este barbero';
                }
            }
        }
        
        $data['comisiones_pendientes'] = $comisionModel->getPendientesByBarbero();
        $data['pagos_realizados'] = $pagoModel->getAll();
        
        $this->view('admin/pagos', $data ?? []);
    }
}
?>