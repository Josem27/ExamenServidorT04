<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once 'includes/header.php'; ?>
    <meta charset="UTF-8">
    <title>Detalles de la entrada</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
        }

        .cuerpo {
            margin-bottom: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .label-resaltado {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <?php if(isset($parametros['datos']) && is_array($parametros['datos'])): ?>
            <?php foreach ($parametros['datos'] as $datos): ?>
                <div class="container cuerpo text-center">
                    <h2>Entrada de: <?= $datos['nick']; ?></h2>
                    <hr class="mt-3">
                </div>
                <div class="container cuerpo text-center">
                    <a class="btn btn-primary" href="index.php?accion=listado" role="button">Volver</a>
                    <hr>
                </div>
                <div class="container text-center">
                    <div class="form-group">
                        <label for="titulo" class="form-label label-resaltado">Título:</label>
                        <p><?= $datos['titulo'] ?></p>
                    </div>

                    <div class="form-group">
                        <label for="imagen" class="label-resaltado">Imagen:</label><br>
                        <img src="fotos/<?= $datos['imagen']; ?>" alt="Imagen de la entrada">
                    </div>

                    <div class="form-group">
                        <label for="categoria" class="label-resaltado">Categoría:</label><br>
                        <p><?= $datos['nombre'] ?></p>
                    </div>

                    <div class="form-group">
                        <label for="prioridad" class="label-resaltado">Prioridad:</label><br>
                        <p><?= $datos['prioridad'] ?></p>
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="label-resaltado">Descripción:</label><br>
                        <p><?= $datos['descripcion'] ?></p>
                    </div>

                    <?php if(isset($_GET['borrar'])): ?>
                        <a class="btn btn-danger" href="index.php?accion=eliminar&id=<?= $datos['id'] ?>" role="button">Eliminar</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron datos de la entrada.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
