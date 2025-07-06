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
            'admin_balance' => $userModel->getAdminBalance()
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
                $data['success'] = 'Barbero creado exitosamente.';
            } else {
                $data['error'] = 'Error al crear barbero.';
            }
        }

        elseif ($action === 'edit_barbero') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $usuario = $_POST['usuario'];
            $correo = $_POST['correo'];
            $comision = $_POST['comision'];

            if ($userModel->actualizarBarbero($id, $nombre, $usuario, $correo, $comision)) {
                $data['success'] = 'Barbero actualizado correctamente.';
            } else {
                $data['error'] = 'Error al actualizar barbero.';
            }
        }

        elseif ($action === 'delete_barbero') {
            $id = $_POST['id'];

            if ($userModel->desactivarBarbero($id)) {
                $data['success'] = 'Barbero eliminado (inactivado) correctamente.';
            } else {
                $data['error'] = 'Error al eliminar barbero.';
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
                $nombre = $_POST['nombre'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $precio = $_POST['precio'] ?? 0;
                
                if ($servicioModel->create($nombre, $descripcion, $precio)) {
                    $data['success'] = 'Servicio creado exitosamente';
                } else {
                    $data['error'] = 'Error al crear servicio';
                }
            }
            
            elseif ($action === 'update') {
                $id = $_POST['id'] ?? 0;
                $nombre = $_POST['nombre'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $precio = $_POST['precio'] ?? 0;
                
                if ($servicioModel->update($id, $nombre, $descripcion, $precio)) {
                    $data['success'] = 'Servicio actualizado exitosamente';
                } else {
                    $data['error'] = 'Error al actualizar servicio';
                }
            }
            
            elseif ($action === 'delete') {
                $id = $_POST['id'] ?? 0;
                $result = $servicioModel->delete($id);
                
                if ($result['success']) {
                    $data['success'] = $result['message'];
                } else {
                    $data['error'] = $result['message'];
                }
            }
        }
        
        $data['servicios'] = $servicioModel->getAllWithStats();
        $this->view('admin/servicios', $data ?? []);
    }
    
    public function citas() {
        $citaModel = $this->model('Cita');
        $data = ['citas' => $citaModel->getAllWithDetails()];
        $this->view('admin/citas', $data);
    }
    
    public function comisiones() {
        $comisionModel = $this->model('Comision');
        $userModel = $this->model('Usuario');
        
        $data = [
            'comisiones' => $comisionModel->getAllWithDetails(),
            'admin_balance' => $userModel->getAdminBalance()
        ];
        
        $this->view('admin/comisiones', $data);
    }
    
    public function pagos() {
        $comisionModel = $this->model('Comision');
        $pagoModel = $this->model('Pago');
        $userModel = $this->model('Usuario');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $barbero_id = $_POST['barbero_id'] ?? '';
            
            if (!empty($barbero_id)) {
                // Get all pending commissions for this barber
                $sql = "SELECT GROUP_CONCAT(id) as comisiones_ids FROM comisiones WHERE barbero_id = ? AND estado = 'pendiente'";
                $result = $comisionModel->fetch($sql, [$barbero_id]);
                
                if ($result && !empty($result['comisiones_ids'])) {
                    try {
                        if ($pagoModel->procesarPago($barbero_id, $result['comisiones_ids'])) {
                            $data['success'] = 'Pago procesado exitosamente. El monto ha sido descontado del saldo.';
                        } else {
                            $data['error'] = 'Error al procesar el pago. Verifique el log de errores.';
                        }
                    } catch (Exception $e) {
                        $data['error'] = 'Error: ' . $e->getMessage();
                    }
                } else {
                    $data['error'] = 'No hay comisiones pendientes para este barbero';
                }
            }
        }
        
        $data['comisiones_pendientes'] = $comisionModel->getPendientesByBarbero();
        $data['pagos_realizados'] = $pagoModel->getAll();
        $data['admin_balance'] = $userModel->getAdminBalance();
        
        $this->view('admin/pagos', $data ?? []);
    }
}
?>
