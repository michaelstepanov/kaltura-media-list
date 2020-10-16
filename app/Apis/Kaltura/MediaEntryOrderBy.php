<?php

namespace App\Apis\Kaltura;

use Kaltura\Client\Enum\MediaEntryOrderBy as KalturaMediaEntryOrderBy;

class MediaEntryOrderBy extends KalturaMediaEntryOrderBy
{
    public static function inverse($orderBy)
    {
        $newSign = ($orderBy[0] === '-') ? '+' : '-';
        $field = substr($orderBy, 1);

        return $newSign.$field;
    }
}
