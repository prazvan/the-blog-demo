<?php

namespace App\Services\Parser;

use Illuminate\Support\Collection;

/**
 * Class Parser
 * @package App\Services\Parser
 */
abstract class Parser
{
    /**
     * @var array|static
     */
    private $items = [];

    /**
     * @var Collection $collection
     */
    protected $collection;

    /**
     * Parser constructor.
     * @param $items
     */
    public function __construct($items)
    {
        $this->items = Collection::make($items);
    }

    /**
     * Parse and Build Collection
     *
     * @return $this
     */
    public function parseAndBuildCollection()
    {
        $this->collection = $this->parse($this->items);

        return $this;
    }

    /**
     * @return Collections
     */
    abstract public function getCollection();

    /**
     * @return array
     */
    public function toArray()
    {
        return (array) $this->getCollection()->toArray();
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return (string) $this->getCollection()->toJson();
    }

    /**
     * @return int
     */
    public function count()
    {
        return (int) $this->getCollection()->count();
    }

}