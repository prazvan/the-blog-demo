<?php

namespace App\Transformers\v1;

use App\Models\Status;
use League\Fractal\TransformerAbstract;

/**
 * Class StatusTransformer
 * @package App\Transformers\v1
 */
class StatusTransformer extends TransformerAbstract
{
    /**
     * @param $status
     *
     * @return array
     */
    public function transform(Status $status)
    {
        return [
            'id'          => $status->id,
            'name'        => $status->name,
            'description' => $status->description,
        ];
    }
}
