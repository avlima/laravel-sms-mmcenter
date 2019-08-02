<?php


namespace Avlima\SmsMMCenter\Providers;


use Illuminate\Contracts\Container\BindingResolutionException;
use Avlima\SmsMMCenter\Notifications\SmsMMCenterService;
use GuzzleHttp\{Client, Psr7\Request as GuzzleRequest};
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class SmsMMCenterServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $module = 'sms-mmcenter';

    /**
     * @var Client
     */
    private $client;
    /**
     * @var array
     */
    private $params;

    /**
     * @var GuzzleRequest
     */
    private $request;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . "/../config/{$this->module}.php" => config_path("{$this->module}.php")
        ], 'config');

        $this->client  = new Client(['timeout' => config('sms-mmcenter.timeout')]);
        $this->request = new GuzzleRequest('POST', config('sms-mmcenter.url'));
        $this->params  = [
            'usuario'  => config('sms-mmcenter.user'),
            'senha'    => config('sms-mmcenter.password'),
            'operacao' => config('sms-mmcenter.operation'),
            'rota'     => config('sms-mmcenter.route'),
        ];
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . "/../config/{$this->module}.php",
            $this->module
        );

        $this->app->singleton($this->module, function () {
            return new SmsMMCenterService($this->client, $this->request, $this->params);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [$this->module];
    }
}
