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
    require_once (SUPERMODEL_PATH . DIRECTORY_SEPARATOR . 'item.php');

    use \Exception, DateTime;
    use \banji\supermodel\Item;

    abstract class OrderItem {

        private Item $item;
        private Int $quantity;

        # setters
        abstract public function item (Item $item);
        abstract public function increase (Int $amount);
        abstract public function decrease (Int $amount);
        abstract public function quantity (Int $quantity);


        # getters
        public function get_item () {

            return $this->item;

        } // close getItem


        public function get_quantity () {

            return $this->quantity;

        } // close getQuantity


        # display methods
        public abstract function to_row ();
        public abstract function to_table ();

    } // end class OrderItem
?>