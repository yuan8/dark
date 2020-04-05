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

    $daerh=DB::table('master_daerah')->get();
  foreach ($daerh as $key => $d) {
    $dr=DB::connection('back')->table('data')
    ->where('id',$d->id)->first();
    if($dr){
     DB::table('master_daerah')
     ->where('id',$d->id)
      ->update([
        'id_pro'=>$dr->id_pro,
        'id_kota'=>$dr->id_kota,
        'geojsonfile'=>$dr->geojsonfile,
      ]);
    }
  }
  }

    public function careteDb($tahun){
    $daerah=  DB::table('master_daerah')->where('kode_daerah_parent',null)->get();
      foreach ($daerah as $key => $d) {
        $name=(str_replace(' ','_',$d->nama));
        if(!Schema::hasTable($tahun.'_'.$name)){
          Schema::create($tahun.'_'.$name,function(Blueprint $table){
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
               $table->float('perencanaan_kegiatan_volume')->nullable();
               $table->string('perencanaan_kegiatan_satuan')->nullable();
               $table->float('perencanaan_kegiatan_jumlah_penerima_manfaat')->nullable();
               $table->string('perencanaan_kegiatan_jumlah_penerima_manfaat_satuan')->nullable();
               $table->float('perencanaan_kegiatan_pagu_dak_fisik')->nullable();
               $table->float('mekanisme_pelaksana_swakelola_volume')->nullable();
               $table->float('mekanisme_pelaksana_swakelola_pagu')->nullable();
               $table->float('mekanisme_pelaksanaan_kontraktual_volume')->nullable();
               $table->float('mekanisme_pelaksana_kontraktual_pagu')->nullable();
               $table->float('mekanisme_pelaksana_metoda_pembayaran')->nullable();
               $table->float('realisasi_keuangan')->nullable();
               $table->float('realisasi_keuangan_persen')->nullable();
               $table->float('realisasi_fisik_volume')->nullable();
               $table->float('realisasi_fisik_persen')->nullable();
               $table->text('kodefikasi_keterangan_permasalahan')->nullable();
               $table->string('provinsi')->nullable();
               $table->string('kota_kab')->nullable();
               $table->string('tujuan_pelaporan')->nullable();
               $table->dateTime('tgl_update')->nullable();
               $table->boolean('status_verifikasi')->nullable();
               $table->text('komentar_verifikasi')->nullable();

          });
        }else{
          DB::table($tahun.'_'.$name)->truncate();
        }
      }


    }

    public function dropTable($tahun){
      $daerah=  DB::table('master_daerah')->where('kode_daerah_parent',null)->get();
      foreach ($daerah as $key => $d) {
        $name=(str_replace(' ','_',$d->nama));
          Schema::dropIfExists($tahun.'_'.$name);
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
}
