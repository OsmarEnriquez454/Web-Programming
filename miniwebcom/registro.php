<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST['nombre'];
    $apellido_pat = $_POST['apellido_pat'];
    $apellido_mat = $_POST['apellido_mat'];
    $edad = $_POST['edad'];
    $carrera = $_POST['carrera'];
    $color = $_POST['color'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Validar materias seleccionadas
    if (isset($_POST['materias']) && count($_POST['materias']) == 3){
        $mat1 = $_POST['materias'][0];
        $mat2 = $_POST['materias'][1];
        $mat3 = $_POST['materias'][2];
    }
    else{
        echo "<p>Debes seleccionar por lo menos 3 materias</p>";
        
    }

    // Subir foto
    $nombre_foto = $_FILES["foto"]["name"];
    $tmp = $_FILES["foto"]["tmp_name"];
    $carpeta = "uploads/";
    move_uploaded_file($tmp, $carpeta . $nombre_foto);
    // Guardamos la ruta para insertar en la base de datos
    $foto = $carpeta . $nombre_foto;

    // Guardar alumno
    $sql = "INSERT INTO alumnos 
    (nombre, apellido_pat, apellido_mat, edad, carrera, mat1, mat2, mat3, color_fondo, usuario, contrasena, foto)
    VALUES ('$nombre','$apellido_pat','$apellido_mat','$edad','$carrera',
    '$mat1','$mat2','$mat3','$color','$usuario','$contrasena','$foto')";

    if (mysqli_query($conexion, $sql)) {
        echo "<p>Registro exitoso <a href='index.php'>Inicia sesión</a></p>";
    } else {
        echo "<p>Error: " . mysqli_error($conexion) . "</p>";
    }
}
?>

<h2>Registro de Alumno</h2>

<form method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre" required><br>
    Apellido Paterno: <input type="text" name="apellido_pat" required><br>
    Apellido Materno: <input type="text" name="apellido_mat" required><br>
    Edad: <input type="number" name="edad" required><br>
    Carrera: <input type="text" name="carrera" required><br>
    Color de fondo: <input type="color" name="color" required><br><br>

    <label>Selecciona por lo menos 3 materias:</label><br>
    <input type="checkbox" name="materias[]" value="1"> Matemáticas I<br>
    <input type="checkbox" name="materias[]" value="2"> Programación I<br>
    <input type="checkbox" name="materias[]" value="3"> Física I<br>
    <input type="checkbox" name="materias[]" value="4"> Historia Universal<br>
    <input type="checkbox" name="materias[]" value="5"> Inglés I<br><br>


    Usuario: <input type="text" name="usuario" required><br>
    Contraseña: <input type="password" name="contrasena" required><br>
    Foto: <input type="file" name="foto" accept="image/*" required><br><br>

    <input type="submit" value="Registrar Alumno">
</form>

<p><a href="index.php">Volver al inicio</a></p>
