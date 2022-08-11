<?php declare(strict_types=1);
    namespace banji\libris\family\persona;

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
    
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'util.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'time.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'random.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'StreamDate.php');

    require_once(PERSONA_FAMILY_PATH . DIRECTORY_SEPARATOR . 'phone.php');
    require_once(PERSONA_FAMILY_PATH . DIRECTORY_SEPARATOR . 'postalAddress.php');

    use \Exception, \DateTime;
    use \banji\util\{Util, StreamDate, Random}; 
    use \banji\libris\family\persona\{Phone, PostalAddress};


    class Person {

        const FIRST_NAME_PATTERN =  '/[A-Z]{2,}/i';
        const LAST_NAME_PATTERN = '/([A-Z]{3,}|[A-Z]{3,}\s[A-Z]{3,})/i';

        const MAX_DATE = '1919-01-01';

        private String $id;
        private String $firstname;
        private String $lastname;
        private String $email;

        private Phone $phone;
        private StreamDate $birthdate;

        private PostalAddress $address;

        # constructors and builders
        public function __construct () {

            $this->id = '';
            $this->firstname = '';
            $this->lastname = '';
            $this->email = '';
            $this->phone = new Phone();
            $this->birthdate = new StreamDate('0000-01-01');
            $this->address = new PostalAddress();
            
        } // close construct

        #abstract public function build(String $str);


        #abstracts
        #abstract function id (String $id);


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


        public function birthdate (String $birthdate) {

            $this->birthdate->isoDate($birthdate);

        } // close birthdate


        # display methods
        public function to_row () {

            $elem = '<tr id="' . $this->id .  '" onclick="send_customer(this)">'
                    . '<td>' . $this->id . '</td>'
                    . '<td>' . $this->firstname . '</td>'
                    . '<td>' . $this->lastname. '</td>'
                    . '<td>' . $this->birthdate->getDate() . '</td>'
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
                                . '<td>' . $this->birthdate->getDate() . '</td>'
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
                . 'birthdate: ' . $this->birthdate->getDate()  . '<br>' . PHP_EOL
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

            $person = new Person ();

            $current_date = date('Y-m-d');
            echo 'current date: ' . $current_date . '<br>';

            $birthDate = StreamDate::random(self::MAX_DATE, $current_date);
            $person->birthdate($birthDate->getDate());

            $person->firstname(Random::name('firstname'));
            $person->lastname(Random::name('lastname'));

            $person->phone(Phone::random());
            $person->address(PostalAddress::random());
            $person->email(Random::email($person->get_firstname(), $person->get_lastname()));

            return $person;

        } // close random
 
    } // end class Person
?>