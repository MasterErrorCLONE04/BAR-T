<?php include '../app/views/includes/header.php'; ?>

<style>
    :root {
        --primary-gold: #d4af37;
        --dark-charcoal: #2c3e50;
        --light-gold: #f4e4aa;
        --accent-green: #27ae60;
        --accent-red: #c0392b;
        --soft-white: #fafafa;
        --glass-bg: rgba(255, 255, 255, 0.1);
        --shadow-dark: 0 25px 50px rgba(0, 0, 0, 0.25);
        --success-green: #2ecc71;
        --success-light: #58d68d;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow-x: hidden;
        background: linear-gradient(135deg, #1a252f 0%, #2c3e50 50%, #34495e 100%);
        position: relative;
        min-height: 100vh;
    }

    /* Animated Background */
    .register-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1a252f 0%, #2c3e50 50%, #34495e 100%);
        overflow: hidden;
        z-index: -1;
    }

    .register-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="15" cy="25" r="1.5" fill="rgba(46,204,113,0.1)"><animate attributeName="opacity" values="0;1;0" dur="3s" repeatCount="indefinite"/></circle><circle cx="85" cy="75" r="2" fill="rgba(46,204,113,0.15)"><animate attributeName="opacity" values="0;1;0" dur="4s" repeatCount="indefinite"/></circle><circle cx="45" cy="80" r="1.2" fill="rgba(46,204,113,0.12)"><animate attributeName="opacity" values="0;1;0" dur="2.5s" repeatCount="indefinite"/></circle><circle cx="70" cy="30" r="1.8" fill="rgba(46,204,113,0.08)"><animate attributeName="opacity" values="0;1;0" dur="3.5s" repeatCount="indefinite"/></circle><circle cx="25" cy="65" r="1" fill="rgba(46,204,113,0.2)"><animate attributeName="opacity" values="0;1;0" dur="4.5s" repeatCount="indefinite"/></circle></svg>') repeat;
        animation: float 30s linear infinite;
    }

    @keyframes float {
        0% { transform: translateY(0) rotate(0deg); }
        100% { transform: translateY(-40px) rotate(360deg); }
    }

    /* Left Side - Welcome Section */
    .welcome-section {
        position: relative;
        background: linear-gradient(135deg, var(--success-green) 0%, var(--success-light) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        overflow: hidden;
    }

    .welcome-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1) 0%, transparent 50%);
        animation: pulse-bg 4s ease-in-out infinite;
    }

    @keyframes pulse-bg {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.6; }
    }

    .welcome-content {
        text-align: center;
        color: white;
        z-index: 2;
        position: relative;
        padding: 2rem;
        animation: slideInLeft 0.8s ease-out;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .welcome-icon {
        font-size: 7rem;
        margin-bottom: 1.5rem;
        text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }

    .welcome-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 4px 8px rgba(0,0,0,0.3);
        line-height: 1.2;
    }

    .welcome-subtitle {
        font-size: 1.4rem;
        opacity: 0.95;
        font-weight: 300;
        letter-spacing: 0.5px;
        margin-bottom: 2rem;
    }

    .welcome-features {
        list-style: none;
        text-align: left;
        max-width: 300px;
        margin: 0 auto;
    }

    .welcome-features li {
        padding: 0.5rem 0;
        display: flex;
        align-items: center;
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .welcome-features li i {
        margin-right: 1rem;
        color: rgba(255,255,255,0.8);
        width: 20px;
    }

    /* Right Side - Register Form */
    .register-section {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 2rem;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        backdrop-filter: blur(20px);
        position: relative;
        overflow-y: auto;
    }

    .register-container {
        width: 100%;
        max-width: 500px;
        z-index: 10;
    }

    .register-card {
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

    .register-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(46, 204, 113, 0.1) 0%, transparent 100%);
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

    .register-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
        color: var(--dark-charcoal);
        position: relative;
    }

    .register-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        width: 80px;
        height: 3px;
        background: var(--success-green);
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Form Styling */
    .form-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .form-group {
        position: relative;
        margin-bottom: 2rem;
        flex: 1;
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
        border: 2px solid rgba(46, 204, 113, 0.3);
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--success-green);
        box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.2);
        transform: translateY(-2px);
    }

    .form-control:hover {
        border-color: var(--success-green);
    }

    .form-control.valid {
        border-color: var(--success-green);
        background: rgba(46, 204, 113, 0.1);
    }

    .form-control.invalid {
        border-color: var(--accent-red);
        background: rgba(192, 57, 43, 0.1);
    }

    /* Input Icons */
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--success-green);
        font-size: 1.1rem;
        z-index: 2;
    }

    .form-control.with-icon {
        padding-left: 3rem;
    }

    /* Password Strength Indicator */
    .password-strength {
        margin-top: 0.5rem;
        height: 4px;
        background: rgba(0,0,0,0.1);
        border-radius: 2px;
        overflow: hidden;
    }

    .password-strength-bar {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .password-strength.weak .password-strength-bar {
        width: 33%;
        background: var(--accent-red);
    }

    .password-strength.medium .password-strength-bar {
        width: 66%;
        background: #f39c12;
    }

    .password-strength.strong .password-strength-bar {
        width: 100%;
        background: var(--success-green);
    }

    /* Submit Button */
    .btn-register {
        width: 100%;
        padding: 1.2rem;
        background: linear-gradient(135deg, var(--success-green) 0%, var(--success-light) 100%);
        border: none;
        border-radius: 15px;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(46, 204, 113, 0.3);
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: all 0.5s ease;
    }

    .btn-register:hover::before {
        left: 100%;
    }

    .btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(46, 204, 113, 0.5);
    }

    .btn-register:active {
        transform: translateY(-1px);
    }

    .btn-register:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
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
        background: linear-gradient(135deg, rgba(46, 204, 113, 0.1) 0%, rgba(88, 214, 141, 0.1) 100%);
        color: var(--success-green);
        border-left: 4px solid var(--success-green);
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
    .register-links {
        text-align: center;
        margin-top: 1.5rem;
    }

    .register-links p {
        color: #666;
        margin-bottom: 0.5rem;
    }

    .register-links a {
        color: var(--success-green);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }

    .register-links a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--success-green);
        transition: all 0.3s ease;
    }

    .register-links a:hover::after {
        width: 100%;
    }

    .register-links a:hover {
        color: var(--accent-green);
    }

    /* Validation Messages */
    .validation-message {
        font-size: 0.85rem;
        margin-top: 0.5rem;
        padding: 0.5rem;
        border-radius: 8px;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }

    .validation-message.show {
        opacity: 1;
        transform: translateY(0);
    }

    .validation-message.success {
        color: var(--success-green);
        background: rgba(46, 204, 113, 0.1);
    }

    .validation-message.error {
        color: var(--accent-red);
        background: rgba(192, 57, 43, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .welcome-section {
            display: none;
        }
        
        .register-section {
            padding: 1rem;
        }
        
        .register-card {
            padding: 2rem;
            border-radius: 20px;
        }
        
        .welcome-title {
            font-size: 2.5rem;
        }
        
        .register-title {
            font-size: 2rem;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }

    /* Loading Animation */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .loading .btn-register {
        position: relative;
    }

    .loading .btn-register::after {
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

    /* Progress Steps */
    .progress-steps {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .step {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(46, 204, 113, 0.3);
        margin: 0 5px;
        transition: all 0.3s ease;
    }

    .step.active {
        background: var(--success-green);
        transform: scale(1.2);
    }
</style>

<div class="register-background"></div>

<div class="container-fluid vh-100">
    <div class="row h-100">
        <!-- Left Side - Welcome Section -->
        <div class="col-lg-6 welcome-section">
            <div class="welcome-content">
                <div class="welcome-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1 class="welcome-title">¡Únete a Nosotros!</h1>
                <p class="welcome-subtitle">Descubre todas las ventajas de Barbería Pro</p>
                
                <ul class="welcome-features">
                    <li><i class="fas fa-check"></i> Gestión completa de citas</li>
                    <li><i class="fas fa-check"></i> Control de inventario</li>
                    <li><i class="fas fa-check"></i> Reportes detallados</li>
                    <li><i class="fas fa-check"></i> Soporte 24/7</li>
                    <li><i class="fas fa-check"></i> Actualizaciones gratuitas</li>
                </ul>
            </div>
        </div>
        
        <!-- Right Side - Register Form -->
        <div class="col-lg-6 register-section">
            <div class="register-container">
                <div class="register-card">
                    <div class="progress-steps">
                        <div class="step active"></div>
                        <div class="step"></div>
                        <div class="step"></div>
                        <div class="step"></div>
                    </div>
                    
                    <h2 class="register-title">Crear Cuenta</h2>
                    
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
                    
                    <form method="POST" id="registerForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-user"></i> Nombre Completo
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nombre" 
                                       name="nombre" 
                                       placeholder="Ingresa tu nombre completo"
                                       required>
                                <div class="validation-message" id="nombreMsg"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="usuario" class="form-label">
                                    <i class="fas fa-at"></i> Usuario
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="usuario" 
                                       name="usuario" 
                                       placeholder="Elige tu nombre de usuario"
                                       required>
                                <div class="validation-message" id="usuarioMsg"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="correo" class="form-label">
                                    <i class="fas fa-envelope"></i> Correo Electrónico
                                </label>
                                <input type="email" 
                                       class="form-control" 
                                       id="correo" 
                                       name="correo" 
                                       placeholder="ejemplo@correo.com"
                                       required>
                                <div class="validation-message" id="correoMsg"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Contraseña
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Mínimo 8 caracteres"
                                       required>
                                <div class="password-strength" id="passwordStrength">
                                    <div class="password-strength-bar"></div>
                                </div>
                                <div class="validation-message" id="passwordMsg"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="confirm_password" class="form-label">
                                    <i class="fas fa-lock"></i> Confirmar Contraseña
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="confirm_password" 
                                       name="confirm_password" 
                                       placeholder="Repite tu contraseña"
                                       required>
                                <div class="validation-message" id="confirmMsg"></div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-register" id="registerBtn">
                            <i class="fas fa-user-plus"></i> Crear Cuenta
                        </button>
                    </form>
                    
                    <div class="register-links">
                        <p>¿Ya tienes cuenta? 
                            <a href="<?= BASE_URL ?>index.php?url=auth/login">
                                Inicia sesión aquí
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form elements
    const form = document.getElementById('registerForm');
    const inputs = form.querySelectorAll('.form-control');
    const registerBtn = document.getElementById('registerBtn');
    const steps = document.querySelectorAll('.step');
    
    // Validation patterns
    const patterns = {
        nombre: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,50}$/,
        usuario: /^[a-zA-Z0-9_]{3,20}$/,
        correo: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        password: /^.{8,}$/
    };
    
    // Validation messages
    const messages = {
        nombre: {
            invalid: 'El nombre debe tener entre 2 y 50 caracteres, solo letras',
            valid: 'Nombre válido'
        },
        usuario: {
            invalid: 'Usuario debe tener 3-20 caracteres, solo letras, números y _',
            valid: 'Usuario disponible'
        },
        correo: {
            invalid: 'Ingresa un correo electrónico válido',
            valid: 'Correo válido'
        },
        password: {
            invalid: 'La contraseña debe tener al menos 8 caracteres',
            valid: 'Contraseña segura'
        },
        confirm_password: {
            invalid: 'Las contraseñas no coinciden',
            valid: 'Contraseñas coinciden'
        }
    };
    
    // Password strength checker
    function checkPasswordStrength(password) {
        const strength = document.getElementById('passwordStrength');
        let score = 0;
        
        if (password.length >= 8) score++;
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;
        
        strength.className = 'password-strength';
        if (score <= 2) strength.classList.add('weak');
        else if (score <= 3) strength.classList.add('medium');
        else strength.classList.add('strong');
        
        return score;
    }
    
    // Validate field
    function validateField(field) {
        const value = field.value.trim();
        const name = field.name;
        const msgElement = document.getElementById(name + 'Msg');
        
        let isValid = false;
        
        if (name === 'confirm_password') {
            const password = document.getElementById('password').value;
            isValid = value === password && value.length > 0;
        } else if (patterns[name]) {
            isValid = patterns[name].test(value);
        }
        
        // Update UI
        field.classList.remove('valid', 'invalid');
        msgElement.classList.remove('show', 'success', 'error');
        
        if (value.length > 0) {
            if (isValid) {
                field.classList.add('valid');
                msgElement.textContent = messages[name].valid;
                msgElement.classList.add('show', 'success');
            } else {
                field.classList.add('invalid');
                msgElement.textContent = messages[name].invalid;
                msgElement.classList.add('show', 'error');
            }
        }
        
        return isValid;
    }
    
    // Update progress steps
    function updateSteps() {
        const validFields = form.querySelectorAll('.form-control.valid').length;
        const totalFields = inputs.length;
        const progress = Math.floor((validFields / totalFields) * steps.length);
        
        steps.forEach((step, index) => {
            step.classList.toggle('active', index < progress);
        });
    }
    
    // Input event listeners
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.name === 'password') {
                checkPasswordStrength(this.value);
            }
            validateField(this);
            updateSteps();
        });
        
        input.addEventListener('blur', function() {
            validateField(this);
            updateSteps();
        });
        
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isFormValid = true;
        inputs.forEach(input => {
            if (!validateField(input)) {
                isFormValid = false;
            }
        });
        
        if (isFormValid) {
            registerBtn.classList.add('loading');
            registerBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creando cuenta...';
            
            // Simulate API call
            setTimeout(() => {
                this.submit();
            }, 1000);
        } else {
            // Shake animation for invalid form
            this.style.animation = 'shake 0.5s ease-in-out';
            setTimeout(() => {
                this.style.animation = '';
            }, 500);
        }
    });
    
    // Auto-hide alerts
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

// Shake animation for invalid form
const style = document.createElement('style');
style.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
`;
document.head.appendChild(style);
</script>

<?php include '../app/views/includes/footer.php'; ?>