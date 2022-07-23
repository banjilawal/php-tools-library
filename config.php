<?php
    # directory paths
    define ('ROOT',  __DIR__ );

    define ('UTIL_PATH', ROOT . DIRECTORY_SEPARATOR . 'util');
    define ('LIBRARY_PATH', ROOT . DIRECTORY_SEPARATOR . 'libris'); 
    define ('DATASETS_PATH', ROOT . DIRECTORY_SEPARATOR . 'datasets');

    define ('FAMILY_PATH', LIBRARY_PATH . DIRECTORY_SEPARATOR . 'family');
    define ('ORDER_FAMILY_PATH', FAMILY_PATH . DIRECTORY_SEPARATOR  . 'order');
    define ('PERSONA_FAMILY_PATH', FAMILY_PATH . DIRECTORY_SEPARATOR . 'persona');

    # constants
    define ('ADDRESS_FIELD_COUNT', 5);
    
 /*   
    # dataset files
    define ('LAST_NAMES', DATASETS_PATH . DIRECTORY_SEPARATOR . 'last-names.txt');    
    define ('FIRST_NAMES', DATASETS_PATH . DIRECTORY_SEPARATOR . 'gendered-first-names.csv');
*/
?>