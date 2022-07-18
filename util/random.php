<?php declare(strict_types=1);
    namespace banji\Util;

    require_once('../config.php');

//    require_once(LAST_NAMES);
//    include_once(DATASETS_PATH . DIRECTORY_SEPARATOR . 'gendered-first-names.csv');

    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'util.php');

    use \banji\util\Util; 
    use \Exception, \DateTime, \Throw;
    ;

    class Random {

        const LAST_NAMES = DATASETS_PATH . DIRECTORY_SEPARATOR . 'last-names.txt';
        const FIRST_NAMES = DATASETS_PATH . DIRECTORY_SEPARATOR . 'gendered-first-names.csv';
        const ADDRESSES = DATASETS_PATH . DIRECTORY_SEPARATOR . 'addresses.csv';

        const ALL_LETTERS = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','P','O','Q','R','S','T','U','V','W','X','Y','Z');
        const UNAMBIGOUS_LETTERS = array('A','B','C','D','E','F','G','H','J','K','M','N','P','Q','R','S','T','U','V','W','X','Y','Z');

        const NAME_CATEGORIES = array('firstname', 'lastname');


        private static function line_reader (String $source) {
 
            $lines = file($source);
            $row = rand(1, count($lines) - 1);

            return $lines[$row];

        } // close line_reader

        public static function name (String $category) {

            if (in_array($category, self::NAME_CATEGORIES, $strict = true) == false) {
                throw new Exception($category . ' is not a valid name category');
            }

            switch ($category) {
                case 'firstname':
                    $line = self::line_reader(self::FIRST_NAMES);
                    $fields = explode(',', $line);
                    $name = $fields[0];
                    break;
                    
                case 'lastname':
                    $name = Random::line_reader(self::LAST_NAMES);
                    break;    
                
                default:
                    break;
            }

            if (is_null($name) or strlen($name) == 0) {
                throw new Exception('The name is an empty string');
            }

            return $name;

        } // close name


        public static function word () {

        } // close word


        public static function address () {

            $line = Random::line_reader(self::ADDRESSES);

            $array = explode(',', $line);
            $fields = [];

            foreach ($array as $item) { 
                $fields[] = Util::sanitize_input(trim($item, '\'')); 
            }

            $address = $fields[2] . ', ' . $fields[3] . ', ' . $fields[4] . ', MN, ' . $fields[5];
            return $address;

        } // close address


        public static function numeric (String $category = 'ambiguous', int $length) {

            if (in_array($category, ['ambiguous', 'unambiguous'], $strict = true) == false) {
                throw new Exception($category . ' is outside the range of values of $ambiguity parameter');
            }

            if ($length < 1) {
                throw new Exception('Desired string length of ' . $length . ' is outside the acceptable range');                
            }

            $string = '';

            for ($index = 0; $index < $length ; $index++) {

                if ($category == 'ambiguous') {
                    $string .= rand(0, 9);
                }
                else {
                    $string .= rand(2,9);
                }
            }

            return $string;

        } // close numeric

        private static function alphabetic_string_handler (array $letters, int $length) {

            $string = '';

            for ($index = 0; $index < $length ; $index++) {
                $key = array_rand($letters, 1);
                $string .= $letters[$key];
            }

            return $string;

        } // close alphabetic_string_handler


        public static function alphabetic (String $category = 'unambiguous', int $length) {

            if (in_array($category, ['ambiguous', 'unambiguous'], $strict = true) == false) {
                throw new Exception($category . ' is outside the range of values of $ambiguity parameter');
            }

            if ($length < 1) {
                throw new Exception('Desired string length of ' . $length . ' is outside the acceptable range');                
            }

            if ($category == 'ambiguous') {
                $string = Random::alphabetic_string_handler(self::ALL_LETTERS, $length);
            }
            else {
                $string = Random::alphabetic_string_handler(self::UNAMBIGOUS_LETTERS, $length);
            }

            return $string;

        } // close alphabetic


        public static function amount (float $floor, float $ceiling) {

        } // close amount


        public static function some_time (DateTime $seed) {

        } // close some_time


        public static function some_date (DateTime $seed) {

        } // close some_time


        public static function some_date_time (DateTime $seed) {

        } // close some_time


        public static function picture (String $path) {

        } // close picture

    }  // end class Random
?>