<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
        Blade::directive('status', function ($status) {
            return "<?php if($status == 0){
                echo 'btn-danger';
            }elseif($status == 1){
                echo 'btn-info';
            }
            elseif($status == 2){
                echo 'btn-olive';
            }elseif ($status == 3) {
                echo 'btn-success';
            }?>";
        });
    }
}
