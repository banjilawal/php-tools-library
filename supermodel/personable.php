<?php
    namespace banji\supermodel;

    function find_config_path () {

        $root = '';
        $abs_path = explode('/', $_SERVER['DOCUMENT_ROOT']);
        $project_home = explode('/', $_SERVER['REQUEST_URI'])[1];

        foreach ($abs_path as $dir) {
            $root .= $dir . DIRECTORY_SEPARATOR;
        }
    
        $root = trim($root, DIRECTORY_SEPARATOR);
        return $root . DIRECTORY_SEPARATOR . $project_home . DIRECTORY_SEPARATOR . 'config.php';

    } // close find_config_path
    
    $config_path = find_config_path();
    require_once($config_path);  

    //require_once('../../../config.php');
    
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'util.php');

    require_once(SUPERMODEL_PATH . DIRECTORY_SEPARATOR . 'phone.php');
    require_once(SUPERMODEL_PATH . DIRECTORY_SEPARATOR . 'postalAddress.php');

    use \banji\util\Util; 
    use \Exception, \DateTime;
    use \banji\libris\family\persona\{Phone, PostalAddress};

    interface Personable {

        public function firstname (String $name);
        public function lastname (String $name);

        public function phone (Phone $phone);
        public function email (String $email);
        public function birthdate (DateTime $birthdate);
        public function address (PostalAddress $address);

        public function get_firstname ();
        public function get_lastname ();
        public function get_phone ();
        public function get_email ();
        public function get_address (); 
        public function get_birthdate ();  

        public function to_row ();
        public function to_table ();
 
    } // end interface Personable
?>