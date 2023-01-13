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
                <button class="btn btn-primary create-menu">
                    Crear menu
                </button>
            </div>
        </div>
        <div class="col">
            <div class="form">
                <!-- formulario para subir imagen -->
                <form action="./controllers/create-favicon/index.php" method="post" enctype="multipart/form-data">
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
    $('.create-page').click(function() {
        let container = $('.response');
        let html = `
        <div class="form-group m-2">
            <input type="text" class="form-control namePage" placeholder="Nombre pagina">
        </div>
        <div class="text-danger error-create-page"></div>
        <div class="form-group m-2">
            <button type="submit" class="btn btn-primary btn-create">Crear</button>
        </div>
        `;
        container.html(html);
    });


    $(document).on('click', '.btn-create', function() {
        let namePage = $('.namePage').val();
        if (namePage == '') {
            $('.error-create-page').html('El nombre de la pagina no puede estar vacio');
            return;
        }
        $.ajax({
            type: "POST",
            url: "./controllers/create-page/",
            data: {
                name: '<?php echo $nombreProyecto; ?>',
                namePage: namePage
            },
            success: function(response) {
                $('.response').html(response);
            }
        });
    });


    $('.create-menu').click(function() {
        let container = $('.response');
        let html = `
        <div class="alert alert-warning" role="alert">
            Al crear el menu, se borrará el menu anterior
        </div>
        <div class="container">
            <div class="form-group m-2">
                <input type="text" class="form-control namePage-1" placeholder="Nombre pagina">
                <input type="text" class="form-control icon-1" placeholder="Html icono">
                <select class="form-select page-1" aria-label="Default select example">
                    <option selected value="">Seleccionar pagina</option>
                    <?php
                    $path = '../APP/' . $nombreProyecto . '/app/';
                    $files = scandir($path);
                    foreach ($files as $file) {
                        if ($file != '.' && $file != '..') {
                            echo '<option value="' . $file . '">' . $file . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary addPage">Agregar pagina</button>
            <button type="button" class="btn btn-primary createMenu">Crear menu</button>
        </div>
        `;
        container.html(html);

    });
    let contadorPages = 1;

    $(document).on('click', '.addPage', function() {
        contadorPages++;
        let container = $('.container');
        let html = `
        <div class="form-group m-2">
            <input type="text" class="form-control namePage-${contadorPages}" placeholder="Nombre pagina">
            <input type="text" class="form-control icon-${contadorPages}" placeholder="Html icono">
            <select class="form-select page-${contadorPages}" aria-label="Default select example">
                <option selected value="">Seleccionar pagina</option>
                <?php
                $path = '../APP/' . $nombreProyecto . '/app/';
                $files = scandir($path);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        echo '<option value="' . $file . '">' . $file . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        `;
        container.append(html);
    });

    $(document).on('click', '.createMenu', function() {
        let namePage = [];
        let page = [];
        let icon = [];
        for (let i = 1; i <= contadorPages; i++) {
            namePage.push($('.namePage-' + i).val());
            page.push($('.page-' + i).val());
            icon.push($('.icon-' + i).val());
        }

        $.ajax({
            type: "POST",
            url: "./controllers/create-menu/",
            data: {
                name: '<?php echo $nombreProyecto; ?>',
                namePage: namePage,
                page: page,
                icon: icon
            },
            success: function(response) {
                $('.response').html(response);
            }
        });
    });
</script>