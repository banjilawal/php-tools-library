<?php declare(strict_types=1);
    
    function loader () {
        
    }
    $target = new RecursiveDirectoryIterator(__DIR__);
    $subFolders = new RecursiveIteratorIterator($target);

    $exclude = '/history|git|vscode|\.$/i';
    $phpFile = '/\.php$/i';

    foreach ($subFolders as $item) {
        $path = $item->__toString();
        if (preg_match($exclude, $path) == 0 && is_file($path) && preg_match($phpFile, $path) == 1) {
            $arr = pathinfo($path);
            echo $arr['dirname'];

            
            #print_r($arr); #echo $arr[0] . ' ' . $arr[1];
           # print_r(pathinfo($path));
           # echo pathinfo($path)[1];
            echo  ' type: ' . $path . '<br>';
        }
    }

/*

    $rootDirectory = new \RecursiveDirectoryIterator(__DIR__);
    $subDirectory = new \RecursiveIteratorIterator($rootDirectory);
    #$regexIter = new RegexIterator($iter, '/\.php$/', RecursiveRegexIterator::GET_MATCH);

    //print_r(iterator_to_array($regexIter)); 

    foreach ($subDirectory as $item) {
        $name = $item->getFilename();
        $path = realpath($name);
        if (preg_match('/\.php$/i', $name) == 1) {
            echo 'type: ' . gettype($name) . ' file: ' . $name . ' path: ' . $path . '<br>';
        }
    }
*/
/*
        if (is_dir($info->getFileName())) {
            echo $info->getFilename() . '<br>';
        }
     }

    foreach ($iter as $info) {
        if (preg_match('/\.history/', $info->getFileName()) == 0) {
            if ($info->isFile() && preg_match('/\.php$/i', $info->getFilename())) {
                echo $info->getFileInfo() . '<br>';
            }         
        }
     
    }

    $files = array();
    foreach ($iter as $info) {

        $files[] = $info->getPathname();
        #echo $info;
    }
*/    
?>