<?php

namespace App\Services\Aggregator\Request;

use App\Exceptions\ChannelNotFoundException;
use App\Exceptions\NotFoundException;

use GuzzleHttp\Client;

/**
 * Class Request
 * We make the class final as we don't want to extend this :)
 */
final class Request
{
    /**
     * constants with channels
     */
    const POST_CHANNEL = 'posts';

    /**
     * Singleton
     *
     * @var self
     */
    private static $instance = null;

    /**
     * Make constructor private for singleton design pattern.
     *
     * Request constructor.
     */
    private function __construct(){}

    /**
     * Create new instance statically
     *
     * @return Request
     */
    public static function make()
    {
        if (!self::$instance) self::$instance = new self;

        return self::$instance;
    }

    /**
     * make a get request
     *
     * @param string $channel
     * @param array $query_string
     * @return string
     */
    public function get($channel = self::POST_CHANNEL, array $query_string = [])
    {
        // Send a request to the api
        return (new Client)->get($this->buildApiUrl($channel, $query_string), [
            'headers' => [
                'content-type' => 'application/json',
            ],
        ])->getBody()->getContents();
    }

    /**
     * Build API Url
     *
     * @param string $channel
     * @param array $query_string
     * @return string
     * @throws ChannelNotFoundException
     * @throws NotFoundException
     */
    private function buildApiUrl($channel, array $query_string)
    {
        // get api config
        $api_config = config('services.brndwgn');

        // service missing
        if (!$api_config) throw new NotFoundException;

        // channel missing throw exception
        if (!isset($api_config['channel_ids'][$channel])) throw new ChannelNotFoundException;

        // url & query string
        $url = $api_config['api_domain'].'/channels/'.$api_config['channel_ids'][$channel].'/entries';
        $query_string = http_build_query($query_string);

        return (string) (!empty($query_string) ? $url."?".$query_string : $url);
    }
}