<?php

require './vendor/autoload.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/router/rest.php';



function getFormData($method) 
{

    //GET
    if ($method === 'GET') return $_GET;

    //DELETE
    $data = array();
    $exploded = explode('&', file_get_contents('php://input'));

    foreach($exploded as $pair) 
    {
        $item = explode('=', $pair);
        if (count($item) == 2) {
            $data[urldecode($item[0])] = urldecode($item[1]);
        }
    }

    return $data;
}

$method = $_SERVER['REQUEST_METHOD'];

$formData = getFormData($method);


// Разбираем url
$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);

$router = $urls[0];
$urlData = array_slice($urls, 1);

if($router != "")
{    
    route($method, $urlData);    
}

if(!isset($formDatа))
{
    $redis = new Predis\Client();
    $datas = $redis->keys('*');                    
        foreach($datas as $data){                        
            $keys[$data] = $redis->get($data);
        }
    
    echo "<!DOCTYPE html>
    <html>
        <head>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
        </head>
        <body>
            <ul class='list-group list-group-flush'>";

    foreach($keys as $key => $value){
        echo "<li class='list-group-item'>{$key}: {$value} <a href='#' class='remove'>delete</a></li>";
    }

    echo 
    '       </ul>
        </body>
    </html>';
}


