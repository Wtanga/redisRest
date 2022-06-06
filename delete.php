<?php

require './vendor/autoload.php';

class delete
{
    private $params;

    public function __construct(array $params)
    {
        $this->params = $params;
        $this->checkParams();
        $this->deleteKey();
    }

    private function deleteKey()
    {
        $redis = new Predis\Client();
        $redis->del($this->params['key']);     
    }

    private function checkParams()
    {
        $this->ensureParamExists('key');
    }

    private function ensureParamExists(string $paramName)
    {
        if (!isset($this->params[$paramName])) {
            print_r('Key is not set!');
            return;
        }
    }

}