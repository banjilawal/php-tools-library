<?php
    namespace banji\util;
    require_once('../config.php');

    use \DateTime, \Exception;

    class Util {

        const WORD_PATTERN = '/[A-Z]{3,}/i';
        const DATE_PATTERN = '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/';

        public static function sanitize_input ($data) {
            
            if (isset($data) == false) {
                Throw new \Exception($data . ' Cannot process null data');
            }
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data; 

        } // close sanitize_input
    
    
        public static function print_date (\DateTime $date) {
    
            if (($date instanceof \DateTime) != 1) {
                throw new \Exception($date . ' is not a valid DateTime object');
            }
    
            $default = new \DateTime('0000-01-01');
    
            if (is_null($date) || $date == $default) {
                return '';
            }
            else {
                return $date->format('Y-m-d'); # hh:mm:s');
            }
    
        } // close print_date


        public static function string_to_date (String $dateString) {

            if (preg_match(self::DATE_PATTERN, $dateString) != 1) {
                throw new Exception($dateString . ' is not an ISO compliant date string');
            }

            return strtotime($dateString);

        } // close string_to_date
    
    
        public static function date_handler (\DateTime $date) {
    
            if (is_string($date)) {
                return new \DateTime($date);
            }
            else if ($date instanceof \DateTime) {
                return $date;
            }
            else {
                return new \DateTime('0000-01-01');
            }
            
        } // close date_handler

    } // end class Util
 ?>
