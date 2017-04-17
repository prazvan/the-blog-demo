<?php

namespace App\Exceptions;

use \Exception;

/**
 * Class ChannelNotFoundException
 * @package App\Exceptions
 */
class ChannelNotFoundException extends Exception
{
    /**
     * Default exception message
     * @var string
     */
    protected $message = 'Channel Not Found!';
}