<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;

use Illuminate\Support\ServiceProvider;

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
        // Verifica y crea la carpeta 'assets/img/projects' si no existe
        $directory = public_path('assets/img/projects');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0777, true);  // Crea la carpeta con los permisos adecuados
        }
    }
}
