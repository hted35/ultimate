<?php
function hted35_ultimate_autoloader($class) {
    include __DIR__.'/../models/Country.php';
}
spl_autoload_register('hted35_ultimate_autoloader');
