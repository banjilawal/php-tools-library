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
    require_once (SUPERMODEL_PATH . DIRECTORY_SEPARATOR . 'orderitem.php');

    use \Exception, DateTime;
    use \banji\supermodel\OrderItem;

    abstract class OrderItemBag {

        private $list = array ();

        # setters
        abstract public function add (Item $item);
        abstract public function remove (Item $item);

        # search & sort
        abstract public function search (String $keyword);
        abstract public function sort (String $category);

        # display methods
        public abstract function to_table ();

    } // end class OrderItemBag
?>