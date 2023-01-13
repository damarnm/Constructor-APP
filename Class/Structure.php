<?php

class Structure
{
    /**
     * @param $app - Application name
     * @param $path - Path to application
     * @param bool $conn - If true, create connection file
     */
    public function Structure($app, $path, $conn, $user, $pass, $db)
    {
        $root = $path;
        if (!is_dir($root)) {
            mkdir($root, 0777, true);
        }
        $dir = $path . $app;
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
            if (!is_dir($dir . '/controllers')) {
                mkdir($dir . '/controllers', 0777, true);
            }
            if (!is_dir($dir . '/app')) {
                mkdir($dir . '/app', 0777, true);
            }
            if (!is_dir($dir . '/static')) {
                mkdir($dir . '/static', 0777, true);
            }
            if (!is_dir($dir . '/static/css')) {
                mkdir($dir . '/static/css', 0777, true);
            }
            if (!is_dir($dir . '/static/js')) {
                mkdir($dir . '/static/js', 0777, true);
            }
            if (!is_dir($dir . '/static/img')) {
                mkdir($dir . '/static/img', 0777, true);
            }
            if (!is_dir($dir . '/static/sass')) {
                mkdir($dir . '/static/sass', 0777, true);
            }
            if (!is_dir($dir . '/utils')) {
                mkdir($dir . '/utils', 0777, true);
            }
            $menuContent = '
            <?php
            function menu($page){
                return "";
            }
            ?>';
            $file_name = $dir . '/utils/menu.php';
            $file = fopen($file_name, 'w');
            fwrite($file, $menuContent);
            fclose($file);

            if (!is_dir($dir . '/functions')) {
                mkdir($dir . '/functions', 0777, true);
            }
            $content_conn = "<?php
                        define('DB_HOST', 'localhost');
                        define('DB_USER', '$user');
                        define('DB_PASS', '$pass');
                        define('DB_NAME', '$db');
                        \$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                        if (\$connection->connect_error) {
                            die('Connection failed: ' . \$connection->connect_error);
                        }
                     ?>";
            if (!is_dir($dir . '/controllers/config')) {
                mkdir($dir . '/controllers/config', 0777, true);
            }
            $file_name = $dir . '/controllers/config/connection.php';
            if ($conn) {
                $connection = new mysqli('localhost', $user, $pass, $db);
                if ($connection->connect_error) {
                    die('Connection failed: ' . $connection->connect_error);
                } else {
                    $file = fopen($file_name, 'w');
                    $writte = fwrite($file, $content_conn);
                    fclose($file);
                }
            }
        } else {
            return false;
        }
    }

    public function updateDB($app, $path, $user, $pass, $db)
    {
        //$path = '../APP/';
        $dir = $path . $app;
        $content_conn = "<?php
                        define('DB_HOST', 'localhost');
                        define('DB_USER', '$user');
                        define('DB_PASS', '$pass');
                        define('DB_NAME', '$db');
                        \$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                        if (\$connection->connect_error) {
                            die('Connection failed: ' . \$connection->connect_error);
                        }
                     ?>";
        $file_name = $dir . '/controllers/config/connection.php';
        $file = fopen($file_name, 'w');
        $written = fwrite($file, $content_conn);
        fclose($file);
    }
}

// $exec = new Structure();
// $exec->Structure('ejemplo práctico', '../', true, 'root', '', 'phlib');
// $exec->updateDB('ejemplo práctico', '../', 'root', '', 'rbs');
