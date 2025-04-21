<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Caminho para a "home" após o login.
     */
    public const HOME = '/dashboard';

    /**
     * Defina quaisquer rotas de modelo vinculado ou padrões aqui.
     */
    public function boot(): void
    {
        parent::boot();

        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    }
}
