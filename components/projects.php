<?php
$nombreProyecto = $_GET['name'];
?>
<div class="header container-fluid bg-dark text-start p-2">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="./?section=home" class="btn btn-primary">Home</a>
    </div>
    <h3 class="text-center text-white display-6">
        <?php echo $nombreProyecto; ?>
    </h3>
</div>
<div class="container-fluid  text-start">
    <div class="row">

        <div class="col">
            <div class="btn-group-vertical">
                <button class="btn btn-primary create-admin">
                    Crear usuario admin
                </button>
                <button class="btn btn-primary create-login">
                    Crear login
                </button>
                <button class="btn btn-primary create-page">
                    Crear pagina
                </button>
                <button class="btn btn-primary update-db">
                    Actualizar base de datos
                </button>
            </div>
        </div>
        <div class="col">
            <div class="form">
                <!-- formulario para subir imagen -->
                <form action="./controllers/create-favicon/index.php" method="post" enctype="multipart/formdata">
                    <div class="form-group">
                        <label for="file">Subir favicon</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                        <input type="hidden" name="name" value="<?php echo $nombreProyecto; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Subir</button>
                </form>
            </div>
            <div class="response"></div>
        </div>
    </div>
</div>

<script>
    $('.create-login').click(function() {
        $.ajax({
            type: "POST",
            url: "./controllers/create-login/",
            data: {
                name: '<?php echo $nombreProyecto; ?>'
            },
            success: function(response) {
                $('.response').html(response);
            }
        });
    });
    $('.create-admin').click(function() {
        $.ajax({
            type: "POST",
            url: "./controllers/create-admin/",
            data: {
                name: '<?php echo $nombreProyecto; ?>'
            },
            success: function(response) {
                $('.response').html(response);
            }
        });
    });
</script>