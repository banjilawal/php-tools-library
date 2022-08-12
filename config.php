<?php
    # directory paths
    define ('ROOT',  __DIR__ );

    define ('UTIL_PATH', ROOT . DIRECTORY_SEPARATOR . 'util');
    define ('SUPERMODEL_PATH', ROOT . DIRECTORY_SEPARATOR . 'supermodel'); 
    define ('DATASETS_PATH', ROOT . DIRECTORY_SEPARATOR . 'datasets');

    # constants
    define ('ADDRESS_FIELD_COUNT', 5);
    
 /*   
    # dataset files
    define ('LAST_NAMES', DATASETS_PATH . DIRECTORY_SEPARATOR . 'last-names.txt');    
    define ('FIRST_NAMES', DATASETS_PATH . DIRECTORY_SEPARATOR . 'gendered-first-names.csv');
*/

    function autoloader ($class_name) {

        # List all the class directories in the array.
        $array_paths = array(
            'classes_1/', 
            'classes_2/'
        );

        # Count the total item in the array.
        $total_paths = count($array_paths);

        # Set the class file name.
        $file_name = 'class_'.strtolower($class_name).'.php';

        # Loop the array.
        for ($i = 0; $i < $total_paths; $i++) {
         #   if(file_exists(AP_SITE.$array_paths[$i].$file_name)) {
         #       include_once AP_SITE.$array_paths[$i].$file_name;
            } 
        }

    spl_autoload_register('autoloader');
?>