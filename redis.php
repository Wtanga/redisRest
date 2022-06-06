<?php
unset($argv[0]);

require './vendor/autoload.php';

$className = array_shift($argv);

require_once __DIR__ . '\\' . $className . '.php';

$params = [];

$params['key'] = $argv[0];
if(isset($argv[1]))
{
    $params['value'] = $argv[1];
}

$class = new $className($params);
