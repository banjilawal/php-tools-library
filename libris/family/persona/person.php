<?php
    namespace banji\libris\family\persona;

    require_once('../../../config.php');
    
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'util.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'random.php');

    require_once(PERSONA_FAMILY_PATH . DIRECTORY_SEPARATOR . 'phone.php');
    require_once(PERSONA_FAMILY_PATH . DIRECTORY_SEPARATOR . 'postalAddress.php');

    use \Exception, \DateTime;
    use \banji\util\{Util, Random}; 
    use \banji\libris\family\persona\{Phone, PostalAddress};


    abstract class Person {
        const FIRST_NAME_PATTERN =  '/[A-Z]{2,}/i';
        const LAST_NAME_PATTERN = '/([A-Z]{3,}|[A-Z]{3,}\s[A-Z]{3,})/i';

        private String $id;
        private String $firstname;
        private String $lastname;
        private String $email;

        private Phone $phone;
        private DateTime $birthdate;

        private PostalAddress $address;

        # constructors and builders
        public function __construct () {

            $this->id = '';
            $this->firstname = '';
            $this->lastname = '';
            $this->email = '';
            $this->phone = null;
            $this->birthdate = null;
            $this->address = null;
            
        } // close construct

        abstract public function build(String $str);


        #abstracts
        abstract function id (String $id);


        #setters
        public function phone (Phone $phone) {     
            $this->phone = $phone; 

        } // close phone


        public function address (PostalAddress $address) { 
            $this->address = $address; 

        } // close address


        public function firstname (String $name) { 
            if (preg_match(self::FIRST_NAME_PATTERN, $name) != 1) {
                throw new Exception($name . " does not fit the pattern for first names");
            } 

            $this->firstname = $name;

        } // close firstname


        public function lastname (String $name) { 
            if (preg_match(self::LAST_NAME_PATTERN, $name) != 1) {
                throw new Exception($name . " does not fit the pattern for last names");
            } 

            $this->lastname = $name;

        } // close lastname


        public function email (String $email) { 

            $this->email = $email;

        } // close email


        public function birthdate (DateTime $birthdate) {
            $this->birthdate = $birthdate;

        } // close birthdate


        # display methods
        public function to_row () {

            $elem = '<tr id="' . $this->id .  '" onclick="send_customer(this)">'
                    . '<td>' . $this->id . '</td>'
                    . '<td>' . $this->firstname . '</td>'
                    . '<td>' . $this->lastname. '</td>'
                    . '<td>' . $this->birthdate->format('Y-m-d') . '</td>'
                    . '<td>' . $this->phone . '</td>'
                    . '<td>' . $this->email . '</td>'
                    . '<td>' . $this->address->get_street() . '</td>' 
                    . '<td>' . $this->address->get_city() . '</td>'    
                    . '<td>' . $this->address->get_state() . '</td>' 
                    . '<td>' . $this->address->get_zip() . '</td>'
                . '</tr>';

            return $elem; 

        } // close to_row


        public function to_table () {
            $elem = '<table class="customer-table">'
                        . '<thead class="customer-table-head>'
                            . '<tr class="customer-table-header-row">'
                                .  '<th>ID</th>'
                                .  '<th>First Name</th>'
                                .  '<th>Last Name</th>'
                                .  '<th>Birthdate</th>'
                                .  '<th>Phone</th>'
                                .  '<th>Email</th>'
                                .   '<th>Street</th>'
                                .   '<th>City</th>'
                                .   '<th>State</th>'
                                .   '<th>Zip</th>'
                            .   '</tr>'
                        . '</thead>'
                        . '<tbody>'
                            . '<tr>'
                                . '<td>' . $this->id . '</>'
                                . '<td>' . $this->firstname . '</td>'
                                . '<td>' . $this->lastname. '</td>'
                                . '<td>' . Util::print_date($this->birthdate) . '</td>'
                                . '<td>' . $this->phone . '</td>'
                                . '<td>' . $this->email . '</td>'
                                . '<td>' . $this->address->get_street() . '</td>'
                                . '<td>' . $this->address->get_city() . '</td>'
                                . '<td>' . $this->address->get_state() . '</td>'
                                . '<td>' . $this->address->get_zip() . '</td>'
                            . '</tr>'
                            . '</tbody>'
                    . '</table>';

        } // close to_table


        public function __toString() {   

            $string = 'id: ' .$this->id . '<br>' . PHP_EOL
                . 'firstname: ' . $this->firstname . '<br>' . PHP_EOL   
                . 'lastname: ' . $this->lastname . '<br>' . PHP_EOL
                . 'birthdate: ' . Util::print_date($this->birthdate) . '<br>' . PHP_EOL
                . 'phone: ' . $this->phone . '<br>' . PHP_EOL
                . 'email: ' . $this->email . '<br>' . PHP_EOL
                . 'address: ' . $this->address . '<br>' . PHP_EOL;

           return $string;     

        } // close toString

        // getters
        public function get_firstname () { return $this->firstname; }
        public function get_lastname () { return $this->lastname; }
        public function get_phone () { return $this->phone; }
        public function get_email () { return $this->email; }
        public function get_address () { return $this->address; }  
        public function get_birthdate () { return $this->birthdate; }   
        public function get_id () { return $this->id; }     

        # statics 
        public static function random () {

        } // close random
 
    } // end class Person
?>