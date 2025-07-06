<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbería Pro - Software de Gestión para Barberías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-charcoal: #2c3e50;
            --light-gold: #f4e4aa;
            --accent-red: #c0392b;
            --soft-white: #fafafa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a252f 0%, #2c3e50 50%, #34495e 100%);
            z-index: -1;
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="25" cy="25" r="2" fill="rgba(212,175,55,0.1)"><animate attributeName="opacity" values="0;1;0" dur="3s" repeatCount="indefinite"/></circle><circle cx="75" cy="75" r="1.5" fill="rgba(212,175,55,0.15)"><animate attributeName="opacity" values="0;1;0" dur="4s" repeatCount="indefinite"/></circle><circle cx="50" cy="80" r="1" fill="rgba(212,175,55,0.2)"><animate attributeName="opacity" values="0;1;0" dur="2s" repeatCount="indefinite"/></circle></svg>') repeat;
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-20px) rotate(360deg); }
        }

        /* Navigation */
        .navbar {
            backdrop-filter: blur(20px);
            background: rgba(26, 37, 47, 0.9) !important;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-gold) !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .navbar-nav .nav-link {
            color: white !important;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 1rem !important;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-gold);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover::after {
            width: 80%;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-gold) !important;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            animation: slideInUp 1s ease-out;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--light-gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .cta-button {
            background: linear-gradient(135deg, var(--primary-gold) 0%, #b8941f 100%);
            border: none;
            padding: 1rem 2.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50px;
            color: white;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
            position: relative;
            overflow: hidden;
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: all 0.5s ease;
        }

        .cta-button:hover::before {
            left: 100%;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.5);
            color: white;
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: var(--soft-white);
            position: relative;
        }

        .section-title {
            text-align: center;
            font-size: 3rem;
            font-weight: 700;
            color: var(--dark-charcoal);
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            width: 80px;
            height: 4px;
            background: var(--primary-gold);
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid rgba(212, 175, 55, 0.2);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.05) 0%, transparent 100%);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.3);
        }

        .feature-icon {
            font-size: 3.5rem;
            color: var(--primary-gold);
            margin-bottom: 1.5rem;
            display: block;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-charcoal);
            margin-bottom: 1rem;
            text-align: center;
        }

        .feature-text {
            color: #666;
            text-align: center;
            line-height: 1.6;
        }

        /* Software Benefits Section */
        .benefits-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--dark-charcoal) 0%, #34495e 100%);
            color: white;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .benefit-item:hover {
            background: rgba(212, 175, 55, 0.2);
            transform: translateX(10px);
        }

        .benefit-icon {
            font-size: 2rem;
            color: var(--primary-gold);
            margin-right: 1rem;
            width: 60px;
            text-align: center;
        }

        /* Footer */
        .footer {
            background: #1a252f;
            color: white;
            padding: 3rem 0;
            text-align: center;
        }

        .footer-brand {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-gold);
            margin-bottom: 1rem;
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .section-title {
                font-size: 2.5rem;
            }
            
            .feature-card {
                padding: 2rem;
            }
        }

        /* Scroll animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-cut"></i> Barbería Pro
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="#funcionalidades">Funcionalidades</a>
                    <a class="nav-link" href="#beneficios">Beneficios</a>
                    <a class="nav-link" href="index.php?url=auth/login">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </a>
                    <a class="nav-link" href="index.php?url=auth/register">
                        <i class="fas fa-user-plus"></i> Prueba Gratis
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            Gestiona tu Barbería como un Pro
                        </h1>
                        <p class="hero-subtitle">
                            Software completo para barberías modernas: gestión de citas, clientes, inventario y más. 
                            Transforma tu negocio con tecnología de vanguardia.
                        </p>
                        <a href="index.php?url=auth/register" class="cta-button">
                            <i class="fas fa-rocket"></i> Comenzar Ahora
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image text-center">
                        <i class="fas fa-tablet-alt" style="font-size: 15rem; color: var(--primary-gold); opacity: 0.8;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="funcionalidades">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Funcionalidades Principales</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card animate-on-scroll">
                        <i class="fas fa-calendar-check feature-icon"></i>
                        <h3 class="feature-title">Gestión de Citas</h3>
                        <p class="feature-text">
                            Sistema intuitivo para agendar, modificar y cancelar citas. 
                            Recordatorios automáticos para reducir ausencias.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card animate-on-scroll">
                        <i class="fas fa-users feature-icon"></i>
                        <h3 class="feature-title">Base de Clientes</h3>
                        <p class="feature-text">
                            Historial completo de servicios, preferencias y contacto. 
                            Fidelización mediante programas de lealtad.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card animate-on-scroll">
                        <i class="fas fa-chart-line feature-icon"></i>
                        <h3 class="feature-title">Reportes y Analytics</h3>
                        <p class="feature-text">
                            Análisis detallado de ventas, servicios más populares y 
                            tendencias para optimizar tu negocio.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card animate-on-scroll">
                        <i class="fas fa-boxes feature-icon"></i>
                        <h3 class="feature-title">Control de Inventario</h3>
                        <p class="feature-text">
                            Gestión automática de productos, alertas de stock bajo 
                            y control de proveedores.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card animate-on-scroll">
                        <i class="fas fa-credit-card feature-icon"></i>
                        <h3 class="feature-title">Pagos Integrados</h3>
                        <p class="feature-text">
                            Procesamiento seguro de pagos con tarjeta, efectivo 
                            y métodos digitales populares.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card animate-on-scroll">
                        <i class="fas fa-mobile-alt feature-icon"></i>
                        <h3 class="feature-title">Acceso Móvil</h3>
                        <p class="feature-text">
                            Aplicación responsive que funciona en cualquier dispositivo. 
                            Gestiona tu barbería desde donde estés.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section" id="beneficios">
        <div class="container">
            <h2 class="section-title animate-on-scroll">¿Por qué elegir Barbería Pro?</h2>
            <div class="row">
                <div class="col-lg-6">
                    <div class="benefit-item animate-on-scroll">
                        <div class="benefit-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4>Ahorra tiempo</h4>
                            <p>Automatiza tareas repetitivas y enfócate en lo que realmente importa: tus clientes.</p>
                        </div>
                    </div>
                    <div class="benefit-item animate-on-scroll">
                        <div class="benefit-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div>
                            <h4>Aumenta ingresos</h4>
                            <p>Optimiza tu agenda, reduce cancelaciones y aumenta la satisfacción del cliente.</p>
                        </div>
                    </div>
                    <div class="benefit-item animate-on-scroll">
                        <div class="benefit-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h4>Datos seguros</h4>
                            <p>Información encriptada y respaldos automáticos para total tranquilidad.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="benefit-item animate-on-scroll">
                        <div class="benefit-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div>
                            <h4>Soporte 24/7</h4>
                            <p>Equipo de expertos disponible para ayudarte cuando lo necesites.</p>
                        </div>
                    </div>
                    <div class="benefit-item animate-on-scroll">
                        <div class="benefit-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div>
                            <h4>Actualizaciones gratuitas</h4>
                            <p>Nuevas funcionalidades y mejoras sin costo adicional.</p>
                        </div>
                    </div>
                    <div class="benefit-item animate-on-scroll">
                        <div class="benefit-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <div>
                            <h4>Fácil implementación</h4>
                            <p>Configura tu barbería en minutos y comienza a usar el sistema inmediatamente.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-brand">
                <i class="fas fa-cut"></i> Barbería Pro
            </div>
            <p class="mb-0">© 2025 Barbería Pro. El futuro de la gestión de barberías.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(26, 37, 47, 0.95)';
            } else {
                navbar.style.background = 'rgba(26, 37, 47, 0.9)';
            }
        });
    </script>
</body>
</html>