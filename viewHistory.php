<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once "DBMainV3.php";

/*
        $newCon = new ManipulateDB();
        
        if connectToDBMS() == true{
            print("hello");
        }

*/
        
        // Conexión a la base de datos
        $conn = mysqli_connect("localhost", "root","", "kidsGames");
        
        // Verificar la conexión
        if (!$conn) {
            die("Error al conectar a la base de datos: " . mysqli_connect_error());
        }
        
        // Consulta SQL para obtener los datos de la vista
        $sql = "SELECT scoreTime, id, fName, lName, result, livesUsed FROM history";
        
        // Ejecutar la consulta
        $resultado = mysqli_query($conn, $sql);
        
        // Verificar si se encontraron resultados
        if (mysqli_num_rows($resultado) > 0) {
            // Mostrar los datos en una tabla HTML
            echo "<table>";
            echo "<tr><th>scoreTime</th><th>id</th><th>fName</th><th>lName</th><th>result</th><th>livesUsed</th></tr>";
            while($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr><td>" . $fila["scoreTime"] . "</td><td>" . $fila["id"] . "</td><td>" . $fila["fName"] . "</td><td>" . $fila["lName"] . "</td><td>" . $fila["result"] . "</td><td>" . $fila["livesUsed"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron resultados.";
        }
        
        // Cerrar la conexión
        mysqli_close($conn);
        ?>
        
</body>
</html>

    
    
