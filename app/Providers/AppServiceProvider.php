<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
       //$this->formatDateForSQL();
    }


    protected function formatDateForSQL(){
        DB::listen(function ($query) {
            // $query->sql
            // $query->bindings
            // $query->time

            $q = str_replace(array('?'), array('\'%s\''), $query->sql);

            $bindings = array_map(function($value) {
                if (is_a($value, 'DateTime')) {
                    return $value->format('Y-m-d H:i:s.v');
                }
                else {
                    return $value;
                }
            }, $query->bindings);

            $q = vsprintf($q, $bindings);
            Log::debug($q);
        });
    }
}
