<?php
class modelo
{
    private $conexion;
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "dbblog";

    //Constructor que inicializa la conexion
    public function __construct()
    {
        $this->conectar();
    }

    //Funcion para conectar la base de datos
    public function conectar()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return TRUE;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function listado()
    {
        $result = [
            "datos" => null,
            "mensaje" => null,
            "bool" => false
        ];

        $page = 0;
        $longitudPag = 3;

        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = $_GET['page'];
        }
        $offset = $page * $longitudPag;

        try {
            $sql = "SELECT tareas.*, usuarios.*, categorias.*, tareas.prioridad 
                    FROM (tareas 
                    LEFT JOIN usuarios ON usuarios.id = tareas.usuario_id) 
                    LEFT JOIN categorias ON categorias.id = tareas.categoria_id 
                    LIMIT $longitudPag OFFSET $offset";

            $resultquery = $this->conexion->query($sql);

            if ($resultquery) {
                $result['bool'] = true;
                $result['datos'] = $resultquery->fetchAll(PDO::FETCH_ASSOC);
            }

            $listCount = $this->conexion->query("SELECT COUNT(*) FROM tareas")->fetch()[0];

            if ($page > ($listCount / $longitudPag)) {
                $page = 0;
            }

            $result['paginas'] = $listCount;
            $result['offset'] = $offset;
            $result['longitudPag'] = $longitudPag;
        } catch (PDOException $e) {
            $result['mensaje'] = $e->getMessage();
        }

        return $result;
    }

    public function comprobarUser()
    {
        $result = [
            "datos" => null,
            "mensaje" => null,
            "bool" => false
        ];

        try {
            $sql = "SELECT * FROM usuarios";
            $resultquery = $this->conexion->query($sql);
            if ($resultquery) {
                $result['bool'] = true;
                $result['datos'] = $resultquery->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            $result['mensaje'] = $e->getMessage();
        }
        return $result;
    }

    public function nuevaEntrada($datos)
    {
        $result = [
            "bool" => false,
            "error" => null
        ];

        try {
            $sql = "INSERT INTO tareas(usuario_id, categoria_id, titulo, imagen, descripcion, fecha, prioridad) 
                    VALUES (:usuario_id, :categoria_id, :titulo, :imagen, :descripcion, :fecha, :prioridad)";

            $query = $this->conexion->prepare($sql);

            $query->execute([
                'usuario_id' => $datos['usuario_id'],
                'categoria_id' => $datos['categoria_id'],
                'titulo' => $datos['titulo'],
                'imagen' => $datos['imagen'],
                'descripcion' => $datos['descripcion'],
                'fecha' => $datos['fecha'],
                'prioridad' => $datos['prioridad']
            ]);

            if ($query) {
                $result['bool'] = true;
            }
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
        }

        return $result;
    }

    public function idCat()
    {
        $result = [
            "datos" => null,
            "mensaje" => null,
            "bool" => false,
        ];

        try {
            $sql = "SELECT * FROM categorias";
            $resultquery = $this->conexion->query($sql);
            if ($resultquery) {
                $result['bool'] = true;
                $result['datos'] = $resultquery->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            $result['mensaje'] = $e->getMessage();
        }
        return $result;
    }

    public function registrarLog($datos)
    {
        $result = [
            'bool' => false,
            'error' => null
        ];
        try {
            $sql = "INSERT INTO logs(usuario,operacion) VALUES(:usuario,:operacion)";
            $query = $this->conexion->prepare($sql);
            $query->execute([
                'usuario' => $datos['usuario'],
                'operacion' => $datos['operacion']
            ]);
            if ($query) {
                $result['bool'] = true;
            }
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    public function entrada($datos)
    {
        $result = [
            'datos' => null,
            'mensaje' => null,
            'bool' => false
        ];

        try {
            $sql = "SELECT *, tareas.prioridad AS prioridad FROM (tareas LEFT JOIN usuarios ON usuarios.id=tareas.usuario_id) LEFT JOIN categorias ON categorias.id=tareas.categoria_id WHERE tareas.id = $datos";
            $resultquery = $this->conexion->query($sql);
            if ($resultquery) {
                $result['bool'] = true;
                $result['datos'] = $resultquery->fetchall(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            $result['mensaje'] = $e->getMessage();
        }
        return $result;
    }

    public function delEntrada($datos)
    {
        $result = [
            'bool' => false,
            'error' => null
        ];
        try {
            $sql = "DELETE FROM tareas WHERE id = $datos";
            $resultquery = $this->conexion->query($sql);
            if ($resultquery) {
                $result['bool'] = true;
            }
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    public function editar($datos)
    {
        $result = [
            "bool" => false,
            "error" => null
        ];
        try {
            $sql = "UPDATE tareas SET categoria_id= :categoria_id, titulo= :titulo, imagen= :imagen, descripcion= :descripcion, prioridad= :prioridad WHERE id= :id";

            $query = $this->conexion->prepare($sql);

            $query->execute([
                'categoria_id' => $datos['categoria_id'],
                'titulo' => $datos['titulo'],
                'imagen' => $datos['imagen'],
                'descripcion' => $datos['descripcion'],
                'prioridad' => $datos['prioridad'],
                'id' => $datos['id']
            ]);

            if ($query) {
                $result['bool'] = true;
            }
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
        }
        return $result;
    }
}
