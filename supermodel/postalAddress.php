<?php declare(strict_types=1);
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

    #require_once('/banji/config.php');

    #require_once('../../../../config.php');
    
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'util.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'random.php');

    use \Exception, \DateTime;
    use \banji\util\{Util, Random}; 

    class PostalAddress {
        const ZIP_CODE_PATTERN = '/[0-9]{5}/';

        const STREET_ADJECTIVES = array('ave', 'avenue', 'street', 'st', 'route', 'rt', 'plaza', 'pl','lane', 
            'ln', 'road', 'rd', 'highway', 'hwy', 'po box', 'p.o. box');
    
        const STATES = array('AL','AK','AZ','AR','CA','CO','CT','DE','FL','GA','HI','ID', 'IL','IN','IA',        
            'KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND',
            'OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY','AS','DC','FM',
            'GU','MH','MP','PW','PR','VI');

        private String $street;
        private String $city;
        private String $state;
        private String $zip; 
        
        # constructors and builders
/*    
        public function __constructor (String $street, String $city, String $state, String $zip) {

            $this->street($street);
            $this->city($city);
            $this->state($state);
            $this->zip($zip);

        } // close constructor
*/

        public static function build (String $string) {

            #echo 'PostalAddress::build(' . $string . ')<br>';

            $fields = explode(',', $string);
          
            #print_r($fields);

  
            if (count($fields) != ADDRESS_FIELD_COUNT) {
                $errorMessage = 'the ' . count($fields) . ' field length string differs from the expected number of postal address elements';
                throw new Exception($errorMessage);
            }

            $postalAddress = new PostalAddress();

            $postalAddress->street($fields[0] . ' ' . $fields[1]);
            $postalAddress->city($fields[2]);
            $postalAddress->state($fields[3]);
            $postalAddress->zip($fields[4]);

            return $postalAddress;

        } // close build
        

        # setters
        public function street (String $street) {

            if (empty($street)) {
                $street = '';
            }

            $this->street = $street;

        } // close street
        

        public function city (String $city) {

            if (empty($city)) {
                $street = '';
            }

            $this->city = $city;

        } // close city


        public function state (String $state) {
/*
            if (in_array($state, self::STATES, $strict = true) == false) {
                throw new Exception($state . " is not a valid state acronym");
            }
*/
            $this->state = $state;

        } // close state
        

        public function zip (String $zip) {

            if (preg_match(self::ZIP_CODE_PATTERN, $zip) != 1) {
                throw new Exception ($zip . " is not a valid zip code");
            }

            $this->zip = $zip;

        }  // close zip


        # display methods
        public function __toString () {
            return ($this->street . ' ' . $this->city . ', ' . $this->state . ' ' . $this->zip); 
        }
        // close toString


        public function to_row () {

            $elem = '<tr>'
                    . '<td class="field-name">Street</td>'
                    . '<td>' . $this->street . '</td>'
                    . '<td class=field-name">City</td>'
                    . '<td>' . $this->city . '</td>'
                    . '<td class="field-name">State</td>'
                    . '<td>' . $this->state . '</td>'
                    . '<td class="field-name">Zip Code</td>'
                    . '<td>' . $this->zip . '</td>'
                . '</tr>';

            return $elem;     
        }
        // close to_row


        public function to_table () {

            $elem = '<table class="address-table">'
                . '<thead class="address-table-head>'
                    . '<tr class="address-table-header-row">'
                        .   '<th>Street</th>'
                        .   '<th>City</th>'
                        .   '<th>State</th>'
                        .   '<th>Zip</th>'
                    .   '</tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr>'
                        . '<td>' . $this->street . '</td>'
                        . '<td>' . $this->city . '</td>'
                        . '<td>' . $this->state . '</td>'
                        . '<td>' . $this->zip . '</td>'
                    . '</tr>'
                . '</tbody>'
            . '</table>';

            return $elem; 
        }
        // close to_table

        
        # getters
        public function get_street () { return $this->street; }
        public function get_city () { return $this->city; }
        public function get_state () { return $this->state; }
        public function get_zip () { return $this->zip; }


        # statics 
        public static function random () {

            return PostalAddress::build(Random::address());

        } // close random

    } // end class PostalAddress
?>