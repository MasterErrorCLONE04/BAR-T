<?php include '../app/views/includes/header.php'; ?>

<div class="container-fluid vh-100">
    <div class="row h-100">
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-primary">
            <div class="text-center text-white">
                <i class="fas fa-cut fa-5x mb-4"></i>
                <h2>Barbería Pro</h2>
                <p class="lead">Sistema de gestión profesional</p>
            </div>
        </div>
        
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="w-100" style="max-width: 400px;">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h3 class="card-title text-center mb-4">Iniciar Sesión</h3>
                        
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?= $success ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mb-3">Iniciar Sesión</button>
                        </form>
                        
                        <div class="text-center">
                            <p>¿No tienes cuenta? <a href="<?= BASE_URL ?>index.php?url=auth/register">Regístrate aquí</a></p>
                            <a href="<?= BASE_URL ?>landing.php" class="text-muted">← Volver al inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../app/views/includes/footer.php'; ?>
