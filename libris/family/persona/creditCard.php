<?php
    namespace banji\libris\family\persona;

    require_once('../../../config.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'util.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'random.php');

    use \Exception, \DateTime;
    use \banji\util\{Util, Random}; 

    
    class CreditCard {
        const CVN_PATTERN = '/[0-9]{3,4}/';
        const ID_PATTERN = '/([0-9]{3,}-){2,}/i';

        const STATES = array('chargable', 'expired', 'declined');

        private String $id;
        private String $cvn; 
        private String $status;

        private DateTime $expiration;

        # constructors and builders
        public function __construct () {

            $this->id = '';
            $this->cvn = '';
            $this->expiration = null;
            
        }  // close construct
        

        public static function build (String $id, DateTime $expiration, String $cvn)   {

            $card = new CreditCard ();

            $card->expiration($expiration);
            $card->status('chargable');
            $card->cvn($cvn);
            $card->id($id);

            return $card;

        } // close build

        
        # setters
        public function expiration (DateTime $date) {

            $this->expiration = $date;

        } // close expiration


        public function id (String $id) { 

           if (preg_match(self::ID_PATTERN, $id) != 1) {
                throw new Exception($id . ' is not a valid credit card number');
            }

            $this->number = $id; 

        } // close id


        public function cvn (String $var) {

            if (preg_match(self::CVN_PATTERN, $var) != 1) {
                throw new Exception($var . ' is not a valid CVN');
            }

            $this->cvn = $var; 

        } // close cvn


        public function status (String $status) {
            if (in_array($status, self::STATES, $strict = true) == false) {
                throw new Exception($status . ' is not a valid card status');
            }

            $this->status = $status;

        } // close status


        # display methods
        public function __toString() {

            $text = '[**-' . $this->print_id() 
                . ' '. $this->date_string()
                . ' ' . $this->cvn . ']';

            return $text;

        } // close toString


        public function to_row () {

            $elem = '<tr id="' . $this->id . '" onclick="send_card(this)">'
                . '<td hidden>' . $this->id . '</td>'
                . '<td>**-' . $this->print_id() . '</td>'
                . '<td>' .  $this->date_string() .'</td>'
                . '<td>' . $this->cvn . '</td>'                
                . '</tr>';

            return $elem;  

        }   // close to_row


        public function to_table () {

            $elem = '<table class="card-table">'
                . '<tr>'
                . '<td>**-' . $this->print_id() . '</td>'
                . '<td>' .  $this->date_string() .'</td>'
                . '<td>' . $this->cvn . '</td>'                
                . '</tr>'     
                . '</table>';

            return $elem;

        } // close to_table

        #helpers
        public function print_id () {
            $blocks = explode('-', $this->number); 
            $length = sizeof($blocks);

            return $blocks[$length - 1];

        } // close print_id


        private function date_string () {
            return $this->expiration->format('m') . '/' . $this->expiration->format('y');

        } //close date_string
        

        // getters
        public function get_cvn () { return $this->cvn; }
        public function get_id () { return $this->id; }
        public function get_status () { return $this->status; }
        public function get_expiration () { return $this->expiration; }

        # statics 
        public static function random () {

        } // close random

    } // end CreditCard class    
?>