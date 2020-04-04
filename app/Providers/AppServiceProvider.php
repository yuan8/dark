<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
       $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

         $event->menu->add([
               'text' => 'Dashboard',
               'icon'=>'fa fa-home',
               'url'=>url('/')

           ]);

           $event->menu->add([
                 'text' => 'Pelaporan',
                 'icon'=>'fa fa-file',
                 'url'=>route('pel')

             ]);
             $event->menu->add([
                   'text' => 'Realisasi Tingkat Pusat',
                   'icon'=>'fa fa-chart-bar',
                   'submenu'=>[
                     [
                       'text'=>'Rekap Nasional',
                       'url'=>route('rel.nas')


                     ],
                     [
                        'text'=>'Rekap Perbidang',
                        'url'=>''

                     ]

                   ]

               ]);
           $event->menu->add([
                 'text' => 'Realisasi Tingkat Daerah',
                 'icon'=>'fa fa-chart-area',
                 'submenu'=>[
                   [
                     'text'=>'Tingkat Provinsi',
                     'url'=>''


                   ],
                   [
                      'text'=>'Tingkat Daerah',
                      'url'=>''

                   ]

                 ]

             ]);
             $event->menu->add([
                   'text' => 'Pilih Tahun',
                   'icon'=>'fa fa-calender',
                   'url'=>route('f.pilih_tahun')

               ]);


       });
        //
    }
}
