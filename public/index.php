<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Kahut 2.0 - INicio</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Bienvenido a Kahut</h1>
        <form action="registrar.php" method="POST">
            <div class="usuario">
                <input type="text" id="nombreUsu" name="nombreUsu" required minlength="3" maxlength="20">
                <label for="nombreUsu">Nombre de Usuario</label>
            </div>
            <button type="submit" id="comenzar" style="display:none;">Comenzar Cuestionario</button>

            <a href="#">
                Comenzar Cuestionario
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </a>
        </form>
    </div>
</body>

</html>