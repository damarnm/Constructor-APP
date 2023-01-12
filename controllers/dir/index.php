<?php
$dir = "../../../APP/";
//ver carpetas de APP
$dir = scandir($dir);
foreach ($dir as $carpeta) {
    if ($carpeta != "." && $carpeta != "..") {
        //$config = $dir . $carpeta . "/"; pasar a string
        $config = "../../../APP/$carpeta/controllers/config/";
        //echo $config;
        $db = false;
        if (is_dir($config)) {
            //echo "si es un directorio";
            $config = scandir($config);
            foreach ($config as $file) {
                //echo $file;
                if ($file == "connection.php") {
                    $db = true;
                }
            }
        }
        echo "<div class='container-fluid p-2 d-inline-block  rounded'>";
        echo "<div class='row'>
                <div class='col-5'>";
        echo "<div class='btn-group' role='group' aria-label='Basic example'>";
        echo "<a href='./?section=projects&name=$carpeta' class='btn btn-primary'>$carpeta</a>";
        echo "<a href='../APP/$carpeta' class='btn btn-success' target='_blank'><i class='bi bi-box-arrow-in-right'></i></a>";
        echo "</div>";
        echo '</div>';
        if ($db) {
            echo "<div class='col-7 text-success'>";
        } else {
            echo "<div class='col-7 text-danger'>";
        }
        echo "--------- DB: ";
        if ($db) {
            echo "SI";
        } else {
            echo "NO";
        }
        echo "</div>
            </div>";
        echo "</div>";
    }
}
