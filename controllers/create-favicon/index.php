<?php
// if (isset($_POST['name']) && isset($_POST['favicon'])) {
//     echo 'true';
//     $nombreProyecto = $_POST['name'];
//     $img = $_POST['favicon'];
//     $pathIMG = '../../../APP/' . $nombreProyecto . '/static/img/';

//     if (!file_exists($pathIMG)) {
//         mkdir($pathIMG, 0777, true);
//     }

//     //capturar la imagen del formulario
//     $img = $_POST['favicon'];
//     //convertir la imagen a base64
//     $img = str_replace('data:image/png;base64,', '', $img);
//     $img = str_replace(' ', '+', $img);
//     $data = base64_decode($img);
//     //guardar la imagen en el servidor
//     $file = $pathIMG . 'favicon.png';
//     $success = file_put_contents($file, $data);
//     //si la imagen se guardo correctamente redireccionar a la pagina de inicio
//     if ($success) {
//         header('Location: ../../?section=projects&name=' . $nombreProyecto);
//     } else {
//         echo 'false';
//     }
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo 'true';
    $nombreProyecto = $_POST['name'];
    echo $nombreProyecto;
    $img = $_FILES['favicon']['name'];
    echo $img;
    // echo $img;
    // // $pathIMG = '../../../APP/' . $nombreProyecto . '/static/img/';

    // if (!file_exists($pathIMG)) {
    //     mkdir($pathIMG, 0777, true);
    // }
} else {
    echo 'false';
}
