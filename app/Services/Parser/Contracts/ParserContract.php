<?php

namespace App\Services\Parser\Contracts;

/**
 * Interface ParserContract
 */
interface ParserContract
{
    /**
     * Create a new instance of builder
     *
     * @param array $items
     * @return mixed
     */
    public static function make(array $items = []);

    /**
     * Parse and Build collection
     *
     * @return mixed
     */
    public function parseAndBuildCollection();

    /**
     * @return mixed
     */
    public function toArray();

    /**
     * @return mixed
     */
    public function toJson();

    /**
     * @return mixed
     */
    public function count();
}