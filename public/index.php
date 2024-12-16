<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Kahut - Inicio</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Bienvenido a Kahut</h1>
        <form action="registrar.php" method="POST">
            <label for="nombreUsu">Nombre de Usuario:</label>
            <input type="text" id="nombreUsu" name="nombreUsu" required minlength="3" maxlength="20">

            <button type="submit">Comenzar Cuestionario</button>
        </form>
    </div>
</body>

</html>