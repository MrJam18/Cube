<?php

namespace app\models\Traits;


trait USTimestampsTrait
{
    function getUSCreatedAt(): string
    {
        return (new \DateTime($this->created_at))->format('d M Y');
    }
    function getUSUpdatedAt(): string
    {
        return (new \DateTime($this->updated_at))->format('d M Y');
    }

}