<?php include '../app/views/includes/header.php'; ?>

<style>
    :root {
        --primary-gold: #d4af37;
        --dark-charcoal: #2c3e50;
        --light-gold: #f4e4aa;
        --accent-red: #c0392b;
        --soft-white: #fafafa;
        --glass-bg: rgba(255, 255, 255, 0.1);
        --shadow-dark: 0 25px 50px rgba(0, 0, 0, 0.25);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow: hidden;
        background: linear-gradient(135deg, #1a252f 0%, #2c3e50 50%, #34495e 100%);
        position: relative;
    }

    /* Animated Background */
    .login-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1a252f 0%, #2c3e50 50%, #34495e 100%);
        overflow: hidden;
        z-index: -1;
    }

    .login-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(212,175,55,0.1)"><animate attributeName="opacity" values="0;1;0" dur="4s" repeatCount="indefinite"/></circle><circle cx="80" cy="80" r="1.5" fill="rgba(212,175,55,0.15)"><animate attributeName="opacity" values="0;1;0" dur="3s" repeatCount="indefinite"/></circle><circle cx="50" cy="70" r="1" fill="rgba(212,175,55,0.2)"><animate attributeName="opacity" values="0;1;0" dur="5s" repeatCount="indefinite"/></circle><circle cx="30" cy="60" r="1.2" fill="rgba(212,175,55,0.12)"><animate attributeName="opacity" values="0;1;0" dur="3.5s" repeatCount="indefinite"/></circle></svg>') repeat;
        animation: float 25s linear infinite;
    }

    @keyframes float {
        0% { transform: translateY(0) rotate(0deg); }
        100% { transform: translateY(-30px) rotate(360deg); }
    }

    /* Left Side - Brand Section */
    .brand-section {
        position: relative;
        background: linear-gradient(135deg, var(--dark-charcoal) 0%, #34495e 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        overflow: hidden;
    }

    .brand-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, transparent 30%, rgba(212, 175, 55, 0.1) 50%, transparent 70%);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0%, 100% { transform: translateX(-100%); }
        50% { transform: translateX(100%); }
    }

    .brand-content {
        text-align: center;
        color: white;
        z-index: 2;
        position: relative;
        padding: 2rem;
    }

    .brand-icon {
        font-size: 6rem;
        color: var(--primary-gold);
        margin-bottom: 1.5rem;
        text-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .brand-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--primary-gold) 0%, var(--light-gold) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .brand-subtitle {
        font-size: 1.3rem;
        opacity: 0.9;
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    /* Right Side - Login Form */
    .login-section {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 2rem;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        backdrop-filter: blur(20px);
        position: relative;
    }

    .login-container {
        width: 100%;
        max-width: 450px;
        z-index: 10;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        padding: 3rem;
        box-shadow: var(--shadow-dark);
        animation: slideInRight 0.8s ease-out;
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, transparent 100%);
        border-radius: 25px;
        z-index: -1;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .login-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
        color: var(--dark-charcoal);
        position: relative;
    }

    .login-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        width: 60px;
        height: 3px;
        background: var(--primary-gold);
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Form Styling */
    .form-group {
        position: relative;
        margin-bottom: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-charcoal);
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 1rem 1.5rem;
        border: 2px solid rgba(212, 175, 55, 0.3);
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-gold);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        transform: translateY(-2px);
    }

    .form-control:hover {
        border-color: var(--primary-gold);
    }

    /* Password Toggle */
    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--dark-charcoal);
        cursor: pointer;
        font-size: 1.2rem;
        padding: 0.5rem;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .password-toggle:hover {
        background: rgba(212, 175, 55, 0.1);
        color: var(--primary-gold);
    }

    /* Submit Button */
    .btn-login {
        width: 100%;
        padding: 1.2rem;
        background: linear-gradient(135deg, var(--primary-gold) 0%, #b8941f 100%);
        border: none;
        border-radius: 15px;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: all 0.5s ease;
    }

    .btn-login:hover::before {
        left: 100%;
    }

    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(212, 175, 55, 0.5);
    }

    .btn-login:active {
        transform: translateY(-1px);
    }

    /* Alerts */
    .alert {
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        font-weight: 500;
        border: none;
        animation: slideInDown 0.5s ease-out;
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(192, 57, 43, 0.1) 0%, rgba(231, 76, 60, 0.1) 100%);
        color: var(--accent-red);
        border-left: 4px solid var(--accent-red);
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(39, 174, 96, 0.1) 0%, rgba(46, 204, 113, 0.1) 100%);
        color: #27ae60;
        border-left: 4px solid #27ae60;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Links */
    .login-links {
        text-align: center;
        margin-top: 1.5rem;
    }

    .login-links p {
        color: #666;
        margin-bottom: 0.5rem;
    }

    .login-links a {
        color: var(--primary-gold);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }

    .login-links a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-gold);
        transition: all 0.3s ease;
    }

    .login-links a:hover::after {
        width: 100%;
    }

    .login-links a:hover {
        color: #b8941f;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #999;
        text-decoration: none;
        font-size: 0.9rem;
        margin-top: 1rem;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        color: var(--primary-gold);
        transform: translateX(-3px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .brand-section {
            display: none;
        }
        
        .login-section {
            padding: 1rem;
        }
        
        .login-card {
            padding: 2rem;
            border-radius: 20px;
        }
        
        .brand-title {
            font-size: 2rem;
        }
        
        .login-title {
            font-size: 2rem;
        }
    }

    /* Loading Animation */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .loading .btn-login {
        position: relative;
    }

    .loading .btn-login::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="login-background"></div>

<div class="container-fluid vh-100">
    <div class="row h-100">
        <!-- Left Side - Brand Section -->
        <div class="col-lg-6 brand-section">
            <div class="brand-content">
                <div class="brand-icon">
                    <i class="fas fa-cut"></i>
                </div>
                <h1 class="brand-title">Barbería Pro</h1>
                <p class="brand-subtitle">Sistema de gestión profesional para barberías modernas</p>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="col-lg-6 login-section">
            <div class="login-container">
                <div class="login-card">
                    <h2 class="login-title">Bienvenido</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" id="loginForm">
                        <div class="form-group">
                            <label for="usuario" class="form-label">
                                <i class="fas fa-user"></i> Usuario
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="usuario" 
                                   name="usuario" 
                                   placeholder="Ingresa tu nombre de usuario"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Contraseña
                            </label>
                            <div style="position: relative;">
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Ingresa tu contraseña"
                                       required>
                                <button type="button" class="password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-login" id="loginBtn">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                        </button>
                    </form>
                    
                    <div class="login-links">
                        <p>¿No tienes cuenta? 
                            <a href="<?= BASE_URL ?>index.php?url=auth/register">
                                Regístrate aquí
                            </a>
                        </p>
                        <a href="<?= BASE_URL ?>landing.php" class="back-link">
                            <i class="fas fa-arrow-left"></i> Volver al inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
    
    // Form submission loading state
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    
    loginForm.addEventListener('submit', function() {
        loginBtn.classList.add('loading');
        loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Iniciando sesión...';
        setTimeout(() => {
            loginBtn.classList.remove('loading');
            loginBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Iniciar Sesión';
        }, 2000);
    });
    
    // Input focus animations
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.animation = 'slideInDown 0.5s ease-out reverse';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
});
</script>

<?php include '../app/views/includes/footer.php'; ?>