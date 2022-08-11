<?php declare(strict_types=1);
    namespace banji\libris\family\persona;

    require_once('../../../config.php');
    
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'util.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'random.php');

    use \Exception, \DateTime;
    use \banji\util\{Util, Random}; 

    class Street {
        const ADDRESS_PATTERN = '/([0-9]|[a-z]){1}/';

        const UNIT_DESIGNATORS = array('apt', 'apartment', 'ste', 'suite', 'rm', 'room', 'fl', 'floor');

        const NAME_ADJECTIVES = array('ave', 'avenue', 'blvd', 'boulevard', 'ct', 'court', 'st', 'street', 'rt', 'route', 'pl', 'plaza', 
            'ln', 'lane', 'rd', 'road', 'hwy', 'highway', 'po box', 'p.o. box');
            
        const DIRECTIONS = array('n', 'north', 's', 'south', 'e', 'east', 'w', 'west', 'ne', 'nw', 'se', 'sw');    

        private String $number;
        private String $name;
        private String $direction;

        # constructors and builders
        public static function build (String $text) {
            $place = new Street ();

            $place->number = substr($text, (strpos($text,'(') + 1 ),  (strpos($text,')') - 1 ) );
            $place->name = substr($text, (strpos($text,' ') + 1 ),  (strpos($text,')') - 1 ) );
            $place->direction = substr($text, (strpos($text,'-') + 1 ) );

            return $place;           
        } // close build
       
        # setters
        public function number (String $number) {

            if (empty($number)) {
                $number = '';
            }

            $this->number = $number;

        } // close number
        
        public function name (String $name) {

            $this->name= $name;

        } // close name

        public function direction (String $direction) {

            if (in_array($direction, self::DIRECTIONS, $strict = true) == false) {
                throw new Exception($direction . " is not a well defined street direction");
            }

            $this->direction = $direction;

        } // close direction


        public function __toString () {
            return ($this->number . ' ' . $this->name . ' ' . $this->direction); 
        }
        
        # getters
        public function get_number () { return $this->number; }
        public function get_name () { return $this->name; }
        public function get_direction () { return $this->direction; }

        # statics 
        public static function random () {

        } // close random

    } // end class Street
?>