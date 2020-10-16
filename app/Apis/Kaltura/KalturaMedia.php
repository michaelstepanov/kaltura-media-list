<?php

namespace App\Apis\Kaltura;

class KalturaMedia extends KalturaWithKs
{
    public function list($filter, $pager)
    {
        return $this->getClient()->getMediaService()->listAction($filter, $pager);
    }

    public function delete($id)
    {
        return $this->getClient()->getMediaService()->delete($id);
    }
}
