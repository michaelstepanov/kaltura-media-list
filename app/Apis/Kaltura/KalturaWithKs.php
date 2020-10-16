<?php

namespace App\Apis\Kaltura;

class KalturaWithKs extends Kaltura
{
    public function __construct($ks)
    {
        parent::__construct();
        $this->setKs($ks);
    }
}
