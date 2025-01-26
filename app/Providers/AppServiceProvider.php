<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\Strings;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use League\Glide\Server;

class AppServiceProvider extends ServiceProvider
{

    public const DEFAULT_STRING_LENGTH = 190;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerGlide();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(self::DEFAULT_STRING_LENGTH);
        Paginator::useBootstrap();
        //setlocale(LC_TIME, 'ptb');
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        $is_store_open = false;
        $store_status = Setting::where('id', Setting::STORE_STATUS)->first();
        if ($store_status) {
            $is_store_open = $store_status->value == Strings::OPEN;
        }
        View::share('is_store_open', $is_store_open);
    }

    protected function registerGlide()
    {
        $this->app->bind(Server::class, function ($app) {
            return Server::create([
                'source' => Storage::getDriver(),
                'cache' => Storage::getDriver(),
                'cache_folder' => '.glide-cache',
                'base_url' => 'img',
            ]);
        });
    }
}
