<?php declare(strict_types=1);
    namespace banji\Libris\Family\Item;

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
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'random');
    require_once (ITEM_FAMILY_PATH . DIRECTORY_SEPARATOR . 'itemable.php');

    use \Exception, DateTime;
    use \banji\Libris\Family\Item\Itemable;

    abstract class Item {

        private String $id;
        private String $name;
        private String $imagePath;
        private String $description;

        private float $price;

        # setters
        abstract public function id ();
        // {
            
        //} // close id


        abstract public function name (String $name); 
        //{

       // } // close name


        abstract public function description (String $text); // {

       // } // close description 


        abstract public function imagePath (String $path); //{

        //} // close imagePath


        abstract public function price (float $price); //{

        //} // close price


        # getters
        public function getID () {

            return $this->id;

        } // close getID
        

        public function getName () {

        } // close getName


        public function getDescription () {

            return $this->description;

        } // close getDescription


        public function getPrice () { 

            return $this->price;

        } // close getPrice


        public function getImagePath () {

            return $this->imagePath;

        } // close getImagePath


    } // end class Item
?>