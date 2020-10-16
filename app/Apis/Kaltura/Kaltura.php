<?php

namespace App\Apis\Kaltura;

use Kaltura\Client\Client;
use Kaltura\Client\Configuration;

class Kaltura
{
    private $client;

    public function __construct()
    {
        $this->initClient();
    }

    public function getClient() {
        return $this->client;
    }

    private function initClient() {
        $config = new Configuration();
        $this->client = new Client($config);
    }

    protected function setKS($ks) {
        $this->client->setKS($ks);
    }

    public function loginByLoginId($loginId, $password)
    {
        return $this->getClient()->getUserService()->loginByLoginId($loginId, $password);
    }
}
