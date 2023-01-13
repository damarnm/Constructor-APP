<?php
if (isset($_POST['name'])) {

    $nombreProyecto = $_POST['name'];

    $path = '../../../APP/' . $nombreProyecto . '/';
    $pathUtils = $path . 'utils/';

    $nombrePagina = $_POST['namePage'];
    $paginas = $_POST['page'];
    $iconos = $_POST['icon'];

    // echo $nombreProyecto;
    // echo '<br>';
    // print_r($nombrePagina);
    // echo '<br>';
    // print_r($paginas);
    // echo '<br>';
    // print_r($iconos);
    // echo '<br>';

    $fileMenuContent = "
    <?php
        function menu(\$page){
            \$pagesName = " . var_export($nombrePagina, true) . ";
            \$pages = " . var_export($paginas, true) . ";
            \$icons = " . var_export($iconos, true) . ";
            //<a href='\$page' class='nav__link'><i>\$icon</i></a>
            \$html = '';
            for(\$i = 0; \$i < count(\$pages); \$i++){
                \$html .= '<a href=\"../' . \$pages[\$i] . '\" class=\"nav__link';
                if(\$page == \$pages[\$i]){
                    \$html .= ' active';
                }
                \$html .= '\" title=\"' . \$pagesName[\$i] . '\"> ' . \$icons[\$i] . '</a>';
            }
            \$html .= '<a href=\"../logout\" class=\"nav__link\" title=\"Cerrar sesión\"> <i class=\"bi bi-box-arrow-in-left\"></i></a>';
            return \$html;
        }
    ?>
    ";

    $fileMenu = fopen($pathUtils . 'menu.php', 'w');
    fwrite($fileMenu, $fileMenuContent);
    fclose($fileMenu);

    echo '<p class="alert alert-success">El menú se ha creado correctamente</p>';
}
