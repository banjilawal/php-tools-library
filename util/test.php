<?php declare(strict_types=1);
    namespace banji\Util;

    require_once('../config.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'random.php');

    require_once(PERSONA_FAMILY_PATH . DIRECTORY_SEPARATOR . 'postalAddress.php');
    require_once(PERSONA_FAMILY_PATH . DIRECTORY_SEPARATOR . 'phone.php');

    use \Exception, \DateTime;
    use \banji\util\{Util, Random}; 
    use \banji\libris\family\persona\{Phone, PostalAddress};

    # tests
    //$length = rand(1,12);

    echo 'firstname: ' . Random::name('firstname') . ' lastname: ' . Random::name('lastname') . '<br>';
    echo 'postal address: ' . PostalAddress::random() . '<br>';
 /*   
    echo '<p>' . $length . '-long numeric string: ' . Random::numeric('ambiguous', $length) . '<br>';

    $length = rand(1,12);
    echo $length . '-long alphabetic string: ' . Random::alphabetic('ambiguous', $length) . '</p>';   
*/
    echo 'phone: ' . Phone::random();

?>