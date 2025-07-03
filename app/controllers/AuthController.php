<?php
class AuthController extends Controller {
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $userModel = $this->model('Usuario');
            $user = $userModel->authenticate($usuario, $password);
            
            if ($user) {
                SessionHelper::set('user_id', $user['id']);
                SessionHelper::set('user_name', $user['nombre']);
                SessionHelper::set('user_role', $user['rol']);
                
                // Redirigir según el rol
                switch ($user['rol']) {
                    case 'admin':
                        $this->redirect('admin/dashboard');
                        break;
                    case 'barbero':
                        $this->redirect('barbero/dashboard');
                        break;
                    case 'cliente':
                        $this->redirect('cliente/dashboard');
                        break;
                }
            } else {
                $data['error'] = 'Usuario o contraseña incorrectos';
            }
        }
        
        $this->view('auth/login', $data ?? []);
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $usuario = $_POST['usuario'] ?? '';
            $password = $_POST['password'] ?? '';
            $correo = $_POST['correo'] ?? '';
            
            $userModel = $this->model('Usuario');
            
            if ($userModel->create($nombre, $usuario, $password, $correo, 'cliente')) {
                $data['success'] = 'Registro exitoso. Puedes iniciar sesión.';
            } else {
                $data['error'] = 'Error al registrar usuario';
            }
        }
        
        $this->view('auth/register', $data ?? []);
    }
    
    public function logout() {
        SessionHelper::destroy();
        $this->redirect('auth/login');
    }
}
?>