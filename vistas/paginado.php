<div class="container text-center">
    <!-- Paginación -->
    <nav aria-label="...">
        <ul class="pagination">
            <?php 
            $page = isset($_GET['page']) ? $_GET['page'] : 0;
            
            if ($page > 0) { // Si la página es mayor que 0, muestra el botón "Anterior"
            ?>
            <li class="page-item">
                <a class="page-link" href="index.php?accion=listado&page=<?= $page - 1 ?>">Anterior</a>
            </li>
            <?php
            }
            
            // Muestra la página actual
            ?>
            <li class="page-item active">
                <span class="page-link"><?= $page + 1 ?></span>
            </li>
            <?php
            
            // Muestra el botón para ir a la siguiente página
            if ($resultModelo['paginas'] > ($page + 1)) {
            ?>
            <li class="page-item">
                <a class="page-link" href="index.php?accion=listado&page=<?= $page + 1 ?>">Siguiente</a>
            </li>
            <?php
            }
            ?>
            <!-- Campo de texto para ir a una página específica -->
            <li class="page-item">
                <form class="form-inline" action="index.php" method="GET">
                    <input type="hidden" name="accion" value="listado">
                    <input type="number" class="form-control mx-1" name="page" placeholder="Ir a página...">
                    <button type="submit" class="btn btn-primary">Ir</button>
                </form>
            </li>
        </ul>
    </nav>
</div>
