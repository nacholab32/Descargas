<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Descargar Video de YouTube</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Tareas a Realizar</a>
            <a class="navbar-brand" href="index.php">Descargas</a>
        </div>
    </nav>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="url">Ingrese la URL del video de YouTube:</label>
                            <input type="text" id="url" name="url" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="formato">Seleccione el formato (mp4 o mp3):</label>
                            <input type="text" id="formato" name="formato" class="form-control" required>
                        </div>
                        <input type="submit" value="Descargar" class="btn btn-success btn-block">
                    </form>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $url = $_POST["url"];
                        $formato = $_POST["formato"];

                        // Validar entradas
                        if (!filter_var($url, FILTER_VALIDATE_URL)) {
                            echo "<div class='alert alert-danger mt-2'>URL no válida.</div>";
                        } else if (!in_array($formato, ['mp4', 'mp3'])) {
                            echo "<div class='alert alert-danger mt-2'>Formato no válido.</div>";
                        } else {
                            // Ejecutar el código de Pytube con la URL y el formato proporcionados
                            $command = escapeshellcmd("python3 descargar_video.py " . escapeshellarg($url) . " " . escapeshellarg($formato));
                            $output = shell_exec($command);
                            echo "<div class='alert alert-info mt-2'><pre>$output</pre></div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP 4 SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
