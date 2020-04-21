<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;
class AppServiceProvider extends ServiceProvider
{
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
                 'submenu'=>[
                  [
                    'text'=>'Chart',
                    'url'=>route('pel')
                  ],
                  [
                    'text'=>'Map',
                    'url'=>route('pel.map')
                  ]
                 ]
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
                        'url'=>route('rel.nas.bidang')

                     ]

                   ]

               ]);
           $event->menu->add([
                 'text' => 'Realisasi Tingkat Daerah',
                 'icon'=>'fa fa-chart-area',
                 'submenu'=>[
                   [
                     'text'=>'Tingkat Provinsi',
                     'url'=>route('rel.daerah.pro')


                   ],
                   [
                      'text'=>'Tingkat Daerah',
                      'url'=>route('rel.daerah.kota')

                   ]

                 ]

             ]);
             $event->menu->add([
                   'text' => 'Pilih Tahun',
                   'icon'=>'fa fa-calender',
                   'url'=>route('f.pilih_tahun')

               ]);

             $event->menu->add([
                 'text' => 'Sanitasi',
                 'icon'=>'fa fa-calender',
                 'url'=>route('f.sanitasi',['kode_daerah'=>11,'tw'=>1])

             ]);


       });
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
