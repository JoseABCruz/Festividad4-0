<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear y Buscar Artículos</title>
</head>
<body>
    
<?php
include 'db.php'; // Incluir el archivo de conexión a la base de datos
$conexion = conexion(); // Establecer la conexión a la base de datos

// Operaciones CRUD

// Create
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertar'])) {
    $idarticulo = $_POST['idarticulo'];
    $idcategoria = $_POST['idcategoria'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precioventa = $_POST['precio_venta'];
    $existencia = $_POST['existencia'];
    $descripcion = $_POST['descripcion'];
    $idimagen = $_POST['id_imagen'];
    $idproveedor = $_POST['idprovedor'];
    
    $sql = "INSERT INTO `articulo` (`idarticulo`, `idcategoria`, `codigo`, `nombre`, `precio_venta`, `existencia`, `descripcion`, `id_imagen`, `idprovedor`) VALUES ($idarticulo, $idcategoria, '$codigo', '$nombre', $precioventa, $existencia, '$descripcion', $idimagen, $idproveedor)";
    
    if ($conexion->query($sql) === TRUE) {
        echo "Nuevo registro creado con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

// Read
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $idarticulo = $_POST['idarticulo'];
    $idcategoria = $_POST['idcategoria'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precio_venta = $_POST['precio_venta'];
    $existencia = $_POST['existencia'];
    $descripcion = $_POST['descripcion'];
    $id_imagen = $_POST['id_imagen'];
    $idprovedor = $_POST['idprovedor'];
    
    // Construir la consulta SQL
    $sql = "SELECT * FROM articulo WHERE ";
    $conditions = array();
    if (!empty($idarticulo)) $conditions[] = "idarticulo = '$idarticulo'";
    if (!empty($idcategoria)) $conditions[] = "idcategoria = '$idcategoria'";
    if (!empty($codigo)) $conditions[] = "codigo = '$codigo'";
    if (!empty($nombre)) $conditions[] = "nombre = '$nombre'";
    if (!empty($precio_venta)) $conditions[] = "precio_venta = '$precio_venta'";
    if (!empty($existencia)) $conditions[] = "existencia = '$existencia'";
    if (!empty($descripcion)) $conditions[] = "descripcion = '$descripcion'";
    if (!empty($id_imagen)) $conditions[] = "id_imagen = '$id_imagen'";
    if (!empty($idprovedor)) $conditions[] = "idprovedor = '$idprovedor'";
    
    $sql .= implode(" AND ", $conditions);

    // Ejecutar la consulta
    $result = $conexion->query($sql);

    // Mostrar los resultados
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID Artículo: " . $row["idarticulo"]. "<br>";
            echo "ID Categoría: " . $row["idcategoria"]. "<br>";
            echo "Código: " . $row["codigo"]. "<br>";
            echo "Nombre: " . $row["nombre"]. "<br>";
            echo "Precio de Venta: $" . $row["precio_venta"]. "<br>";
            echo "Existencia: " . $row["existencia"]. "<br>";
            echo "Descripción: " . $row["descripcion"]. "<br>";
            echo "ID Imagen: " . $row["id_imagen"]. "<br>";
            echo "ID Proveedor: " . $row["idprovedor"]. "<br><br>";
        }
    } else {
        echo "No se encontraron resultados.";
    }
}

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    $idarticulo = $_POST['idarticulo'];
    $idcategoria = $_POST['idcategoria'];
    $codigo = $_POST['codigo'];
    $idimagen = $_POST['id_imagen'];
    $idprovedor = $_POST['idprovedor'];
    
    // Datos para actualizar
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nuevo_precio_venta = $_POST['nuevo_precio_venta'];
    $nueva_existencia = $_POST['nueva_existencia'];
    $nueva_descripcion = $_POST['nueva_descripcion'];

    // Construir la consulta SQL de actualización
    $sql = "UPDATE articulo SET nombre='$nuevo_nombre', precio_venta='$nuevo_precio_venta', existencia='$nueva_existencia', descripcion='$nueva_descripcion' WHERE idarticulo='$idarticulo' AND idcategoria='$idcategoria' AND codigo='$codigo' AND id_imagen='$idimagen' AND idprovedor='$idprovedor'";
    
    // Ejecutar la consulta de actualización
    if ($conexion->query($sql) === TRUE) {
        echo "Registro actualizado con éxito.";
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}

// Delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $idarticulo = $_POST['idarticulo'];
    $idcategoria = $_POST['idcategoria'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precio_venta = $_POST['precio_venta'];
    $existencia = $_POST['existencia'];
    $descripcion = $_POST['descripcion'];
    $id_imagen = $_POST['id_imagen'];
    $idprovedor = $_POST['idprovedor'];
    
    // Construir la consulta SQL de eliminación
    $sql = "DELETE FROM articulo WHERE idarticulo='$idarticulo' AND idcategoria='$idcategoria' AND codigo='$codigo' AND nombre='$nombre' AND precio_venta='$precio_venta' AND existencia='$existencia' AND descripcion='$descripcion' AND id_imagen='$id_imagen' AND idprovedor='$idprovedor'";
    
    // Ejecutar la consulta de eliminación
    if ($conexion->query($sql) === TRUE) {
        echo "Registro eliminado con éxito.";
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}


?>

<!-- Formulario para insertar un nuevo artículo -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Insertar un Nuevo Artículo</h2>
    ID Artículo: <input type="text" name="idarticulo"><br>
    ID Categoría: <input type="text" name="idcategoria"><br>
    Código: <input type="text" name="codigo"><br>
    Nombre: <input type="text" name="nombre"><br>
    Precio de Venta: <input type="text" name="precio_venta"><br>
    Existencia: <input type="text" name="existencia"><br>
    Descripción: <input type="text" name="descripcion"><br>
    ID Imagen: <input type="text" name="id_imagen"><br>
    ID Proveedor: <input type="text" name="idprovedor"><br>
    <input type="submit" name="insertar" value="Insertar">
</form>

<!-- Formulario para buscar un artículo -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Buscar un Artículo</h2>
    ID Artículo: <input type="text" name="idarticulo"><br>
    ID Categoría: <input type="text" name="idcategoria"><br>
    Código: <input type="text" name="codigo"><br>
    Nombre: <input type="text" name="nombre"><br>
    Precio de Venta: <input type="text" name="precio_venta"><br>
    Existencia: <input type="text" name="existencia"><br>
    Descripción: <input type="text" name="descripcion"><br>
    ID Imagen: <input type="text" name="id_imagen"><br>
    ID Proveedor: <input type="text" name="idprovedor"><br>
    <input type="submit" name="buscar" value="Buscar">
</form>


<!-- Formulario para actualizar un artículo -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Actualizar un Artículo</h2>
    ID Artículo: <input type="text" name="idarticulo"><br>
    ID Categoría: <input type="text" name="idcategoria"><br>
    Código: <input type="text" name="codigo"><br>
    ID Imagen: <input type="text" name="id_imagen"><br>
    ID Proveedor: <input type="text" name="idprovedor"><br>
    <h3>Datos a Actualizar</h3>
    Nuevo Nombre: <input type="text" name="nuevo_nombre"><br>
    Nuevo Precio de Venta: <input type="text" name="nuevo_precio_venta"><br>
    Nueva Existencia: <input type="text" name="nueva_existencia"><br>
    Nueva Descripción: <input type="text" name="nueva_descripcion"><br>
    <input type="submit" name="actualizar" value="Actualizar">
</form>

<!-- Formulario para eliminar un artículo -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Eliminar un Artículo</h2>
    ID Artículo: <input type="text" name="idarticulo"><br>
    ID Categoría: <input type="text" name="idcategoria"><br>
    Código: <input type="text" name="codigo"><br>
    Nombre: <input type="text" name="nombre"><br>
    Precio de Venta: <input type="text" name="precio_venta"><br>
    Existencia: <input type="text" name="existencia"><br>
    Descripción: <input type="text" name="descripcion"><br>
    ID Imagen: <input type="text" name="id_imagen"><br>
    ID Proveedor: <input type="text" name="idprovedor"><br>
    <input type="submit" name="eliminar" value="Eliminar">
</form>

</body>
</html>
