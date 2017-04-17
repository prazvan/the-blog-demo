<?php

namespace App\Transformers\v1;

use App\Models\MetaData;
use League\Fractal\TransformerAbstract;

/**
 * Class MetaDataTransformer
 * @package App\Transformers\v1
 */
class MetaDataTransformer extends TransformerAbstract
{
    /**
     * @param MetaData $MetaData
     * @return array
     */
    public function transform(MetaData $MetaData)
    {
        return $MetaData->toArray();

        // or we can do this
//        return [
//            'id'          => $MetaData->id,
//            'external_id' => $MetaData->external_id,
//            'attributes'  => json_decode($MetaData->value)
//        ];
    }
}
