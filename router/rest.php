<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

function route($method, $urlData) {
    $redis = new Predis\Client();
    
    if ($method === 'GET' && count($urlData) === 1) 
    {        
        $key = $urlData[0];       

        echo json_encode(array(
            'status' => 'true',
            'code'   => 200,
            'data'   => array(
                $key => $redis->get($key)),                         
        ));

        return;
    }

    if ($method === 'GET' && count($urlData) === 0) 
    {
        $datas = $redis->keys('*');                    
        foreach($datas as $data){                        
            $keys[$data] = $redis->get($data);
        }
        
        echo json_encode(array(
            'status' => 'true',
            'code'   => 200,
            'data'   => $keys
        ));
        return ;
    }

    if ($method === 'DELETE' && count($urlData) === 1) {
            
        $key = $urlData[0];       
        $redis->del($key);
                
        echo json_encode(array(
            'status' => 'true',
            'code'   => 200,
            'data'   => array()
        ));
        
        return;
    }


    // Возвращаем ошибку    
    echo json_encode(array(
        'status' => 'false',
        'code'   => '500',
        'data'   => array(
            'message' => 'Error info message'
            )            
    ));

} 
