<?php

namespace App\Http\Controllers\INIT;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


class InitialTahunCtrl extends Controller
{
    //


  public function back(){
  //   $daerh=DB::table('master_daerah')->get();
  // foreach ($daerh as $key => $d) {
  //   $dr=DB::connection('back')->table('data')
  //   ->where(DB::raw("replace(nama,' ','')"),'ilike',('%'.str_replace(' ', '', $d->nama).'%'))->first();
  //   if($dr){
  //     DB::connection('back')->table('data')
  //     // where('id','!=',null)
  //     ->where('id_pro',$dr->id_pro)
  //     ->where('id_kota',$dr->id_kota)->update(['id'=>$d->id]);
  //   }
  // }

    $daerh=DB::table('master_daerah')->where('kode_daerah_parent',null)->get();
    foreach ($daerh as $key => $d) {
    $dr=DB::table('master_daerah')->where('id_pro',$d->id_pro)
    ->update(['table_name'=>$d->table_name]);
   
    }
  }

    public function careteDb($tahun){

      if(!Schema::hasTable('mastering_bidang_'.$tahun)){

             Schema::create('mastering_bidang_'.$tahun,function(Blueprint $table){
                $table->bigIncrements('id');
                $table->string('nama');
                $table->string('kode');
                $table->string('kategori_dak');
                $table->string('match')->nullable();
                $table->unique(['kode']);
             });
      }

       if(!Schema::hasTable('mastering_sub_bidang_'.$tahun)){

             Schema::create('mastering_sub_bidang_'.$tahun,function(Blueprint $table){
                $table->bigIncrements('id');
                $table->string('nama');
                $table->string('kode_bidang');
                $table->string('kode');
                $table->string('kategori_dak');
                $table->string('match')->nullable();
                $table->unique(['kode_bidang','kode']);
             });
      }

      set_time_limit(-1);
    $daerah=  DB::table('master_daerah')->where('kode_daerah_parent',null)->get();
      foreach ($daerah as $key => $d) {
        $t_name=$d->table_name.'_'.$tahun;

        if(!Schema::hasTable($t_name)){
          Schema::create($t_name,function(Blueprint $table){
               $table->bigIncrements('id');
               $table->bigInteger('id_bidang_db')->nullable();
               $table->bigInteger('id_sub_bidang_db')->nullable();
               $table->string('url')->nullable();
               $table->integer('id_bidang')->nullable();
               $table->integer('id_sub_bidang')->nullable();
               $table->integer('id_kegiatan')->nullable();
               $table->integer('id_sub_kegiatan')->nullable();
               $table->integer('id_detail_sub_kegiatan')->nullable();
               $table->integer('kategori_dak')->nullable();
               $table->string('kolom')->nullable();
               $table->integer('tw')->nullable();
               $table->text('nama')->nullable();
               $table->string('parent')->nullable();
               $table->boolean('penunjang')->nullable();
               $table->string('kecamatan')->nullable();
               $table->string('desa_kelurahan')->nullable();
               $table->string('kode_kegiatan')->nullable();
               $table->float('perencanaan_kegiatan_volume',20,3)->nullable();
               $table->string('perencanaan_kegiatan_satuan')->nullable();
               $table->float('perencanaan_kegiatan_jumlah_penerima_manfaat',20,3)->nullable();
               $table->string('perencanaan_kegiatan_jumlah_penerima_manfaat_satuan')->nullable();
               $table->float('perencanaan_kegiatan_pagu_dak_fisik',20,3)->nullable();
               $table->float('mekanisme_pelaksana_swakelola_volume',20,3)->nullable();
               $table->float('mekanisme_pelaksana_swakelola_pagu',20,3)->nullable();
               $table->float('mekanisme_pelaksanaan_kontraktual_volume',20,3)->nullable();
               $table->float('mekanisme_pelaksana_kontraktual_pagu',20,3)->nullable();
               $table->string('mekanisme_pelaksana_metoda_pembayaran')->nullable();
               $table->float('realisasi_keuangan',20,3)->nullable();
               $table->float('realisasi_keuangan_persen')->nullable();
               $table->float('realisasi_fisik_volume',20,3)->nullable();
               $table->float('realisasi_fisik_persen',20,3)->nullable();
               $table->text('kodefikasi_keterangan_permasalahan')->nullable();
               $table->string('provinsi')->nullable();
               $table->string('kota_kab')->nullable();
               $table->string('tujuan_pelaporan')->nullable();
               $table->dateTime('tgl_update')->nullable();
               $table->boolean('status_verifikasi')->nullable();
               $table->text('komentar_verifikasi')->nullable();

          });
        }else{
          $name=$d->table;
         $da=DB::table('master_daerah')->where('id_pro',$d->id_pro)->get();
         foreach ($da as $key => $d) {
            for($i=1;$i<5;$i++){
                
                $data=DB::table($t_name)->where('tw',$i)
                ->where([
                  ['provinsi','=',$d->id_pro],
                  ['kota_kab','=',$d->id_kota],

                ])->orderBy('kategori_dak','ASC')->orderBy('id','ASC')->get();
                $kat=0;
                $bid=0;
                $sub_bid=0;
                foreach ($data as $key => $dt) {
                  if($dt->kategori_dak!=$kat){
                    $bid=0;
                    $sub_bid=0;
                    $kat=$dt->kategori_dak;

                  }
                  if($dt->kolom=='BIDANG'){
                    $bid+=1;
                    $sub_bid=0;
                  }
                  if($dt->kolom=='SUB BIDANG'){
                    $sub_bid+=1;
                  }

                  $dt->id_bidang=$bid;
                  $dt->id_sub_bidang=$sub_bid;

                DB::table($t_name)->where('tw',$i)
                  ->where([
                    ['tw','=',$i],
                    ['provinsi','=',$d->id_pro],
                    ['kota_kab','=',$d->id_kota],
                    ['id','=',$dt->id]
                  ])->update((array)$dt);
                }

                  # code...
             }
             // tw
              
            }
            // daerah
          }
          // end else
      }


    }

    public function dropTable($tahun){
      $daerah=  DB::table('master_daerah')->where('kode_daerah_parent',null)->get();

      foreach ($daerah as $key => $d) {
        $t_name=$d->table_name.'_'.$tahun;
          Schema::dropIfExists($t_name);
      }
    }

    public function front_pilih_tahun(){

      return view('init.front_tahun');
    }

    public function store_front_pilih_tahun(Request $request){
      if($request->tahun){
        session(['tahun_f'=>$request->tahun]);
        return redirect()->route('home');
      }
    }


    public function createBidang($tahun){

      if(file_exists(storage_path('app/petabidang_'.$tahun.'.json'))){
          $data=file_get_contents(storage_path('app/petabidang_'.$tahun.'.json'));
          $data_u=json_decode($data,true);

            $reguler=0;
            $penugasan=0;
            $affirmasi=0;
            $non_fisik=0;

          foreach ($data_u as $key => $d) {
          

           if(!empty($d['C'])){
              $KAT='REGULER';
              $reguler=$d['C'];
              $data=[
                'kode'=>$d['C'],
                'nama'=>$KAT.' '.$d['A'],
                'kategori_dak'=>1,
                'match'=>$d['A']
              ];

              DB::table('mastering_bidang_'.$tahun)->insert(
                $data
              );

           }

            if(!empty($d['E'])){
              $KAT='PENUGASAN';
              $penugasan=$d['E'];
              $data=[
                'kode'=>$d['E'],
                'nama'=>$KAT.' '.$d['A'],
                'kategori_dak'=>2,
                'match'=>$d['A']
              ];

              DB::table('mastering_bidang_'.$tahun)->insert(
                $data
              );

           }

          if(!empty($d['G'])){
              $KAT='AFFIRMASI';
              $affirmasi=$d['G'];
              $data=[
                'kode'=>$d['G'],
                'nama'=>$KAT.' '.$d['A'],
                'kategori_dak'=>3,
                'match'=>$d['A']
              ];

              DB::table('mastering_bidang_'.$tahun)->insert(
                $data
              );

           }

          if(!empty($d['I'])){
              $KAT='NON FISIK';
               $non_fisik=$d['I'];
              $data=[
                'kode'=>$d['I'],
                'nama'=>$KAT.' '.$d['A'],
                'kategori_dak'=>4,
                'match'=>$d['A']
              ];
              
              DB::table('mastering_bidang_'.$tahun)->insert(
                $data
              );

           }

            //sub 

           if(!empty($d['D'])){
              $KAT='REGULER';
              $data=[
                'kode'=>$d['D'],
                'nama'=>$KAT.' SUB '.$d['B'],
                'kategori_dak'=>1,
                'kode_bidang'=>$reguler,

                'match'=>$d['B']
              ];

              DB::table('mastering_sub_bidang_'.$tahun)->insert(
                $data
              );

           }

            if(!empty($d['F'])){
              $KAT='PENUGASAN';
              $data=[
                'kode'=>$d['F'],
                'nama'=>$KAT.' SUB '.$d['B'],
                'kategori_dak'=>2,
                'kode_bidang'=>$penugasan,

                'match'=>$d['B']
              ];

              DB::table('mastering_sub_bidang_'.$tahun)->insert(
                $data
              );

           }

          if(!empty($d['H'])){
              $KAT='AFFIRMASI';
              $data=[
                'kode'=>$d['H'],
                'nama'=>$KAT.' SUB '.$d['B'],
                'kategori_dak'=>3,
                'kode_bidang'=>$affirmasi,

                'match'=>$d['B']
              ];

              DB::table('mastering_sub_bidang_'.$tahun)->insert(
                $data
              );

           }

          if(!empty($d['J'])){
              $KAT='NON FISIK';
              $data=[
                'kode'=>$d['J'],
                'nama'=>$KAT.' SUB '.$d['B'],
                'kategori_dak'=>4,
                'kode_bidang'=>$non_fisik,

                'match'=>$d['B']
              ];
              
              DB::table('mastering_sub_bidang_'.$tahun)->insert(
                $data
              );

           }

          }

      }

    }
}
