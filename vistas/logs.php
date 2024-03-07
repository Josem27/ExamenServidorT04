<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once 'includes/header.php';?>
    <meta charset="UTF-8">
    <title>Registro de actividades</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>    
    <?php include_once 'includes/menu.php'?>
    <div class="container mt-5">
        <div class="container cuerpo text-center">
            <h2>Registro de actividades</h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Operación</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parametros['datos'] as $datos): ?>
                <tr>
                    <td><?=$datos['usuario']?></td>
                    <td><?=$datos['operacion']?></td>
                    <td><?=$datos['fecha']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="container text-center">
            <a class="btn btn-primary" href="index.php?accion=listado" role="button">Volver</a>
            <hr>
        </div>
    </div>
    <?php include_once 'paginado.php' ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
