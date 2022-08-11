<?php declare(strict_types=1);
    namespace banji\Util;

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


    use \DateTime, \Exception;

    class StreamDate {

        const DATE_PATTERN = '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/';

        private String $isoDate;
        private int $unixSeconds;

        public function __construct(String $date) {

            $this->isoDate = $date;
            $this->unixSeconds = strtotime($date);
            
        } // close constructor


        public static function build  (int $timestamp) {

            $date = date('Y-m-d', $timestamp);
            return new StreamDate($date);

        } // close fromInt


        public function isoDate (String $date) {

            if (preg_match(self::DATE_PATTERN, $date) != 1) {
                throw new Exception($date . ' is not an ISO compliant date string');
            }

            $this->isoDate = $date;
            $this->unixSeconds = strtotime($date);

        } // close setDate


        public function unixSeconds (int $timestamp) {

            $this->unixSeconds = $timestamp;
            $this->isoDate = date('Y-m-d', $timestamp);

        } // close setUnixTime


        public function getSeconds () {

            return $this->unixSeconds;

        } // close getUnixTime


        public function getDate () {

            return $this->isoDate;

        } // close getIsoDate


        public function __toString() {

             return '[unixSeconds: ' . $this->unixSeconds . ',  ISO Date: ' . $this->isoDate . ']';

        } // close toString


        public static function random (String $floor, String $ceiling) {

            $startDate = new StreamDate($floor);
            $endDate = new StreamDate($ceiling);

            $min = $startDate->getSeconds();
            $max = $endDate->getSeconds();
            $seconds = (int) ((rand(0, 9999)/10000.00) * ($max - $min)) + $min;

            return StreamDate::build($seconds);

        } // close random


    } // end class Date String
?>