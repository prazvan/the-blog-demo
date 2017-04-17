<?php

namespace App\Services\Aggregator;

use App\Services\Aggregator\Request\Request;
use App\Services\Parser\Builders\PostBuilder;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Aggregator
 *
 * We make the class final as we don't want to extend this :)
 *
 * @package App\Services\Aggregator
 */
final class Aggregator
{
    /**
     * Required params
     *
     * @var array
     */
    private $required_params = [
        'order'     => 'last',
        'include'   => 'fieldValues',
        'limit'     => 20
    ];

    /**
     * @return Collection
     * @throws \Exception
     */
    public function run()
    {
        try
        {
            $results = Request::make()->get(Request::POST_CHANNEL, $this->required_params);

            return PostBuilder::make(json_decode($results, true))
                ->parseAndBuildCollection()
                ->getCollection();
        }
        catch (\Exception $ex)
        {
            throw $ex;
        }
    }

}