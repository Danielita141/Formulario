<head>
    <style>
        table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-family: Arial, sans-serif;
}

th, td {
    border: 1px solid #007BFF; /* Borde azul */
    padding: 10px;
    text-align: left;
}

th {
    background-color: #007BFF; /* Color de fondo azul para el encabezado */
    color: white; /* Color del texto en el encabezado */
}

tbody tr:nth-child(even) {
    background-color: #e7f3ff; /* Color de fondo azul claro para filas pares */
}

tbody tr:hover {
    background-color: #b3d7ff; /* Color de fondo al pasar el mouse */
}

a {
    color: #007BFF; /* Color de los enlaces */
    text-decoration: none; /* Quita el subrayado de los enlaces */
}

a:hover {
    text-decoration: underline; /* Subraya al pasar el mouse */
}

    </style>
</head>

<?php
require_once 'conexion.php';

$conexionDB = new Conexion();
$conexion = $conexionDB->conectar();

$sql = "
    SELECT u.id_usuario, u.nombre_usuario, u.correo_electronico, td.nombreDocumento, u.numeroDocumento 
    FROM usuarios u
    JOIN TiposDocumentos td ON u.id_tipoDocumento = td.id_tipoDocumento
";

$resultado = $conexion->query($sql);



if ($resultado->rowCount() > 0) {
    echo "<table border='1'>
            <tr>
                <th>NOMBRE USUARIO</th>
                <th>EMAIL</th>
                <th>TIPO DE DOCUMENTO</th>
                <th>NÚMERO DE DOCUMENTO</th>
                <th>ACCIONES</th>
            </tr>";

    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>".$fila['nombre_usuario']."</td>
                <td>".$fila['correo_electronico']."</td>
                <td>".$fila['nombreDocumento']."</td>
                <td>".$fila['numeroDocumento']."</td>
                <td>
                    <a href='editar.php?id=".$fila['id_usuario']."'>Editar</a> 
                    <a href='eliminar.php?id=".$fila['id_usuario']."' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este usuario?');\">Eliminar</a> 
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay registros encontrados.";
}
?>