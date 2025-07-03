<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbería Profesional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 100px 0;
        }
        .service-card {
            transition: transform 0.3s;
        }
        .service-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-cut"></i> Barbería Pro</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php?url=auth/login">Iniciar Sesión</a>
                <a class="nav-link" href="index.php?url=auth/register">Registrarse</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Bienvenido a Barbería Pro</h1>
            <p class="lead mb-4">El mejor servicio de barbería con profesionales expertos</p>
            <a href="index.php?url=auth/register" class="btn btn-primary btn-lg">Agendar Cita</a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Nuestros Servicios</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-cut fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Corte Clásico</h5>
                            <p class="card-text">Corte tradicional con técnicas profesionales</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-user-tie fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Arreglo de Barba</h5>
                            <p class="card-text">Perfilado y cuidado profesional de barba</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-spa fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Tratamientos</h5>
                            <p class="card-text">Tratamientos especiales para el cabello</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
