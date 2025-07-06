<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Confirmar acciones
    function confirmarAccion(mensaje) {
        return confirm(mensaje || '¿Estás seguro de realizar esta acción?');
    }

    // Auto-hide alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            if (alert.classList.contains('alert-success') || alert.classList.contains('alert-info')) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        });
    }, 5000);

    // Clear form when modal is hidden
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function() {
                const forms = this.querySelectorAll('form');
                forms.forEach(form => {
                    if (!form.id || form.id !== 'deleteForm') {
                        form.reset();
                    }
                });
            });
        });

        // Interceptar botón atrás del navegador
        let hasIntercepted = false;

        window.addEventListener('popstate', function (event) {
            if (!hasIntercepted) {
                event.preventDefault();
                hasIntercepted = true;
                history.pushState(null, '', window.location.href);
                location.reload(); // Refrescar la página en vez de retroceder
            } else {
                history.back(); // Segunda vez sí deja retroceder
            }
        });

        // Agrega una entrada inicial al historial
        history.pushState(null, '', window.location.href);
    });
</script>
</body>
</html>
