<?php

namespace App\Providers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', static function ($data) {
            return Response::json([
                'errors'  => false,
                'data' => $data,
            ]);
        });

        Response::macro('error', static function ($message, $status = 400) {
            return Response::json([
                'errors'  => true,
                'message' => $message,
            ], $status);
        });
    }
}
