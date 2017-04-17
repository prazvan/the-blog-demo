<?php

namespace App\Repositories\Eloquent;

use App\Models\MetaData;

/**
 * Class MetaDataRepository
 * @package App\Repositories\Eloquent
 */
final class MetaDataRepository extends EloquentRepository
{
    /**
     * @param $external_id
     * @return mixed
     */
    public function getByExternalId($external_id)
    {
        return $this->cacheQuery('meta_data_' . $external_id, function () use ($external_id) {
            return MetaData::where('external_id', $external_id)->firstOrFail();
        });
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function newMetaData(array $attributes = [])
    {
        return (new MetaData)->fill($attributes)->save();
    }
}