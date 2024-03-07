<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once 'includes/header.php'; ?>
    <meta charset="UTF-8">
    <title>Nueva entrada</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="container cuerpo text-center">
            <h2>Nueva entrada</h2>
            <hr width="50%" color="black">
        </div>
        <div class="container cuerpo text-center">
            <a class="btn btn-primary" href="index.php?accion=listado" role="button">Volver</a>
            <hr width="50%" color="black">
        </div>
    </div>

    <div class="container text-center">
        <form action="/index.php?accion=nuevaEntrada" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" id="titulo">
            </div>

            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select name="categoria" class="form-control" id="categoria">
                    <?php foreach ($idCat['datos'] as $key) {
                        echo "<option value=".$key['id'].">".$key['nombre']."</option>";
                    }?>
                </select>
            </div>

            <div class="form-group">
                <label for="prioridad">Prioridad</label>
                <input type="number" class="form-control" name="prioridad" id="prioridad" min="1" max="10" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="ckeditor form-control" id="descripcion" name="descripcion" required></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Registrar entrada</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
