<?php

require_once '../../Class/Structure.php';

$structure = new Structure();

if (isset($_POST['name'])) {
    $proyectName = $_POST['name'];
    $dbName = $_POST['nameDB'];
    $dbUser = $_POST['user'];
    $dbPass = $_POST['password'];
    $db = $_POST['db'];

    if ($db == 'true') {
        $db = true;
    } else {
        $db = false;
    }

    $structure->Structure($proyectName, '../../../APP/', $db, $dbUser, $dbPass, $dbName);
    echo 'true';
}
