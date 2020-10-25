<?php

namespace SpiritSystems\DayByDay\Contacts\Providers;

use Illuminate\Support\ServiceProvider;
use SpiritSystems\DayByDay\Contacts\Pipes\MenuProviderPipe;
use SpiritSystems\DayByDay\Core\Services\MenuService;

class DayByDayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        MenuService::addProvider(MenuProviderPipe::class);
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
