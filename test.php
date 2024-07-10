<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;


$value = "test";



$val = v::alnum()->noWhitespace()->length(1,4);
echo $val->validate($value);