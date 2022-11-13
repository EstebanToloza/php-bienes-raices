<?php

//base de datos

require "../../includes/config/database.php";
$db = conectarDB();

//Array con mjes de errores
$errores = [];
//Ejecutas el código después de que el usuario envía el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedores_id = $_POST['vendedor'];

    if (!$titulo) {
        $errores[] = "Debes añadir un título"; //los mensajes de error comienzan a agregarse al final del array
    }
    if (!$precio) {
        $errores[] = "Debes añadir un precio";
    }
    if (strlen(!$descripcion) < 50) {
        $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "Debes añadir un número de habitaciones";
    }
    if (!$wc) {
        $errores[] = "Debes añadir un número de baños";
    }
    if (!$estacionamiento) {
        $errores[] = "Debes añadir un número de estacionamiento";
    }
    if (!$vendedores_id) {
        $errores[] = "Debes elegir un vendedor";
    }

    //revisar que no existan errores
    if (empty($errores)) {
        //insertar en DB
        $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedores_id' )";

        //echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo "insertado correctamente";
        }
    }
}
//
require '../../includes/funciones.php';

incluirTemplate('header')
?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php
    foreach ($errores as $error) : ?>
        <div class="alerta error"><?php echo $error ?></div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
        <fieldset>
            <legend>Información General</legend>

            <label for="título" class="">Título</label>
            <input type="text" name="titulo" id="titulo" placeholder="Título propiedad">

            <label for="precio" class="">Precio</label>
            <input type="number" name="precio" id="precio" placeholder="Precio propiedad">

            <label for="imagen" class="">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion" class="">Descripción</label>
            <textarea type="text" name="descripcion" id="descripcion" placeholder="Descripción propiedad"></textarea>

        </fieldset>
        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones" class="">Habitaciones</label>
            <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="10">

            <label for="wc" class="">Baños</label>
            <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="10">

            <label for="estacionamiento" class="">Estacionamiento</label>
            <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" max="10">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="">-- Selecciona un vendedor --</option>
                <option value="1">Juan</option>
                <option value="2">Diego</option>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde" />
    </form>

</main>

<?php
incluirTemplate('footer')
?>