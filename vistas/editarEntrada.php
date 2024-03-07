<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once 'includes/header.php'; ?>
    <meta charset="UTF-8">
    <title>Editando entrada</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="container cuerpo text-center">
            <p>
                <h2>Editando entrada</h2>
            </p>
            <hr width="50%" color="black">
        </div>
        <div class="container cuerpo text-center">
            <a class="btn btn-primary" href="index.php?accion=listado" role="button">Volver</a>
            <hr width="50%" color="black">
        </div>
    </div>

    <div class="container text-center">
        <?php foreach ($parametros['datos'] as $datos): ?>
        <form action="/index.php?accion=editar&id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="<?=$datos['titulo'] ?>">
            </div>

            <input type="hidden" name="imagen_actual" value="<?= $datos['imagen'] ?>">

            <div class="form-group">
                <label for="imagen">Imagen</label><br>
                <img src="fotos/<?=$datos['imagen'];?>" width="260"><br>
                <input type="file" name="imagen" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" class="form-control" id="categoria" name="categoria">
                    <?php foreach ($idCat['datos'] as $key) {
                        echo "<option value=".$key['id'].">".$key['nombre']."</option>";
                    }?>
                </select>
            </div>

            <div class="form-group">
                <label for="prioridad">Prioridad</label>
                <input type="number" class="form-control" name="prioridad" id="prioridad" value="<?=$datos['prioridad'] ?>">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="ckeditor form-control" id="descripcion" name="descripcion" required><?=$datos['descripcion']?></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Editar entrada</button>
        </form>
    </div>
    <?php endforeach; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
