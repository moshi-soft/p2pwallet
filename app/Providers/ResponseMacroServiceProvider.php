<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
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
        Response::macro('success', function ($data,int $status = 200) {
            return Response::json([
                'success' => true,
                'data' => $data,
            ],$status);
        });

        Response::macro('error', function (string $message, $data, int $status = 400) {
            return Response::json([
                'success' => false,
                'message' => $message,
                'errors' => $data,
            ], $status);
        });
    }
}
