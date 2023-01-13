<?php
if (isset($_POST['name'])) {
    $nombreProyecto = $_POST['name'];
    $path = '../../../APP/' . $nombreProyecto . '/';
    $APP_PATH = $path . 'app/';
    $pathCSS = '../../../APP/' . $nombreProyecto . '/static/css/';
    $pathJS = '../../../APP/' . $nombreProyecto . '/static/js/';
    $pathIMG = '../../../APP/' . $nombreProyecto . '/static/img/';
    $pathSASS = '../../../APP/' . $nombreProyecto . '/static/sass/';
    $pathUtils = '../../../APP/' . $nombreProyecto . '/utils/';
    $pathControllers = '../../../APP/' . $nombreProyecto . '/controllers/login/';
    //crear path controllers si no existe
    if (!is_dir($pathControllers)) {
        mkdir($pathControllers, 0777, true);
    }

    $contentValidateSession = "<?php
    
    date_default_timezone_set('America/Bogota');
        function validate_session()
        {
            session_name('$nombreProyecto');
            session_start();
            if (!isset(\$_SESSION['login']) || \$_SESSION['login'] !== true) {
                return false;
            } else {
                return true;
            }
        }
    ";

    $loginCss = file_get_contents('../utils/css/login.css');
    $colorsSass = file_get_contents('../utils/sass/_colors.scss');
    $constSass = file_get_contents('../utils/sass/_const.scss');
    $loginSass = file_get_contents('../utils/sass/login.scss');
    $loginJs = file_get_contents('../utils/js/login.js');

    $loginPhp = '
        <?php
        require_once "../config/connection.php";

        if (isset($_POST["pin"])) {
            $pin = intval($_POST["pin"]);
            $user = "admin";
            $conn = $connection;
            $query = "SELECT * FROM user WHERE user = \'$user\'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $hash = $row["password"];
            if (password_verify($pin, $hash)) {
                session_name("' . $nombreProyecto . '");
                session_start();
                $_SESSION["login"] = true;
                echo "success";
            } else {
                echo "Pin incorrecto";
            }
        }

    ';
    $containerHtml = "
    <?php
    require_once 'utils/validation.php';

    if (validate_session()) {
        header('Location: app/home/');
        exit;
    }
    ?>
    ";
    $containerHtml .= '
            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css" integrity="sha512-YFENbnqHbCRmJt5d+9lHimyEMt8LKSNTMLSaHjvsclnZGICeY/0KYEeiHwD1Ux4Tcao0h60tdcMv+0GljvWyHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="stylesheet" href="static/css/login.css?v=<?php echo time(); ?>">
                <link rel="shortcut icon" href="static/img/favicon.png" type="image/x-icon">
                <title>' . $nombreProyecto . ' | Login</title>
                </head>
                <body>
                    <header class="header">
                        <div class="header__container">
                            <div class="header__logo">
                                <img src="static/img/logo.png" alt="logo">
                            </div>
                        </div>
                    </header>
                    <main class="main">
                    <div class="main__container">
                        <div class="main__container__form">
                            <div class="main__container__form__title">
                                <p>
                                    Hola...
                                </p>
                                <b>
                                    Te damos la bienvenida a nuestro sistema, <span style="text-transform:uppercase;">' . $nombreProyecto . '</span>
                                </b>
                                <p class="blue">
                                    Por favor ingresa tus credenciales para continuar
                                </p>
                            </div>
                            <form>
                                <div class="form__group">
                                    <div class="form__group__icon">
                                        <i class="bi bi-lock"></i>
                                    </div>
                                    <input type="password" name="password" id="password" placeholder="Pin" required autocomplete="off" autofocus>
                                </div>
                                <div class="error">
                                    <p id="error"></p>
                                </div>
                                <div class="form__group">
                                    <button type="submit" class="btn btn--primary">
                                        <!-- flecha sing -->
                                        <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
                <script src="static/js/login.js?v=<?php echo time(); ?>"></script>
            </body>
            </html>
    ';

    // Crear archivos
    $controlador = fopen($pathControllers . "index.php", "w") or die("Unable to open file!");
    fwrite($controlador, $loginPhp);
    fclose($controlador);

    $validacion = fopen($pathUtils . "validation.php", "w") or die("Unable to open file!");
    fwrite($validacion, $contentValidateSession);
    fclose($validacion);

    $css = fopen($pathCSS . "login.css", "w") or die("Unable to open file!");
    fwrite($css, $loginCss);
    fclose($css);

    $sass = fopen($pathSASS . "login.scss", "w") or die("Unable to open file!");
    fwrite($sass, $loginSass);
    fclose($sass);

    $sass2 = fopen($pathSASS . "_colors.scss", "w") or die("Unable to open file!");
    fwrite($sass2, $colorsSass);
    fclose($sass2);

    $sass3 = fopen($pathSASS . "_const.scss", "w") or die("Unable to open file!");
    fwrite($sass3, $constSass);
    fclose($sass3);

    $js = fopen($pathJS . "login.js", "w") or die("Unable to open file!");
    fwrite($js, $loginJs);
    fclose($js);


    $html = fopen($path . "index.php", "w") or die("Unable to open file!");
    fwrite($html, $containerHtml);
    fclose($html);

    //crear logout
    $pathLogout = $APP_PATH . "logout/";
    if (!is_dir($pathLogout)) {
        mkdir($pathLogout, 0777, true);
    }
    $pathLogout = $pathLogout . "index.php";
    $contentLogout = '<?php
    session_name("' . $nombreProyecto . '");
    session_start();
    session_destroy();
    header("Location: ../../");
    ?>';
    $logout = fopen($pathLogout, "w") or die("Unable to open file!");
    fwrite($logout, $contentLogout);
    fclose($logout);


    echo "<p class='text-success text-center'>Login creado correctamente</p>";
}
