<?php
/**
 * test for php-gpt
 */
namespace Cockycat\PhpGpt\OpenAITests;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use League\OAuth2\Client\Provider\AbstractProvider as OAuth2Provider;
use Cockycat\PhpGpt\OpenAI\Client as OpenAIClient;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private $client;

    public function setUp(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], '{"data": "test"}'),
        ]);

        $handlerStack = HandlerStack::create($mockHandler);
        $guzzleClient = new GuzzleClient(['handler' => $handlerStack]);

        $oauth2Provider = $this->createMock(OAuth2Provider::class);

        $this->client = new OpenAIClient('<https://example.com>', $oauth2Provider, $guzzleClient);
    }

    public function testChat()
    {
        $response = $this->client->get('/test', ['param1' => 'value1']);

        $this->assertEquals(['data' => 'test'], $response);
    }
}
