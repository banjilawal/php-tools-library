<?php declare(strict_types=1);
    namespace banji\Util;

    require_once('../config.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'time.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'random.php');
    require_once(UTIL_PATH . DIRECTORY_SEPARATOR . 'streamDate.php');

    require_once(SUPERMODEL_PATH . DIRECTORY_SEPARATOR . 'postalAddress.php');
    require_once(SUPERMODEL_PATH  . DIRECTORY_SEPARATOR . 'phone.php');
    require_once(SUPERMODEL_PATH  . DIRECTORY_SEPARATOR . 'person.php');

    use \Exception, \DateTime;
    use \banji\util\{StreamDate, Util, Random, Time}; 
    use \banji\libris\family\persona\{Person, Phone, PostalAddress};

/*    
    $date = new StreamDate ();
    echo 'initial date: ' . $date . '<br>';

    $date->isoDate('2005-04-32');
    echo 'current date: ' . $date . '<br>';

    $date->unixSeconds(882913913);
    echo 'current date: ' . $date . '<br>';  

    $date2 = StreamDate::fromString('2016-07-28');
    echo '<br>StreamDate::fromString(2016-07-28)-->date 2: ' . $date2 . '<br>';

    $date3 = StreamDate::fromInt(353599030);
    echo 'StreamDate::fromInt(353599030)-->date 3: ' . $date3 . '<br>';

    echo '<br>Random date: ' . StreamDate::random('1981-03-16', '2016-07-28') . '<br>';
    echo 'Current Date: ' . date('Y-m-d') . ' datatype of date(Y-m-d) is ' . gettype(date('Y-m-d')) . '<br>';
*/

    $person = Person::random();
    echo '<p>person: ' . $person . '</p>';

/*  
    echo 'firstname: ' . Random::name('firstname') . ' lastname: ' . Random::name('lastname') . '<br>';
    echo 'postal address: ' . PostalAddress::random() . '<br>';
 
    echo '<p>' . $length . '-long numeric string: ' . Random::numeric('ambiguous', $length) . '<br>';

    $length = rand(1,12);
    echo $length . '-long alphabetic string: ' . Random::alphabetic('ambiguous', $length) . '</p>';

    $floor = 2.99;
    $ceiling = 9.99;
    echo 'random amount in range [' . $floor . ', ' . $ceiling . ']: ' . Random::amount($floor, $ceiling) . '<br>';

    $date = StreamDate::random('1981-01-01', '2000-01-01');
    echo $date->getDate() . ' ';
    echo 'Date: ' . $date . '<br>';

    $time = Time::random('08:00:00', '14:00:00');
    echo 'Time: ' . $time . '<br>'; 
 
    echo 'date: ' . date( "Y-m-d", strtotime( '2009-01-31' ) );

    $person = Person::random();
    echo '<p>person: ' . $person . '</p>';
  
    $floor = getDate(strtotime('2002-01-01'));
    $ceiling = new DateTime('2015-01-01');

    $d = new DateTime('2018-05-23');
    echo gettype($floor) . '<br>';

    #echo date('y-m-d', $floor) . ' ' . gettype(strtotime('2002-01-01'));

    #echo 'Date between ' . Util::print_date($floor) . ' and ' . Util::print_date($ceiling) . ' is ' . Util::print_date(Random::some_date($floor, $ceiling)) . '<br>';
*/
?>