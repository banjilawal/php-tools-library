<?php
    # directory paths
    define ('ROOT_PATH',  __DIR__ );
    define ('BANJI_PATH',  __DIR__ .  DIRECTORY_SEPARATOR );

    define ('UTIL_PATH', BANJI_PATH . 'util' .  DIRECTORY_SEPARATOR);
    define ('LIBRARY_PATH', BANJI_PATH . 'libris' . DIRECTORY_SEPARATOR);
    define ('FAMILY_PATH', LIBRARY_PATH . 'family' .  DIRECTORY_SEPARATOR);
    define ('DATASETS_PATH', BANJI_PATH . 'datasets' .  DIRECTORY_SEPARATOR);
    
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