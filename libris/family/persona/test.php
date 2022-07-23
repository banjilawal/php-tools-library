<?php
    function config_path () {

        $root = '';
        $abs_path = explode('/', $_SERVER['DOCUMENT_ROOT']);
        $project_home = explode('/', $_SERVER['REQUEST_URI'])[1];

        foreach ($abs_path as $dir) {
            $root .= $dir . DIRECTORY_SEPARATOR;
        }
    
        $root = trim($root, DIRECTORY_SEPARATOR);
        return $root . DIRECTORY_SEPARATOR . $project_home . DIRECTORY_SEPARATOR . 'config.php';
    } // close config_path
    
    $abs_path = explode('/', $_SERVER['DOCUMENT_ROOT']);

    echo 'htdocs path: ' . $root . '<br>';

    $uri =  $_SERVER['REQUEST_URI'];
    echo 'uri: ' . $uri . '<br>';
    $project_home = explode('/', $uri)[1];
    $config_path = $root . DIRECTORY_SEPARATOR . $project_home . DIRECTORY_SEPARATOR . 'config.php';
    echo 'config path: ' . $config_path . '<br>';
    echo 'project home: ' .$project_home . '<br>';
    #echo '<p>path: ' . print_r(explode('/', $_SERVER['DOCUMENT_ROOT'])) . '</p>';

    #echo print_r($_SERVER);

    #echo '<p>' . $_SERVER['DOCUMENT_ROOT'] . '<br>';

    #echo $_SERVER['REQUEST_URI'] . '</p>'; 

    #$home = explode('/', $_SERVER['REQUEST_URI'])[1];
    #echo $home

    #$path = $_SERVER['DOCUMENT_ROOT']  . DIRECTORY_SEPARATOR . $home . DIRECTORY_SEPARATOR .  'config.php';
    #echo $path;
?>