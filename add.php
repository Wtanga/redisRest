<?php

require './vendor/autoload.php';


class add
{    
    private $params;    

    public function __construct(array $params)
    {
        $this->params = $params;
        $this->checkParams();
        $this->addKey();
    }

    private function addKey()
    {
        $redis = new Predis\Client();
        $redis->set($this->params['key'], $this->params['value']);
        $minutesExpire = 60;
        $redis->expire($this->params['key'], $minutesExpire * 60);
    }

    private function checkParams()
    {
        $this->ensureParamExists('key');
        $this->ensureParamExists('value');
    }

    private function ensureParamExists(string $paramName)
    {
        if (!isset($this->params[$paramName])) {
            print_r('Param with name "' . $paramName . '" is not set!');
            return;
        }
    }

}