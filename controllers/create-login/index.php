<?php
if (isset($_POST['name'])) {
    $nombreProyecto = $_POST['name'];
    $path = '../../../APP/' . $nombreProyecto . '/';
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

    //verificar si existe un archivo en el pathIMG que inicie con favicon
    $favicon = glob($pathIMG . 'favicon*');
    if (count($favicon) > 0) {
        $favicon = $favicon[0];
    } else {
        $favicon = '';
    }

    $loginCss = "
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: sans-serif;
      }
      
      ::-webkit-scrollbar {
        width: 10px;
        height: 10px;
      }
      
      ::-webkit-scrollbar-track {
        background: #555555;
      }
      
      ::-webkit-scrollbar-thumb {
        background: #999999;
        border-radius: 10px;
      }
      
      ::-webkit-scrollbar-thumb:hover {
        background: #ffffff;
      }
      
      body {
        background-color: #000000;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        padding: 0.5em;
      }
      
      .header {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        height: 100%;
        background-color: #222222;
        border-radius: 10px;
        width: 50px;
        padding: 0.3em;
      }
      .header .nav {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 1em;
      }
      .header .nav .nav__link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        padding: 0.5em;
        border-radius: 5px;
        margin-top: 0.5em;
        transition: 0.3s;
        cursor: pointer;
      }
      .header .nav .nav__link:hover {
        background-color: #003e9b;
      }
      .header .nav .nav__link:active {
        background-color: #0070ff;
      }
      .header .nav .nav__link i {
        font-size: 2em;
        color: #ffffff;
      }
      .header .nav .nav__link.active {
        background-color: #0070ff;
      }
      .header img {
        width: 100%;
        display: inline-block;
      }
      .header .header__container__settings__link {
        color: #ffffff;
        font-size: 1.2em;
      }
      .header .header__container__settings__link:hover {
        color: #003e9b;
      }
      
      body {
        background-color: #000000;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        padding: 0.5em;
      }
      
      .main {
        display: flex;
        justify-content: center;
        height: 100%;
        width: 100%;
        margin-left: 0.5em;
        background-color: #222222;
        border-radius: 10px;
        padding: 1em;
        overflow: auto;
      }
      .main .main__container .main__container__form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
      .main .main__container .main__container__form .main__container__form__title {
        margin-top: 2em;
        color: #ffffff;
        text-align: center;
      }
      .main .main__container .main__container__form .main__container__form__title .blue {
        color: #005de9;
        margin-top: 1em;
      }
      .main .main__container .main__container__form form {
        text-align: center;
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 200px;
        margin-top: 1em;
      }
      .main .main__container .main__container__form form .form__group {
        position: relative;
        display: inline-block;
        width: 100%;
      }
      .main .main__container .main__container__form form .form__group #password {
        padding-right: 2.5em;
        border: none;
        border-radius: 5px;
        padding: 0.5em;
        outline: none;
        display: inline-block;
        width: 100%;
        text-align: center;
      }
      .main .main__container .main__container__form form .form__group .form__group__icon {
        display: inline-block;
        font-size: 2em;
        color: #ffffff;
      }
      .main .main__container .main__container__form form .form__group button {
        position: absolute;
        top: 0.3em;
        right: 0;
        border: none;
        border-radius: 5px;
        padding: 0.5em;
        outline: none;
        display: inline-block;
        width: 2.5em;
        height: 2.5em;
        background-color: #005de9;
        color: #ffffff;
        cursor: pointer;
        transition: 0.3s;
      }
      .main .main__container .main__container__form form .form__group button:hover {
        background-color: #003e9b;
      }
      .main .main__container .main__container__form form .form__group button:active {
        background-color: #0070ff;
      }
      
      .error {
        color: #e70027;
        text-align: center;
        margin-top: 1em;
      }
    ";

    $colorsSass = '
            $color-black: #000000;
            $color-dark: #222222;
            $color-dark-gray: #333333;
            $color-gray: #555555;
            $color-light-gray: #777777;
            $color-light: #999999;
            $color-white: #ffffff;
            $color-red: #e70027;
            $color-red-hover: #970019;
            $color-red-active: #ff002b;
            $color-blue: #005de9;
            $color-blue-hover: #003e9b;
            $color-blue-active: #0070ff;
            $color-green: #00b300;
            $color-green-hover: #008000;
            $color-green-active: #00ff00;
            $color-yellow: #ffcc00;
            $color-yellow-hover: #e6b800;
            $color-yellow-active: #ffff00;
            $color-orange: #ff6600;
            $color-orange-hover: #e65c00;
            $color-orange-active: #ff6a00;
            $color-purple: #9900cc;
            $color-purple-hover: #800080;
            $color-purple-active: #b200ff;
            $color-pink: #ff00cc;
            $color-pink-hover: #e600b2;
            $color-pink-active: #ff00ff;
            $color-brown: #996633;
            $color-brown-hover: #804d00;
            $color-brown-active: #b26b00;
            $color-cyan: #00cccc;
            $color-cyan-hover: #008080;
            $color-cyan-active: #00ffff;
            $color-teal: #009999;
            $color-teal-hover: #006666;
            $color-teal-active: #00b2b2;
    ';
    $constSass = '
        @import "colors";

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: $color-gray;
        }

        ::-webkit-scrollbar-thumb {
            background: $color-light;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: $color-white;
        }


        body {
            background-color: $color-black;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            padding: .5em;
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            background-color: $color-dark;
            border-radius: 10px;
            width: 50px;
            padding: .3em;
        
            .nav {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-top: 1em;
            
                .nav__link {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 100%;
                    height: 100%;
                    padding: .5em;
                    border-radius: 5px;
                    margin-top: .5em;
                    transition: .3s;
                    cursor: pointer;
                
                    &:hover {
                        background-color: $color-blue-hover;
                    }
                
                    &:active {
                        background-color: $color-blue-active;
                    }
                
                    i {
                        font-size: 2em;
                        color: $color-white;
                    }
                }
            
                .nav__link.active {
                    background-color: $color-blue-active;
                }
            }
        
            img {
                width: 100%;
                display: inline-block;
            }
        
            .header__container__settings__link {
                color: $color-white;
                font-size: 1.2em;
            
                &:hover {
                    color: $color-blue-hover;
                }
            }
        
        }
    ';
    $loginSass = '
                @import "colors";
                @import "const";

                body {
                    background-color: $color-black;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 100vw;
                    height: 100vh;
                    overflow: hidden;
                    padding: .5em;
                }


                .main {
                    display: flex;
                    justify-content: center;
                    // align-items: center;
                    height: 100%;
                    width: 100%;
                    margin-left: .5em;
                    background-color: $color-dark;
                    border-radius: 10px;
                    padding: 1em;
                    overflow: auto;
                
                    .main__container {
                        .main__container__form {
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                        
                            .main__container__form__title {
                                margin-top: 2em;
                                color: $color-white;
                                text-align: center;
                            
                                .blue {
                                    color: $color-blue;
                                    margin-top: 1em;
                                }
                            }
                        
                            form {
                                text-align: center;
                                display: flex;
                                flex-direction: column;
                                width: 100%;
                                max-width: 200px;
                                margin-top: 1em;
                            
                                .form__group {
                                    position: relative;
                                    display: inline-block;
                                    width: 100%;
                                
                                
                                    #password {
                                        padding-right: 2.5em;
                                        border: none;
                                        border-radius: 5px;
                                        padding: .5em;
                                        outline: none;
                                        display: inline-block;
                                        width: 100%;
                                        text-align: center;
                                    }
                                
                                    .form__group__icon {
                                        display: inline-block;
                                        font-size: 2em;
                                        color: $color-white;
                                    }
                                
                                    button {
                                        position: absolute;
                                        top: .3em;
                                        right: 0;
                                        border: none;
                                        border-radius: 5px;
                                        padding: .5em;
                                        outline: none;
                                        display: inline-block;
                                        width: 2.5em;
                                        height: 2.5em;
                                        background-color: $color-blue;
                                        color: $color-white;
                                        cursor: pointer;
                                        transition: .3s;
                                    
                                        &:hover {
                                            background-color: $color-blue-hover;
                                        }
                                    
                                        &:active {
                                            background-color: $color-blue-active;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                .error {
                    color: $color-red;
                    text-align: center;
                    margin-top: 1em;
                }
    ';
    $loginJs = "
        $(document).ready(function () {
            let error = $('#error');
            $('#password').on('keyup', function () {
                pin = $(this).val();
            
            
                if (pin.length == 7) {
                    $.ajax({
                        url: 'controllers/login/',
                        type: 'POST',
                        data: {
                            pin: pin
                        },
                        success: function (data) {
                        
                            console.log(data);
                            //eliminar espacios
                            data = data.replace(/\\s/g, '');
                            if (data == 'success') {
                                window.location.href = 'app/home/';
                            } else {
                                error.html(data);
                            }
                        }
                    });
                }
            });
        
            $('.btn--primary').on('click', function (e) {
                e.preventDefault();
                let pin = $('#password').val();
                $.ajax({
                    url: 'controllers/login/',
                    type: 'POST',
                    data: {
                        pin: pin
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == 'success') {
                            window.location.href = 'app/home/';
                        } else {
                            error.html(data);
                        }
                    }
                });
            });
        
        
        });
    ";

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
                <link rel="shortcut icon" href="static/img/' . $favicon . '" type="image/x-icon">
                <title>' . $nombreProyecto . ' | Login</title>
                </head>
                <body>
                    <header class="header">
                        <div class="header__container">
                            <div class="header__logo">
                                <img src="static/img/' . $favicon . '" alt="logo">
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

    echo "<p class='text-success text-center'>Login creado correctamente</p>";
}
