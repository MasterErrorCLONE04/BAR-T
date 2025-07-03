<?php
// Script to add balance to administrator account for testing
require_once '../app/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = (float)($_POST['amount'] ?? 0);
    
    if ($amount > 0) {
        try {
            $userModel = new Usuario();
            if ($userModel->addToAdminBalance($amount)) {
                $message = "✅ Se agregaron $" . number_format($amount, 2) . " al saldo del administrador";
            } else {
                $message = "❌ Error al agregar saldo";
            }
        } catch (Exception $e) {
            $message = "❌ Error: " . $e->getMessage();
        }
    } else {
        $message = "❌ Ingrese un monto válido";
    }
}

// Get current balance
try {
    $userModel = new Usuario();
    $currentBalance = $userModel->getAdminBalance();
} catch (Exception $e) {
    $currentBalance = 0;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Saldo - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-wallet"></i> Gestión de Saldo del Administrador</h5>
                    </div>
                    <div class="card-body">
                        <?php if (isset($message)): ?>
                            <div class="alert alert-info"><?= $message ?></div>
                        <?php endif; ?>
                        
                        <div class="alert alert-secondary">
                            <strong>Saldo actual:</strong> $<?= number_format($currentBalance, 2) ?>
                        </div>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Monto a agregar</label>
                                <input type="number" class="form-control" id="amount" name="amount" 
                                       min="0" step="0.01" placeholder="0.00" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Agregar Saldo
                            </button>
                        </form>
                        
                        <hr>
                        
                        <div class="text-center">
                            <a href="index.php" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Volver a la Aplicación
                            </a>
                        </div>
                        
                        <div class="mt-3">
                            <small class="text-muted">
                                <strong>Nota:</strong> Este saldo se reduce automáticamente cada vez que se completa una cita y se genera una comisión para el barbero.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
