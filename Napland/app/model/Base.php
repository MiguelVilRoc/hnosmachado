<?php
if(!isset($ajaxCall)) {
    include_once "app/model/Config.php";
} else {
    include_once "../../app/model/Config.php";
    unset($ajaxCall);
}

class Base {
    
    public static function conectar() {
        $conexion=mysqli_connect(Config::BD_HOST,Config::BD_USER,Config::PASSWORD,Config::BD_NAME);
        if ($conexion->connect_errno) {
            echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
        }
        else {
        mysqli_set_charset($conexion,"utf8");
        return $conexion;
        }
    }

    public static function comprobarUsuario($email,$password) {
        $mysqli = self::conectar();
        if (!($sentencia = $mysqli->prepare("SELECT * FROM `USUARIOS` WHERE `email` = ? AND `password` = ?"))) {
            echo "<br>Error BD: Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
        } else if (!$sentencia->bind_param("ss", $email, $password)) {
            echo "<br>Error BD: Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
        } else if (!$sentencia->execute()) {
            echo "<br>Error BD: Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
        } else {
            $resultado = $sentencia->get_result();
            $fila = $resultado->fetch_assoc();
            return $fila;            
        }


        $mysqli->close();
    }

    public static function listadoUsuarios($filtros) {
        $mysqli = self::conectar();
        extract($filtros);
        unset($filtros["filtroAdministrador"]); //Hago unset de este, que no necesita entrar en la consulta preparada, para que no cuente 
        $tiposParametro = "";

        $sentencia = "SELECT * FROM USUARIOS";
        $where = " WHERE 1";
        $parametros = array();
        $orderBy = " ORDER BY administrador DESC, email"; //Los ordeno de forma que aparezcan los administradores al principio y después por email


        //FILTROS:
        //$filtroNombre
        //$filtroApellidos
        //$filtroDireccion
        //$filtroEmail
        //$filtroAdministrador
        if(isset($filtroNombre)) {
            $where .= " AND nombre LIKE ?";
            $tiposParametro.="s";
            $filtroNombre = "%".$filtroNombre."%";
            $parametros[] = &$filtroNombre;             //paso los parámetros por referencia (&) para el bind_param (si no lo hago así dará error).
        }

        if(isset($filtroApellidos)) {
            $where .= " AND apellidos LIKE ?";
            $tiposParametro.="s";
            $filtroApellidos = "%".$filtroApellidos."%";
            $parametros[] = &$filtroApellidos;             
        }

        if(isset($filtroDireccion)) {
            $where .= " AND direccion LIKE ?";
            $tiposParametro.="s";
            $filtroDireccion = "%".$filtroDireccion."%";
            $parametros[] = &$filtroDireccion;             
        }

        if(isset($filtroEmail)) {
            $where .= " AND email LIKE ?";
            $tiposParametro.="s";
            $filtroEmail = "%".$filtroEmail."%";
            $parametros[] = &$filtroEmail;             
        }

        if(isset($filtroAdministrador) && !$filtroAdministrador) {                          
            $where .= " AND administrador IS NOT true";           
        }

        $sentencia = $sentencia.$where.$orderBy;
        $resultado = array();
    
        if(empty($filtros)) {                               //Si no hay filtros, no se aplican las consultas preparadas, ya que call_user_func_array daría error
            if(!$consulta = $mysqli->query($sentencia)) {
                echo "<br>Error BD: Falló la consulta: (" . $mysqli->errno . ") " . $mysqli->error;
            } else {
                
                $resultadoBD = $consulta;
            }
        } else {
    
        array_unshift($parametros,$tiposParametro);  //añado al principio del array los tipos de parámetro para el bind_param
    
        $sentenciaPreparada = $mysqli->prepare($sentencia);
    
        call_user_func_array(array($sentenciaPreparada, 'bind_param'), $parametros); //utilizo call_user_func_array para llamar a bind_param pasándole el array de parámetros.
        $sentenciaPreparada->execute();
        $resultadoBD = $sentenciaPreparada->get_result();
    
        }
    
    
       while($fila = $resultadoBD->fetch_assoc()) {
        $resultado[] = $fila;
       }
       
       //$sentenciaPreparada->close();
       $mysqli->close();
      
       return $resultado;

    }


//El siguiente método devuelve un array con datos para crear objetos de la clase producto. Se ha aplicado las consultas preparadas a los filtros.
//La consulta precisa de un número diferente de parámetros dependiendo de los filtros aplicados, por lo que se ha usado la función  call_user_func_array
public static function listadoProductos($filtros) {
    $mysqli = self::conectar();
    extract($filtros);
    $tiposParametro = "";

    $sentencia = "SELECT p.id,p.nombre,p.ancho,p.largo,p.descripcion,p.stock,p.id_categoria,p.precio_unitario,c.nombre as 'nombre_categoria' FROM PRODUCTOS p INNER JOIN CATEGORIAS c ON p.id_categoria = c.id";
    
    $where = " WHERE 1";
    $parametros = array();

        if(isset($filtroCategoria)) {
            $where .= " AND p.id_categoria = ?";
            $tiposParametro.="i";
            $parametros[] = &$filtroCategoria; //paso los parámetros por referencia (&) para el bind_param (si no lo hago así dará error).
        }
        if(isset($filtroNombre)) {
            $where .= " AND p.nombre LIKE ?";
            $tiposParametro.="s";
            $filtroNombre = "%".$filtroNombre."%";
            $parametros[] = &$filtroNombre;
        }
        if(isset($filtroDescripcion)) {
            $where .= " AND p.descripcion LIKE ?";
            $tiposParametro.="s";
            $filtroDescripcion = "%".$filtroDescripcion."%";
            $parametros[] = &$filtroDescripcion;
        }
   
    $sentencia = $sentencia.$where;
    $resultado = array();

    if(empty($filtros)) {                               //Si no hay filtros, no se aplican las consultas preparadas, ya que call_user_func_array daría error
        if(!$consulta = $mysqli->query($sentencia)) {
            echo "<br>Error BD: Falló la consulta: (" . $mysqli->errno . ") " . $mysqli->error;
        } else {
            
            $resultadoBD = $consulta;
        }
    } else {

    array_unshift($parametros,$tiposParametro);  //añado al principio del array los tipos de parámetro para el bind_param

    $sentenciaPreparada = $mysqli->prepare($sentencia);

    call_user_func_array(array($sentenciaPreparada, 'bind_param'), $parametros); //utilizo call_user_func_array para llamar a bind_param pasándole el array de parámetros.
    $sentenciaPreparada->execute();
    $resultadoBD = $sentenciaPreparada->get_result();

    }


   while($fila = $resultadoBD->fetch_assoc()) {
    $resultado[] = $fila;
   }
   
   //$sentenciaPreparada->close();
   $mysqli->close();
  
   return $resultado;
}


    public static function listadoCategorias() {
        $mysqli = self::conectar();
        $sentencia = "SELECT id,nombre FROM `CATEGORIAS` ORDER BY 'nombre'";

        $consulta = $mysqli->query($sentencia);
        $resultado = array();
     
        while($fila = $consulta->fetch_assoc()) {
            extract($fila);
            $resultado[$id] = $nombre;
        }

   
        $mysqli->close();
        return $resultado;
    }

    public static function listadoCategoriasDetalle() {
        $mysqli = self::conectar();
        $sentencia = "SELECT * FROM `CATEGORIAS` ORDER BY 'nombre'";

        $consulta = $mysqli->query($sentencia);
        $resultado = array();
     
        while($fila = $consulta->fetch_assoc()) {
            $resultado[] = $fila;
        }

        $mysqli->close();
        return $resultado;
    }

    public static function editarCategoria($datos) {
        $mysqli = self::conectar();
        extract($datos);
        $id = trim($id);
        $nombre = trim($nombre);
        $descripcion = trim($descripcion);

        $resultado = false;
        if($id == -1) {
            $sentencia = "INSERT INTO CATEGORIAS (nombre, descripcion) VALUES (?, ?)";
            $sentenciaPreparada = $mysqli->prepare($sentencia);
            $sentenciaPreparada->bind_param('ss',$nombre,$descripcion);
            if($sentenciaPreparada->execute()) {
                $resultado = true;
            }
        } elseif($id > -1){
            $sentencia = "UPDATE CATEGORIAS SET nombre = ?, descripcion = ? WHERE id = ?";
            $sentenciaPreparada = $mysqli->prepare($sentencia);
            $sentenciaPreparada->bind_param('ssi',$nombre,$descripcion,$id);
            if($sentenciaPreparada->execute()) {
                $resultado = true;
            }
        }
        $mysqli->close();
        return $resultado;
    }

    public static function borrarCategoria($id) {
        $mysqli = self::conectar();
        $resultado = false;
        $sentencia = "DELETE FROM CATEGORIAS WHERE id=?";
        $sentenciaPreparada = $mysqli->prepare($sentencia);
        $sentenciaPreparada->bind_param("i",$id);
        if($sentenciaPreparada->execute()) {
            $resultado = true;
        }
        $mysqli->close();
        return $resultado;
    }

    public static function getNombreCategoria($id) {
        $mysqli = self::conectar();
        $sentencia = "SELECT nombre FROM `CATEGORIAS` WHERE id = $id";
        $consulta = $mysqli->query($sentencia);
        $fila = $consulta->fetch_assoc();
        return $fila["nombre"];
    }


    public static function actualizarUsuario($datos) {
        extract($datos);
        $mysqli = self::conectar();
        
        if($id == "-1") {
            $sentencia = "INSERT INTO `USUARIOS` (`dni`, `nombre`, `apellidos`, `direccion`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?)";
            $sentenciaPreparada = $mysqli->prepare($sentencia);
            $sentenciaPreparada->bind_param('ssssss', $dni,$nombre,$apellidos,$direccion,$email,$password);
            $sentenciaPreparada->execute();    
        } else {
            $sentencia = "UPDATE `USUARIOS` SET `dni` = ?, `nombre` = ?, `apellidos` = ?, `direccion` = ?, `email` = ?, `password` = ? WHERE `USUARIOS`.`id` = ?";
            $sentenciaPreparada = $mysqli->prepare($sentencia);
            $sentenciaPreparada->bind_param('ssssssi',$dni,$nombre,$apellidos,$direccion,$email,$password,$id);
            $sentenciaPreparada->execute();
        }
        $resultado = $mysqli->errno;
        $mysqli->close();
        return $resultado;
    }

    public static function actualizarProducto($datos) {
        extract($datos);
        $mysqli = self::conectar();
    
        $resultado = array();
        $idProductoModificado;
        $errorno; 
        if($id == "-1") {
            $sentencia = "INSERT INTO `PRODUCTOS` (`nombre`, `ancho`, `largo`, `descripcion`, `stock`, `id_categoria`, `precio_unitario`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $sentenciaPreparada = $mysqli->prepare($sentencia);
            $sentenciaPreparada->bind_param('siisiid',$nombre,$ancho,$largo,$descripcion,$stock,$id_categoria,$precio_unitario);
            $sentenciaPreparada->execute();
            $errorno = $mysqli->errno;

            //recogemos la ID del objeto recién creado
            $sentencia = "SELECT `id` FROM `PRODUCTOS` WHERE `id` = LAST_INSERT_ID()";
            $respuestaDB = $mysqli->query($sentencia);
            $fila = $respuestaDB->fetch_assoc();
            $idProductoModificado = $fila["id"];

        } else {
            $sentencia = "UPDATE `PRODUCTOS` SET `nombre` = ?, `ancho` = ?, `largo` = ?, `descripcion` = ?, `stock` = ?, `id_categoria` = ?, `precio_unitario` = ? WHERE `PRODUCTOS`.`id` = ?";
            $sentenciaPreparada = $mysqli->prepare($sentencia);
            $sentenciaPreparada->bind_param('siisiidi',$nombre,$ancho,$largo,$descripcion,$stock,$id_categoria,$precio_unitario,$id);
            $sentenciaPreparada->execute();
            $errorno = $mysqli->errno;
            $idProductoModificado = $id;  
        }
        
        
        $resultado["errorno"] = $errorno;
        $resultado["idProducto"] = $idProductoModificado;

        $mysqli->close();
        return $resultado;

    }

    public static function existeUsuario($email,$dni) {
        $existe=false;
        $mysqli = self::conectar();
        $sentencia = "SELECT * FROM `USUARIOS` WHERE email = ? OR dni = ?";
        $sentenciaPreparada = $mysqli->prepare($sentencia);
        $sentenciaPreparada->bind_param('ss',$email,$dni);
        $sentenciaPreparada->execute();   
        $resultado = $sentenciaPreparada->get_result();
        if($resultado->fetch_array()) {
            $existe = true;
        }
        $mysqli->close();
        return $existe;   
    }

    public static function getFotoProductos($listaIds) {
        $mysqli= self::conectar();
        $ids = implode(",",$listaIds);
        $sentencia = "SELECT * FROM `FOTOS` WHERE id in ($ids)";
        $resultado = array();

        if(!$consulta = $mysqli->query($sentencia)) {
            echo "<br>Error BD: Falló la consulta de imágenes: (" . $mysqli->errno . ") " . $mysqli->error;
        } else {    
            while($fila = $consulta->fetch_assoc()) {
                //if(in_array($fila["id"],$listaIds)) {
                    $resultado[$fila["id"]] = "data:image/jpg;charset=utf8;base64,". base64_encode($fila['imagen']);
                //} else {
                //    $resultado[$fila["id"]] = "Napland\assets\img\image-not-found-icon.png";
                //}
            }
        }
        $mysqli->close();
        return $resultado;
    }

    public static function getFotoProducto($id) {
        $mysqli= self::conectar();
        $sentencia = "SELECT * FROM `FOTOS` WHERE `id` = $id";
        $resultado = 'public/assets/img/image-not-found-icon.png';
        $consulta = $mysqli->query($sentencia);
        if($mysqli->errno == 0) {
            $fila = $consulta->fetch_assoc();
            $resultado = "data:image/jpg;charset=utf8;base64,". base64_encode($fila['imagen']);
        }
        
        $mysqli->close();
        return $resultado;
    }

    public static function getDatosProducto($idProducto) {
        $mysqli = self::conectar();
        $sentencia = "SELECT p.id,p.nombre,p.ancho,p.largo,p.descripcion,p.stock,p.id_categoria,p.precio_unitario,c.nombre as 'nombre_categoria' FROM PRODUCTOS p INNER JOIN CATEGORIAS c ON p.id_categoria = c.id WHERE p.id=?";
        $sentenciaPreparada = $mysqli->prepare($sentencia);
        $sentenciaPreparada->bind_param('i',$idProducto);
        $sentenciaPreparada->execute();
        $resultado = $sentenciaPreparada->get_result();
        $datosProducto = array();
        $datosProducto = $resultado->fetch_array();
        return $datosProducto;
    }

    public static function subirFotoProducto($idProducto, $nuevaImagen) {
        extract($nuevaImagen);
        $mysqli = self::conectar();
        //Preparamos el fichero de imagen
        $f1= fopen($tmp_name,"rb");

        // leemos el fichero completo limitando la lectura al tamaño de fichero		
        $foto_reconvertida = fread($f1, $size);
        // anteponemos \ a las comillas que pudiera contener el fichero
        //para evitar que sean interpretadas como final de cadena	
        $blobImage=$foto_reconvertida;

        //Primero comprobamos si el producto ya tiene una imagen asociada en la base de datos para saber si hacer update o insert
        $sentencia = "SELECT * FROM FOTOS WHERE id = ?";
        $sentenciaPreparada = $mysqli->prepare($sentencia);
        $sentenciaPreparada->bind_param('i',$idProducto);
        $sentenciaPreparada->execute();
        $resultado = $sentenciaPreparada->get_result();
        $resultArray = array();
        $resultArray["error"]=false;
        if($resultado->num_rows>0) {
            $sentencia = "UPDATE FOTOS SET imagen=?,nombre=?,tamano=?,formato=? WHERE id=?;";
            $sentenciaPreparada = $mysqli->prepare($sentencia);

            $sentenciaPreparada->bind_param('ssssi',$blobImage,$name,$size,$type,$idProducto);
            if(!$sentenciaPreparada->execute()) {
                $resultArray["error"] = true;
                $resultArray["mensajeError"] = "No se pudo actualizar la fotografía: (".$sentenciaPreparada->errno.") ".$sentenciaPreparada->error;
            }
        } else {
            $sentencia = "INSERT INTO FOTOS (imagen,nombre,tamano,formato,id) VALUES (?,?,?,?,?);";
            $sentenciaPreparada = $mysqli->prepare($sentencia);
            $blobImage = file_get_contents($tmp_name);
            $sentenciaPreparada->bind_param('ssssi',$blobImage,$name,$size,$type,$idProducto);
            if(!$sentenciaPreparada->execute()) {
                $resultArray["error"] = true;
                $resultArray["mensajeError"] = "No se pudo actualizar la fotografía: (".$sentenciaPreparada->errno.") ".$sentenciaPreparada->error;
            }
        }

        $mysqli->close();
        return $resultArray;
    }

    public static function borrarProducto($idProducto) {

        $mysqli = self::conectar();
        $sentencia = "DELETE FROM PRODUCTOS WHERE id=?";
        $sentenciaPreparada = $mysqli->prepare($sentencia);
        $sentenciaPreparada->bind_param('i',$idProducto);
        $resultado = true;
        if(!$sentenciaPreparada->execute()) {
            $resultado = false;
        }
        $mysqli->close();
        
        return $resultado;
    }

    public static function borrarImagenProducto($idProducto) {
        $mysqli = self::conectar();
        $sentencia = "DELETE FROM FOTOS WHERE id=?";
        $sentenciaPreparada = $mysqli->prepare($sentencia);
        $sentenciaPreparada->bind_param('i',$idProducto);
        $resultado = true;
        if(!$sentenciaPreparada->execute()) {
            $resultado = false;
        }
        $mysqli->close();
        
        return $resultado;
    }

    public static function guardarPedido($datos) {

        $resultado = array();
        //Primero creamos un nuevo pedido.
        extract($datos);
        $resultado["todoOk"] = true;
        $mysqli = self::conectar();
        $sentencia = "INSERT INTO PEDIDOS (id_cliente) VALUES (?);";
        $sentenciaPreparada = $mysqli->prepare($sentencia);
        $sentenciaPreparada->bind_param("i",$id_cliente);
        if(!$sentenciaPreparada->execute()) {
            $resultado["todoOk"] = false;
           
        } else { //Aquí insertamos las líneas del pedido

            $id_pedido = $mysqli->insert_id;
            $resultado["id_pedido"] = $id_pedido;
            //Recuperamos la fecha
           $sentencia = "SELECT fecha FROM PEDIDOS WHERE id = $id_pedido;";
           $respuestaFecha = $mysqli->query($sentencia);
           $fila = $respuestaFecha->fetch_array();
           $resultado["fecha"] = $fila[0];

            foreach($lineas as $linea) {
                extract($linea);
                $sentencia = "INSERT INTO LINEAS (id_pedido, num_linea, id_producto, cantidad, precio_unitario) VALUES (?,?,?,?,?);";
                $sentenciaPreparada = $mysqli->prepare($sentencia);
                $sentenciaPreparada->bind_param("iiiid",$id_pedido,$num_linea,$id_producto,$cantidad,$precio_unitario);
                if(!$sentenciaPreparada->execute()) {
                    $resultado["todoOk"] = false;
                }
            }
        }

        $mysqli->close();
        return $resultado;
    
    }

    public static function listadoPedidos($filtros) {
         /*
            LINEAS:
            id	id_pedido	num_linea	id_producto	cantidad	precio_unitario (float)
        */

            /*
        PEDIDOS:
        id (int), id_cliente (int), fecha (datetime)
    */


        $mysqli = self::conectar();
        $arrayResultado = array();
        extract($filtros);
        //Primero recuperamos los pedidos 
        $sentencia = "SELECT * FROM PEDIDOS";
        $where = "WHERE 1";
        $parametros = array();
        $tiposParametro = "";
        $orderBy = " ORDER BY fecha, id_cliente";

        if(isset($filtroId)) {
            $where .= " AND id_cliente = ?";
            $tiposParametro .= "i";
            $parametros[] = &$filtroId; //paso los parámetros por referencia (&) para el bind_param (si no lo hago así dará error).
        }

        if(isset($filtroDesde) && !isset($filtroHasta)) {
            $where .= " AND fecha >= ?";
            $tiposParametro .= "d";
            $parametos[] = &$filtroDesde;
        } else if(!isset($filtroDesde) && isset($filtroHasta)) {
            $where .= " AND fecha <= ?";
            $tiposParametro .= "d";
            $parametos[] = &$filtroHasta;
        } else if(isset($filtroDesde) && isset($filtroHasta)) {
            $where = " AND fecha BETWEEN ? AND ?";
            $tiposParametro .= "dd";
            $parametros[] = $filtroDesde;
            $parametros[] = $filtroHasta;
        }

        $sentencia = $sentencia.$where.$orderBy;

        if(empty($filtros)) {                               //Si no hay filtros, no se aplican las consultas preparadas, ya que call_user_func_array daría error
            if(!$consulta = $mysqli->query($sentencia)) {
                echo "<br>Error BD: Falló la consulta: (" . $mysqli->errno . ") " . $mysqli->error;
            } else {
                
                $resultadoBD = $consulta;
            }
        } else {
    
        array_unshift($parametros,$tiposParametro);  //añado al principio del array los tipos de parámetro para el bind_param
    
             $sentenciaPreparada = $mysqli->prepare($sentencia);
    
        call_user_func_array(array($sentenciaPreparada, 'bind_param'), $parametros); //utilizo call_user_func_array para llamar a bind_param pasándole el array de parámetros.
            $sentenciaPreparada->execute();
            $resultadoBD = $sentenciaPreparada->get_result();
        }

        while($fila = $resultadoBD->fetch_assoc()) {
            extract($fila);
            $arrayDatosPedido = array();
            $arrayDatosPedido["id"] = $id;

            $fecha = date_create($fecha);
            $fecha = date_format($fecha, "d-m-Y H:i:s");
            $arrayDatosPedido["fecha"] = $fecha;

            $sentencia = "SELECT email FROM USUARIOS WHERE id = $id_cliente;";
            $resultadoUsuario = $mysqli->query($sentencia); 
            $email_cliente = $resultadoUsuario->fetch_array()[0];

            $arrayDatosPedido["email_cliente"] = $email_cliente;



            $arrayResultado[] = $arrayDatosPedido;
        }


        $mysqli->close();
        return $arrayResultado;

        /*
        
            $where = " WHERE 1";
    $parametros = array();

        if(isset($filtroCategoria)) {
            $where .= " AND p.id_categoria = ?";
            $tiposParametro.="i";
            $parametros[] = &$filtroCategoria; //paso los parámetros por referencia (&) para el bind_param (si no lo hago así dará error).
        }
        if(isset($filtroNombre)) {
            $where .= " AND p.nombre LIKE ?";
            $tiposParametro.="s";
            $filtroNombre = "%".$filtroNombre."%";
            $parametros[] = &$filtroNombre;
        }
        if(isset($filtroDescripcion)) {
            $where .= " AND p.descripcion LIKE ?";
            $tiposParametro.="s";
            $filtroDescripcion = "%".$filtroDescripcion."%";
            $parametros[] = &$filtroDescripcion;
        }
   
    $sentencia = $sentencia.$where;
    $resultado = array();

    if(empty($filtros)) {                               //Si no hay filtros, no se aplican las consultas preparadas, ya que call_user_func_array daría error
        if(!$consulta = $mysqli->query($sentencia)) {
            echo "<br>Error BD: Falló la consulta: (" . $mysqli->errno . ") " . $mysqli->error;
        } else {
            
            $resultadoBD = $consulta;
        }
    } else {

    array_unshift($parametros,$tiposParametro);  //añado al principio del array los tipos de parámetro para el bind_param

    $sentenciaPreparada = $mysqli->prepare($sentencia);

    call_user_func_array(array($sentenciaPreparada, 'bind_param'), $parametros); //utilizo call_user_func_array para llamar a bind_param pasándole el array de parámetros.
    $sentenciaPreparada->execute();
    $resultadoBD = $sentenciaPreparada->get_result();

    }
        
        */
    }

}

?>