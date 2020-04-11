<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
class HpProvider extends ServiceProvider
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
        //
    }


    public static function front_tahun(){
      if(Auth::User()){

      }else{
        Auth::loginUsingId(1,true);
      }
      // dd(session('tahun_f'));
      if((session('tahun_f')==null)OR(empty(session('tahun_f')))){
           header("Location: ".route('f.pilih_tahun'));
          exit();

      }else{  
        return (int)session('tahun_f');
      }

    }

    public static function admin_tahun(){
      if(Auth::User()){

      }else{
        Auth::loginUsingId(1,true);
      }

      if((session('tahun_a')==null)OR(empty(session('tahun_a')))){
        header("Location: ".route('f.pilih_tahun'));
       exit();

      }else{
        return (int)session('tahun_a');
      }

    }


    public static function show_front_tahun(){
      return session('tahun_f');
    }
}
