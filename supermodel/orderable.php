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

    interface Orderable {

        public function add_orderItem(OrderItem $orderItem);
        public function remove_orderItem (OrderItem $orderItem);
        public function picture (String $path);
        public function description (String $text);

        public function get_tax ();
        public function get_subtotal ();
        public function get_total ();

    } // end interface Itemable
?>