<?php
/**
 * php-gpt - A PHP implementation of OpenAI's GPT-3 API
 * @author : gary_xu
 * @github :https://github.com/cockycat
 * @date : 2023-05-01
 */
namespace Cockycat\PhpGpt\OpenAI;

use GuzzleHttp\Client as GuzzleClient;
use League\OAuth2\Client\Provider\AbstractProvider as OAuth2Provider;
use Cockycat\PhpGPT\Exceptions\OpenAIException;

class Client
{
    private $endpoint;
    private $oauth2Provider;
    private $guzzleClient;

    public function __construct(string $endpoint, OAuth2Provider $oauth2Provider, GuzzleClient $guzzleClient)
    {
        $this->endpoint = $endpoint;
        $this->oauth2Provider = $oauth2Provider;
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * chat with openai
     * @param string $path
     * @param array $query
     * @param array $headers
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function chat(string $path, array $query = [], array $headers = [])
    {
        $uri = $this->endpoint . $path . '?' . http_build_query($query);

        $accessToken = $this->oauth2Provider->getAccessToken('client_credentials')->getToken();

        $response = $this->guzzleClient->get($uri, [
            'headers' => array_merge([
                'Authorization' => 'Bearer ' . $accessToken,
            ], $headers),
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new OpenAIException('Failed to get data from OpenAPI endpoint', $response->getStatusCode());
        }
        return json_decode($response->getBody()->getContents(), true);
    }
}
