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
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'random');

    use \Exception, DateTime;
    use \banji\supermodel\Itemable;

    abstract class Item {

        private String $id;
        private String $name;
        private String $imagePath;
        private String $description;

        private float $price;

        # setters
        abstract public function id ();
        abstract public function name (String $name); 
        abstract public function price (float $price);
        abstract public function imagePath (String $path);
        abstract public function description (String $text);

        # getters
        public function get_id () {

            return $this->id;

        } // close getID
        

        public function get_name () {

            return $this->name;

        } // close getName


        public function get_description () {

            return $this->description;

        } // close getDescription


        public function get_price () { 

            return $this->price;

        } // close getPrice


        public function get_picture () {

            return $this->imagePath;

        } // close getImagePath
                
        
        # display methods
        public abstract function to_row ();
        public abstract function to_table ();

    } // end class Item
?>