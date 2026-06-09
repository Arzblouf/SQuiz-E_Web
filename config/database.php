<?php

define('ENV', 'local');

if (ENV == 'local') {
    define ('DB_HOST', 'localhost');
    define ('DB_USER', 'root');
    define ('DB_PASS', 'groscaca');
    define ('DB_NAME', 'stadiumproject');
} else {
    define ('DB_HOST', '104.40.137.99:22260');
    define ('DB_USER', 'developer');
    define ('DB_PASS', 'cerfal1313');
    define ('DB_NAME', 'joshua_ppe');
}

?>