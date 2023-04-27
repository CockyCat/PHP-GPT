<?php
/**
 * php-gpt - A PHP implementation of OpenAI's GPT-3 API
 * @author : gary_xu
 * @github :https://github.com/cockycat
 * @date : 2023-05-01
 */
namespace Cockycat\PhpGPT\Facades;

use Cockycat\PhpGpt\OpenAI\Client as OpenAIClient;
/**
 * @method array|\Exception get()
 */
class PhpGPTClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return OpenAIClient::class;
    }
}
