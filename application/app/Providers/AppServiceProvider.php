<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

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
    public function boot(Dispatcher $events)
    {
       Schema::defaultStringLength(191);

       $events->Listen(BuildingMenu::class, function(BuildingMenu $event){

            $event->menu->add('MENU DE NAVEGACION');

            $event->menu->add(
                [
                    'text' => 'Resumen',
                    'route' => 'home',
                    'icon' => 'dashboard'
                ],
                [
                    'text' => 'Mensajes',
                    'route' => 'messages.index',
                    'icon' => 'envelope'
                ],
                [
                    'text' => 'Contactos',
                    'url' => '#',
                    'icon' => 'eye'
                ],
                [
                    'text' => 'Usuarios',
                    'route' => 'users.index',
                    'icon' => 'users'
                ],
                [
                    'text' => 'Lugares de Interes',
                    'route' => 'places.index',
                    'icon' => 'users'
                ],
                [
                    'text' => 'Productos',
                    'route' => 'products.index',
                    'icon' => 'tasks'
                ],
                [
                    'text' => 'Noticias',
                    'route' => 'notices.index',
                    'icon' => 'file-o'
                ],
                [
                    'text' => 'Documentos',
                    'route' => 'documents.index',
                    'icon' => 'support'
                ],
                [
                    'text' => 'Capacitaciones',
                    'route' => 'trainings.index',
                    'icon' => 'calendar'
                ],
                [
                    'text' => 'Rubros',
                    'route' => 'entries.index',
                    'icon' => 'list'
                ],
                [
                    'text' => 'Categorias',
                    'route' => 'categories.index',
                    'icon' => 'list'
                ],
                [
                    'text' => 'Camaras',
                    'route' => 'cameras.index',
                    'icon' => 'list'
                ],
                [
                    'text' => 'Localizaciones',
                    'route' => 'locations.index',
                    'icon' => 'list'
                ],
                [
                    'text' => 'Rubros Entradas/Salidas',
                    'url' => '#',
                    'icon' => 'list'
                ],
                [
                    'text' => 'Control Entradas/Salidas',
                    'url' => '#',
                    'icon' => 'list'
                ],
                [
                    'text' => 'Control de Pagos Socios',
                    'url' => '#',
                    'icon' => 'list'
                ]
            );

       });
    }
}
