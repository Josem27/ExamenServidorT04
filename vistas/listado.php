<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once 'includes/header.php';?>
    <meta charset="UTF-8">
    <title>Contenido</title>
</head>
<body>    
    <?php include_once 'includes/menu.php'?>
    <!-- Formulario HTML para buscar tareas -->
<form action="index.php" method="get">
    <div class="form-group">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por título">
    </div>
    <button type="submit" class="btn btn-primary">Buscar</button>
    <!-- No le eches cuenta a esto, que lo fui a hacer y al final lo descarté -->
</form>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Nick</th>
                    <th>Prioridad</th> <!-- Add this -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parametros['datos'] as $datos): ?>
                    <tr>
                        <td><?= $datos['nombre'] ?></td>
                        <td><?= $datos['titulo'] ?></td>
                        <td><?= substr($datos['descripcion'], 0, 45) . (strlen($datos['descripcion']) > 45 ? '...' : '') ?></td>
                        <td><?= $datos['fecha'] ?></td>
                        <td><?= $datos['nick'] ?></td>
                        <td><?= $datos['prioridad'] ?></td> <!-- Add this -->
                        <td>
                            <?php if ($_SESSION['esAdmin']): ?>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-primary" href="index.php?accion=editar&id=<?= $datos['id'] ?>" role="button">Editar</a>
                                    <a class="btn btn-info" href="index.php?accion=entrada&id=<?= $datos['id'] ?>" role="button">Detalles</a>
                                    <a class="btn btn-danger" href="index.php?accion=eliminar&id=<?= $datos['id'] ?>" role="button">Eliminar</a>
                                </div>
                            <?php else: ?>
                                <a href="index.php?accion=entrada&id=<?= $datos['id'] ?>" class="btn btn-info">Detalles</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include_once 'paginado.php' ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
