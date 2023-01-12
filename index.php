<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Constructor de aplicaciones</title>
</head>

<body>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-3 bg-dark">
                <h5 class="text-white text-start">Proyectos</h5>
                <div class="container-dir"></div>
            </div>
            <div class="col-9">
                <div class="app">
                    <?php
                    if (isset($_GET['section'])) {
                        $section = $_GET['section'];
                        require_once "components/$section.php";
                    } else {
                        require_once "components/home.php";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <script>
        function getDir() {
            $.ajax({
                url: "controllers/dir/",
                type: "POST",
                success: function(response) {
                    $(".container-dir").html(response);
                }
            });

        }
    </script>
    <script>
        $(document).ready(function() {
            getDir();
        });
    </script>
    <script>
        //si selecciona si, mostrar el formulario para crear la base de datos
        document.getElementById('db').addEventListener('change', function() {
            if (this.value == 'true') {
                document.querySelector('.display-db').style.display = 'block';
            } else {
                document.querySelector('.display-db').style.display = 'none';
            }
        });
        //crear proyecto
        $('.create-proyect').click(function(e) {
            e.preventDefault();
            let name = $('#name').val();
            let db = $('#db').val();
            let nameDB = $('#nameDB').val();
            let user = $('#user').val();
            let password = $('#password').val();
            $.ajax({
                type: "POST",
                url: "controllers/create-proyect/",
                data: {
                    name: name,
                    db: db,
                    nameDB: nameDB,
                    user: user,
                    password: password
                },
                success: function(response) {
                    console.log(response);
                    if (response == 'true') {
                        location.href = 'index.php?section=projects&name=' + name;
                        getDir();
                    } else {
                        alert('Error al crear el proyecto');
                    }
                }
            });
        });
    </script>
</body>

</html>