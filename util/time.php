<?php declare(strict_types=1);
    namespace banji\Util;

    require_once('../config.php');

    use \DateTime, \Exception;

    //    require_once(LAST_NAMES);
    //    include_once(DATASETS_PATH . DIRECTORY_SEPARATOR . 'gendered-first-names.csv');

    class Time {

        const EPOCH = -3600;

        const MIN_SECONDS = 0;
        const MAX_SECONDS = 86400;
        const TIME_PATTERN = '/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/';

        #const TIMESTAMP_FOR_MIDNIGHT = strtotime(self::ZERO_HOUR_STRING);

        private String $militaryTime;
        private int $unixTime;


        public function __construct() {

            $this->unixTime = -3600;       
            $this->militaryTime = date('H:i:s', 0);
            
        } // close constructor


        public static function fromString (String $string) {
            
            $time = new Time();
            $time->setTime($string);

            return $time;
            
        } // close fromString


        public static function fromInt  (int $timestamp) {

            $time = new Time();
            $time->unixTime($timestamp);

            return $time;

        } // close fromInt


        public function setTime (String $time) {

 //           if (preg_match(self::TIME_PATTERN, $time) != 1) {
 //               throw new Exception($time . ' is not in correctly formatted 24 hour time');
 //           }

            $this->militaryTime = $time;
            $this->unixTime = strtotime($time);

        } // close setDate


        public function unixTime (int $timestamp) {

 //           if ($timestamp > 0 || $timestamp > self::MAX_SECONDS) {
 //               throw new Exception($timestamp . ' is outside the range of seconds in 24 hours');
 //           }

            $this->unixTime = $timestamp;
            $this->militaryTime = date('H:i:s', $timestamp);

        } // close setUnixTime


        public function getUnixTime () {

            return $this->unixTime;

        } // close getUnixTime


        public function getSeconds () {

            return $this->unixTime - self::EPOCH;

        } // close getUnixTime


        public function getTime () {

            return $this->militaryTime;

        } // close getIsoDate


        public function __toString() {

             return '[seconds: ' . $this->unixTime . ', Time: ' . $this->militaryTime . ']';

        } // close toString


        public static function random (String $floor, String $ceiling) {

            $startTime = Time::fromString($floor);
            $endTime = Time::fromString($ceiling);

            $min = $startTime->getUnixTime();
            $max = $endTime->getUnixTime();

            $randSeconds = (int) ((rand(0, 9999)/10000.00) * ($max - $min)) + $min;

            return Time::fromInt($randSeconds);

        } // close random


    } // end class Date String
?>