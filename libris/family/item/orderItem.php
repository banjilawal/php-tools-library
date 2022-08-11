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

    abstract class OrderItem {

        private Item $item;
        private Int $quantity;

        # setters
        abstract public function item (Item $item);
        abstract public function increase (Int $amount);
        abstract public function decrease (Int $amount);

    } // end class Item
?>