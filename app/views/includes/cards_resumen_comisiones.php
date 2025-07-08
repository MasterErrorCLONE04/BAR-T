<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <h4>
                    $<?= number_format(array_sum(array_column(array_filter($comisiones, fn($c) => $c['estado'] === 'pendiente'), 'monto')), 2) ?>
                </h4>
                <p>Comisiones Pendientes</p>
                <small>Por pagar a barberos</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h4>
                    $<?= number_format(array_sum(array_column(array_filter($comisiones, fn($c) => $c['estado'] === 'pagada'), 'monto')), 2) ?>
                </h4>
                <p>Comisiones Pagadas</p>
                <small>Ya descontadas del saldo</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <h4>$<?= number_format(array_sum(array_column($comisiones, 'monto')), 2) ?></h4>
                <p>Total Comisiones</p>
                <small>Generadas hasta ahora</small>
            </div>
        </div>
    </div>
</div>
