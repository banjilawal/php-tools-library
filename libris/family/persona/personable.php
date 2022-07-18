<?php
    namespace Banji\Libris\Family\Persona;

    require_once('../../../config.php');
    
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'util.php');

    require_once(PERSONA_FAMILY_PATH . DIRECTORY_SEPARATOR . 'phone.php');
    require_once(PERSONA_FAMILY_PATH . DIRECTORY_SEPARATOR . 'postalAddress.php');

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
 
    } // end interface Personable
?>