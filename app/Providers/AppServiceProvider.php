<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = $this->app;

        Model::preventLazyLoading(!$app->isProduction());

        if(App::environment('local')) {
            DB::listen(function($query) {

                // format the bindings as string
                $bindings = implode(", ", $query->bindings);
                
                File::append(
                    storage_path('/logs/query.log'),
                    '[' . date('Y-m-d H:i:s') . ']' . PHP_EOL . $query->sql . ' [' . $bindings . ']' . ' (' . $query->time . ' ms)' . PHP_EOL . PHP_EOL
                );
            });
        }
    }
}
