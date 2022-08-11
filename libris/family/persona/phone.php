<?php declare(strict_types=1);
    namespace Banji\Libris\Family\Persona;

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
    
    #require_once('../../../config.php');
    
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'util.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'random.php');

    use \Exception;
    use \banji\util\{Util, Random}; 


    class Phone {
        const AREA_CODE_PATTERN = '/([0-9]{3}|\([0-9]{3}\))/';
        const EXCHANGE_PATTERN = '/[0-9]{3}/';
        const NUMBER_PATTERN = '/[0-9]{4}/';

        private String $areaCode;
        private String $exchange;
        private String $number; 
        
        # constructors and builders
        public static function build (String $areaCode, String $exchange, String $number) {

            $phone = new Phone ();

            $phone->area_code($areaCode);
            $phone->exchange($exchange);
            $phone->number($number);

            return $phone;

        } // close constructor


        public static function from_string (String $text) {

            $areaCode = substr($text, (strpos($text,'(') + 1 ),  (strpos($text,')') - 1 ) );
            $exchange = substr($text, (strpos($text,' ') + 1 ),  (strpos($text,')') - 1 ) );
            $number = substr($text, (strpos($text,'-') + 1 ) );

            $phone = new Phone ();
            $phone->area_code($areaCode);
            $phone->exchange($exchange);
            $phone->number($number);

            return $phone;

        } // close build


        # setters
        public function area_code (String $areaCode) { 

            if (preg_match(self::EXCHANGE_PATTERN, $areaCode) != 1) {
                throw new Exception($areaCode . " is not a correctly formatted area code");    
            }
            $this->areaCode = $areaCode;   

        } // close area_code


        public function exchange (String $exchange) { 

            if (preg_match(self::EXCHANGE_PATTERN, $exchange) != 1) {
                throw new Exception("not a valid phone exchange", 1);   
            }

            $this->exchange = $exchange;   

        } // close exchange

        public function number (String $number) { 

            if (preg_match(self::NUMBER_PATTERN, $number) != 1) {
                throw new Exception("not a valid extension", 1);    
            }

            $this->number = $number;

        } // close number

        public function __toString () {
            return '(' . $this->areaCode . ') ' . $this->exchange . '-' . $this->number; 
        }

        # getters
        public function get_area_code () { return $this->areaCode; }
        public function get_exchange () { return $this->exchange; }
        public function get_number () { return $this->number; }

        # statics 
        public static function random () {

            $phone = new Phone();

            $phone->area_code(Random::numeric('ambiguous', 3));
            $phone->exchange(Random::numeric('ambiguous', 3));
            $phone->number(Random::numeric('ambiguous', 4));

            return $phone;

        } // close random

    } // end class Phone
?>