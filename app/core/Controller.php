<?php
class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
    
    public function view($view, $data = []) {
        extract($data);
        require_once '../app/views/' . $view . '.php';
    }
    
    protected function redirect($url) {
        header('Location: ' . BASE_URL . 'index.php?url=' . $url);
        exit();
    }
    
    protected function requireAuth($allowedRoles = []) {
        if (!SessionHelper::isLoggedIn()) {
            $this->redirect('auth/login');
        }
        
        if (!empty($allowedRoles) && !in_array(SessionHelper::getUserRole(), $allowedRoles)) {
            $this->redirect('auth/login');
        }
    }
}
?>

