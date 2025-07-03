<?php
class BarberoController extends Controller {
    
    public function __construct() {
        $this->requireAuth(['barbero']);
    }
    
    public function dashboard() {
        $citaModel = $this->model('Cita');
        $comisionModel = $this->model('Comision');
        
        $barbero_id = $_SESSION['user_id'];
        
        $data = [
            'citas_hoy' => $citaModel->getCitasHoyByBarbero($barbero_id),
            'citas_pendientes' => $citaModel->getCitasPendientesByBarbero($barbero_id),
            'comisiones_mes' => $comisionModel->getComisionesMesByBarbero($barbero_id),
            'total_comisiones' => $comisionModel->getTotalComisionesByBarbero($barbero_id)
        ];
        
        $this->view('barbero/dashboard', $data);
    }
    
    public function citas() {
        $citaModel = $this->model('Cita');
        $barbero_id = $_SESSION['user_id'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            $cita_id = $_POST['cita_id'] ?? '';
            
            if ($action === 'confirmar') {
                $citaModel->updateEstado($cita_id, 'confirmada');
            } elseif ($action === 'completar') {
                $citaModel->completarCita($cita_id);
            }
        }
        
        $data = ['citas' => $citaModel->getCitasByBarbero($barbero_id)];
        $this->view('barbero/citas', $data);
    }
    
    public function comisiones() {
        $comisionModel = $this->model('Comision');
        $barbero_id = $_SESSION['user_id'];
        
        $data = [
            'comisiones' => $comisionModel->getComisionesByBarbero($barbero_id),
            'total_pendiente' => $comisionModel->getTotalPendienteByBarbero($barbero_id),
            'total_pagado' => $comisionModel->getTotalPagadoByBarbero($barbero_id)
        ];
        
        $this->view('barbero/comisiones', $data);
    }
}
?>