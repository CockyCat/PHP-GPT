<?php
/**
 *
 */
namespace Cockycat\PhpGpt;
use Cockycat\PhpGpt\OpenAI\Client;
use GuzzleHttp\Client as GuzzleClient;
use Laravel\Lumen\Application as LumenApplication;
use League\OAuth2\Client\Provider\GenericProvider as OAuth2Provider;
use Illuminate\Support\ServiceProvider;

class PhpGptServiceProvider extends ServiceProvider{

    public function boot()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([
                dirname(__DIR__).'/src/config/php-gpt.php' => config_path('php-gpt.php'), ],
                'config'
            );
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('php-gpt');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/src/config/php-gpt.php', 'php-gpt');
        $this->app->singleton(Client::class, function ($app){
            $endpoint = $app['config']['php-gpt']['endpoint'];
            $oauth2Provider = new OAuth2Provider([
                'clientId' => $app['config']['php-gpt']['client_id'],
                'clientSecret' => $app['config']['php-gpt']['client_secret'],
                'urlAuthorize' => $app['config']['php-gpt']['url_authorize'],
                'urlAccessToken' => $app['config']['php-gpt']['url_access_token'],
                'urlResourceOwnerDetails' => $app['config']['php-gpt']['url_resource_owner_details'],
            ]);
            $guzzleClient = new GuzzleClient();
            return new Client($endpoint, $oauth2Provider, $guzzleClient);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return Client::class;
    }

}
