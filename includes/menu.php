<div class="container cuerpo text-center">
    <p><h2>Panel <?= $_SESSION['nick'] ?><h2></h2></p>
        <hr width="50%" color="black">
</div>
<div class="container cuerpo text-center">
    <a class="btn btn-success" href="index.php?accion=nuevaEntrada" role="button">Añadir entrada</a>
    <a class="btn btn-primary" href="index.php?accion=generarPDF" role="button">Imprimir PDF</a>
    
    <a class="btn btn-danger" href="index.php?accion=logout" role="button">Cerrar Sesion</a>
    <hr width="50%" color="black">
</div>
