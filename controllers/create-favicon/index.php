<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreProyecto = $_POST['name'];
    $img = $_FILES['file']['tmp_name'];
    $pathIMG = '../../../APP/' . $nombreProyecto . '/static/img/';
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if ($ext != 'png') {
        echo 'false';
        exit;
    }
    $imgName = 'favicon.png';
    $imgPath = $pathIMG . $imgName;
    if (!file_exists($pathIMG)) {
        mkdir($pathIMG, 0777, true);
    }
    if (file_exists($imgPath)) {
        unlink($imgPath);
    }
    if (move_uploaded_file($img, $imgPath)) {
        //crear logo.png, una copia de favicon.png
        $logoPath = $pathIMG . 'logo.png';
        if (copy($imgPath, $logoPath)) {
            header('Location: ../../?section=projects&name=' . $nombreProyecto);
        } else {
            echo 'false';
        }
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}
