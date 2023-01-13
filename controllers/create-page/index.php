<?php
if (isset($_POST['name'])) {

    $nombreProyecto = $_POST['name'];
    $nombrePagina = $_POST['namePage'];
    $nombrePagina = preg_replace('/\s+/', '', $nombrePagina);
    $nombrePagina = mb_strtolower($nombrePagina, 'UTF-8');
    $nombrePagina = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $nombrePagina
    );
    $nombrePagina = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $nombrePagina
    );
    $nombrePagina = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $nombrePagina
    );
    $nombrePagina = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $nombrePagina
    );
    $nombrePagina = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $nombrePagina
    );
    $nombrePagina = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $nombrePagina
    );
    $nombrePagina = str_replace(
        array(
            "\\", "¨", "º", "-", "~",
            "#", "@", "|", "!", "\"",
            "·", "$", "%", "&", "/",
            "(", ")", "?", "'", "¡",
            "¿", "[", "^", "<code>", "]",
            "+", "}", "{", "¨", "´",
            ">", "< ", ";", ",", ":",
            "."
        ),
        '',
        $nombrePagina
    );

    $path = '../../../APP/' . $nombreProyecto . '/';
    $pathApp = $path . 'app/';
    $pathStatic = $path . 'static/';
    $pathJs = $pathStatic . 'js/';
    $pathCss = $pathStatic . 'css/';
    $pathSass = $pathStatic . 'sass/';
    $pathPage = $pathApp . $nombrePagina . '/';

    $pathView = $path . 'views/';
    if (!is_dir($pathView)) {
        mkdir($pathView, 0777, true);
    }
    $nameFileView = $pathView . 'View' . ucfirst($nombrePagina) . '.php';

    $styleSASS = file_get_contents('../utils/sass/style.scss');
    $styleCSS = file_get_contents('../utils/css/style.css');

    if (!is_dir($pathPage)) {
        mkdir($pathPage, 0777, true);
    }


    $js = fopen($pathJs . $nombrePagina . '.js', 'w');
    fwrite($js, '');
    fclose($js);
    $css = fopen($pathCss . $nombrePagina . '.css', 'w');
    fwrite($css, '');
    fclose($css);
    $sass = fopen($pathSass . $nombrePagina . '.scss', 'w');
    fwrite($sass, '');
    fclose($sass);
    $filePhp = fopen($pathView . 'View' . ucfirst($nombrePagina) . '.php', 'w');
    fwrite($filePhp, '');
    fclose($filePhp);
    $styleSass = fopen($pathSass . 'style.scss', 'w');
    $styleCss = fopen($pathCss . 'style.css', 'w');
    $styleSass = fwrite($styleSass, $styleSASS);
    $styleCss = fwrite($styleCss, $styleCSS);


    $indexHtml = '
    <?php
    require_once "../../utils/validation.php";
    require_once "../../utils/menu.php";

    if (!validate_session()) {
        header("Location: ../../");
        exit;
    }
    ?>
    <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css" integrity="sha512-YFENbnqHbCRmJt5d+9lHimyEMt8LKSNTMLSaHjvsclnZGICeY/0KYEeiHwD1Ux4Tcao0h60tdcMv+0GljvWyHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="stylesheet" href="../../static/css/style.css?v=<?php echo time(); ?>">
                <link rel="stylesheet" href="../../static/css/' . $nombrePagina . '.css?v=<?php echo time(); ?>">
                <link rel="shortcut icon" href="../../static/img/favicon.png" type="image/x-icon">
                <title>' . $nombreProyecto . ' | ' . $nombrePagina . '</title>
                </head>
                <body>
                    <header class="header">
                        <div class="header__container">
                            <div class="header__logo">
                                <img src="../../static/img/logo.png" alt="logo">
                            </div>
                            <nav class="nav">
                            <?php echo menu("' . $nombrePagina . '"); ?>
                            </nav>
                        </div>
                    </header>
                    <main class="main">
                    <div class="main__container">
                        <?php require_once "../../views/View' . ucfirst($nombrePagina) . '.php"; ?>
                    </div>
                </main>
                <script src="../../static/js/' . $nombrePagina . '.js?v=<?php echo time(); ?>"></script>
            </body>
            </html>
    ';

    $index = fopen($pathPage . 'index.php', 'w');
    fwrite($index, $indexHtml);
    fclose($index);

    echo '<p class="alert alert-success">La página se ha creado correctamente</p>';
}

















/*

<!-- <nav class="nav">
<a href="" class="nav__link"><i>fsf</i></a>
<a href="" class="nav__link"><i>fsf</i></a>
<a href="" class="nav__link"><i>fsf</i></a>
<a href="" class="nav__link"><i>fsf</i></a>
<a href="" class="nav__link"><i>fsf</i></a>
</nav> -->
*/