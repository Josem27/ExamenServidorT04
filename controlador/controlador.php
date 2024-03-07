<?php
session_start();
require_once 'modelo/modelo.php';

class controlador{

    private $modelo;
    private $mensajes;

    public function __construct(){
        $this->modelo = new modelo();
        $this->mensajes = [];
    }

    public function index(){
        $parametros = [
            "titulo" => "MVC"
        ];

        include_once 'vistas/login.php';
    }

    public function login(){
        $parametros = [
            "datos" => null,
            "mensaje" => null,
            "titulo" => "login"
        ];
        if(isset($_POST['submit'])){
            $usuario = $_POST['txtusuario'];
            $pass = $_POST['pass'];
            
            $resultModelo = $this->modelo->comprobarUser();
            if($resultModelo['bool']){
                $parametros["datos"] = $resultModelo["datos"];
                foreach($parametros["datos"] as $param){
                    if($param["nick"] == $usuario && $param["password"]==$pass){
                        
                        $_SESSION['logueado'] = 1;
                        $_SESSION['nick'] = $usuario;
                        $_SESSION['user_id'] = $param['id'];
                        if($param["tipo"]==1){
                            $_SESSION['esAdmin'] = true;
                        }else{                            
                            $_SESSION['esAdmin'] = false;
                        }
                        header("Location: /index.php?accion=listado");
                    }
                }
            }
        }

        include_once 'vistas/login.php';

    }

    //Terminar listado y en vistas
    public function listado(){
        $parametros = [
            "titulo" => "Listado",
            "datos" => null,
            "mensaje" => null
        ];
    
        $resultModelo = $this->modelo->listado();
        if($resultModelo['bool']){
            $parametros["datos"] = $resultModelo["datos"];
            if(isset($_SESSION['logueado'])){
                include_once 'vistas/listado.php';
            }else{
                header("Location: /index.php");
            }
        }        
    }
    
    public function nuevaEntrada(){
        $parametros=[
            "titulo" => "Nueva Entrada"
        ];
        if(isset($_SESSION['logueado'])){
            $errores = array();
            $imagen = null;
            if(isset($_POST['submit']) && !empty($_POST)){
                if(isset($_FILES["imagen"]) && (!empty($_FILES["imagen"]["tmp_name"]))){
                    if(!is_dir("fotos")){
                        $dir = mkdir("fotos", 0777, true);
                    }else{
                        $dir = true;
                    }
    
                    if($dir){
                        $nombreFichImg = time() . "-" . $_FILES["imagen"]["name"];
                        $movFichImg = move_uploaded_file($_FILES["imagen"]["tmp_name"], "fotos/" . $nombreFichImg);
                        $imagen = $nombreFichImg;
                        if(!$movFichImg){
                            $errores["imagen"] = "Error, imagen no cargada";
                        }
                    }
                }
    
                if(count($errores) == 0){
                    $resultModelo = $this->modelo->nuevaEntrada([
                        "titulo" => $_POST['titulo'],
                        "descripcion" => $_POST['descripcion'],
                        "usuario_id" => $_SESSION['user_id'],
                        "categoria_id" => $_POST['categoria'],
                        "imagen" => $imagen,
                        "fecha" => date("d/m/Y"),
                        "prioridad" => $_POST['prioridad']
                    ]);
                    
                    $resultModelo = $this->modelo->registrarLog([
                        "usuario" => $_SESSION['nick'],
                        "operacion" => "Entrada" 
                    ]);                
                }
                header("Location: index.php?accion=listado");
            }else{
                $resultModelo = $this->modelo->idCat();
                $idCat['datos'] = $resultModelo['datos'];
                include_once 'vistas/nuevaEntrada.php';
            }
        }else{
            header("Location: index.php");
        }
    }
    

    public function logout(){
        if(isset($_SESSION['logeado'])){
            session_destroy();            
        }
        header("Location: index.php");
    }


    public function entrada(){
        $parametros = [
            "titulo" => "Logs",
            "datos" => null,
            "mensaje" => null
        ];
        if(isset($_SESSION['logueado'])){
            $datos = $_GET['id'];
            $resultModelo = $this->modelo->entrada($datos);
            if($resultModelo['bool']){
                $parametros['datos'] = $resultModelo['datos'];
                include_once 'vistas/verEntrada.php';
            }
        }
    }
    

    public function eliminar(){
        $id_entrada = $_GET['id'];
        $resultModelo = $this->modelo->delEntrada($id_entrada);
        $resultModelo = $this->modelo->registrarLog([
            "usuario" => $_SESSION['nick'],
            "operacion" => "Eliminar" 
        ]); 
    
        // Recargar los datos del listado después de eliminar la entrada
        $this->listado();
    }
    

    public function editar(){
        $parametros = [
            "titulo" => "Logs",
            "datos" => null,
            "mensaje" => null
        ];
        $errores = array();
        $imagen = null;
        
        if(isset($_POST['submit']) && !empty($_POST)){
            // Verificar si se envió un archivo de imagen
            if(isset($_FILES["imagen"]) && !empty($_FILES["imagen"]["tmp_name"])){
                if(!is_dir("fotos")){
                    $dir = mkdir("fotos",0777,true);
                }else{
                    $dir = true;
                }
    
                if($dir){
                    $nombreFichImg = time() . "-" . $_FILES["imagen"]["name"];
                    $movFichImg = move_uploaded_file($_FILES["imagen"]["tmp_name"], "fotos/" . $nombreFichImg);
                    $imagen = $nombreFichImg;
                    if(!$movFichImg){
                        $errores["imagen"]= "Error, imagen no cargada";
                    }
                }
            } else {
                // Si no se envió una nueva imagen, mantener la imagen actual
                $imagen = $_POST['imagen_actual'];
            }
    
            if(count($errores)==0){
                $resultModelo = $this->modelo->editar([
                    "titulo" => $_POST['titulo'],
                    "descripcion" => $_POST['descripcion'],
                    "categoria_id" => $_POST['categoria'],
                    "imagen" => $imagen,
                    "id" => $_GET['id'],
                    "prioridad" => $_POST['prioridad'] 
                ]);
                
                $resultModelo = $this->modelo->registrarLog([
                    "usuario" => $_SESSION['nick'],
                    "operacion" => "Edicion" 
                ]);   
                
                // Verificar si la edición fue exitosa
                if($resultModelo['bool']){
                    // Redirigir solo si la edición fue exitosa
                    header("Location: index.php?accion=listado");
                    exit(); // Terminar el script después de la redirección
                } else {
                    // Si hay errores, establecer un mensaje de error y cargar la vista de edición nuevamente
                    $parametros['mensaje'] = "Error al editar la entrada. Por favor, inténtalo de nuevo.";
                }         
            }
        }
    
        if(isset($_SESSION['logueado'])){
            $datos = $_GET['id'];
            $resultModelo = $this->modelo->entrada($datos);
            if($resultModelo['bool']){
                $parametros['datos']=$resultModelo['datos'];
                $resultModelo2 = $this->modelo->idCat();
                $idCat['datos'] = $resultModelo2['datos'];
                include_once 'vistas/editarEntrada.php';
            }
        }
    }
      

    public function generarPDF() {
        // Obtener todo el listado de entradas
        $resultModelo = $this->modelo->listado();
        $entradas = $resultModelo['datos'];
    
        // Incluir los archivos de TCPDF localmente
        require_once 'tcpdf/tcpdf.php';
    
        // Crear una instancia de TCPDF
        $pdf = new TCPDF();
    
        // Establecer la ubicación de las fuentes de TCPDF
        $fontPath = 'ruta/a/la/carpeta/fonts/';
        TCPDF_FONTS::addTTFfont($fontPath . 'arial.ttf', 'TrueTypeUnicode', '', 32);
    
        // Agregar contenido al PDF (ajusta según tus necesidades)
        $pdf->AddPage();
        $pdf->SetFont('times', 'B', 16);
    
        foreach ($entradas as $entrada) {
            $pdf->Cell(0, 10, 'Detalles de Entrada', 0, 1, 'C');
            $pdf->Cell(0, 10, 'Título: ' . $entrada['titulo'], 0, 1);
            $pdf->Cell(0, 10, 'Descripción: ' . $entrada['descripcion'], 0, 1);
            $pdf->Cell(0, 10, 'Autor: ' . $entrada['nick'], 0, 1); // Cambia 'nombre' por el nombre correcto de la columna que almacena el nombre del autor
            $pdf->Cell(0, 10, 'Categoría: ' . $entrada['categoria_id'], 0, 1); // Cambia 'nombre_categoria' por el nombre correcto de la columna que almacena el nombre de la categoría
            $pdf->Cell(0, 10, 'Fecha de Creación: ' . $entrada['fecha'], 0, 1);
    
            // Agregar la imagen al PDF
            if ($entrada['imagen'] != null) {
                $imagePath = 'fotos/' . $entrada['imagen']; // Ajusta la ruta de la imagen según sea necesario
                $pdf->Image($imagePath, 10, 40, 90, 0, '', '', '', false, 300, '', false, false, 0);
            }
    
            // Agregar un salto de página después de cada entrada
            $pdf->AddPage();
        }
    
        // Salida del PDF
        $pdf->Output('Listado_de_Entradas.pdf', 'I');
        exit();
    }
    
    
}    

?>