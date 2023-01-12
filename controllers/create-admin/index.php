<?php
if (isset($_POST['name'])) {
    $nombreProyecto = $_POST['name'];
    $path = '../../../APP/' . $nombreProyecto . '/controllers/config/connection.php';
    //verificamos si existe el archivo
    if (file_exists($path)) {
        require_once $path;
        $createTableUser = "CREATE TABLE IF NOT EXISTS `user` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
        $createTableUser = $connection->query($createTableUser);

        $pass = "1232022";
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $user = "admin";
        //verificamos si existe el usuario admin
        $query = "SELECT * FROM user WHERE user = '$user'";
        $query = $connection->query($query);
        if ($query->num_rows == 0) {
            $insert = "INSERT INTO user (user, password) VALUES ('$user', '$pass')";
            $insert = $connection->query($insert);
            if ($insert) {
                echo '<p class="text-success">El usuario admin se creo correctamente</p>';
            } else {
                echo '<p class="text-danger">El usuario admin no se pudo crear</p>';
            }
        } else {
            echo '<p class="text-danger">El usuario admin ya existe</p>';
        }
    }
}
