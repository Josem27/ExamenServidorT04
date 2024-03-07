<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once '../includes/header.php'; ?>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="container cuerpo text-center">
            <p><h2>Panel de Control<h2></h2></p>
            <hr width="50%" color="black">
        </div>
    </div>

    <div class="card text-center">
        <div class="card-header">
            Utilidades
        </div>
        <div class="card-body">
            <h5 class="card-title">AVISO</h5>
            <p class="card-text">Debe iniciar sesión para poder ver esta página</p>
            <a href="/index.php?accion=login" class="btn btn-primary">Iniciar sesión</a>
        </div>
        <div class="card-footer text-muted">
            Test
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
