<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HP;
use DB;

class RelNasional extends Controller
{
    public function index(){
    	   $tahun=HP::front_tahun();
      $tables=DB::table('master_daerah')->where('kode_daerah_parent',null)->select('id','nama','table')->get();
      $data_daerah=[];
      foreach ($tables as $key => $table) {
        $data=DB::table($tahun.$table->table.' as dd')
        ->select(
          // DB::raw("(case when dd.kota_kab is null then dd.provinsi else dd.kota_kab end) as kode_daerah"),
          DB::raw("(select nama from master_daerah as d where id_pro=dd.provinsi and id_kota=dd.kota_kab limit 1) as nama_daerah"),
          DB::raw("(select id from master_daerah as d where id_pro=dd.provinsi and id_kota=dd.kota_kab limit 1) as kode_daerah"),
          'dd.tw',
          DB::raw("max(dd.url) as file_path") ,
          DB::raw("sum(case when kolom in ('KEGIATAN','SUB KEGIATAN','KEGIATAN (SILPA)') then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as perencanaan_kegiatan_pagu_dak_fisik"),
          DB::raw("sum(case when kolom in ('KEGIATAN','SUB KEGIATAN','KEGIATAN (SILPA)') then realisasi_keuangan else 0 end ) as realisasi_keuangan"),
          DB::raw("sum(case when kolom in ('KEGIATAN','SUB KEGIATAN','KEGIATAN (SILPA)') then realisasi_fisik_volume else 0 end ) as realisasi_fisik_volume")
        )
        ->orderBy('dd.tw','asc')
        ->orderBy('kode_daerah','asc')
        ->groupBy(['provinsi','kota_kab','tw'])
        ->get()->toArray();

        $data_daerah=array_merge($data_daerah,$data);
      }

      $TW1=[];
      $TW2=[];
      $TW3=[];
      $TW4=[];
      $perencanaan_kegiatan_pagu_dak_fisik_1=0;
      $perencanaan_kegiatan_pagu_dak_fisik_2=0;
      $perencanaan_kegiatan_pagu_dak_fisik_3=0;
      $perencanaan_kegiatan_pagu_dak_fisik_4=0;

      $realisasi_keuangan_1=0;
      $realisasi_keuangan_2=0;
      $realisasi_keuangan_3=0;
      $realisasi_keuangan_4=0;

      $realisasi_fisik_volume_1=0;
      $realisasi_fisik_volume_2=0;
      $realisasi_fisik_volume_3=0;
      $realisasi_fisik_volume_4=0;

      foreach($data_daerah as $d){
        switch ($d->tw) {
            case 1:
            // code...
            $TW1[]=(array)$d;
            $perencanaan_kegiatan_pagu_dak_fisik_1+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $realisasi_keuangan_1+=$d->realisasi_keuangan;
            $realisasi_fisik_volume_1=$d->realisasi_fisik_volume;

            break;
            case 2:
            // code...
            $TW2[]=(array)$d;
            $perencanaan_kegiatan_pagu_dak_fisik_2+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $realisasi_keuangan_2+=$d->realisasi_keuangan;
            $realisasi_fisik_volume_2=$d->realisasi_fisik_volume;

            break;
            case 3:
            // code...
            $TW3[]=(array)$d;
            $perencanaan_kegiatan_pagu_dak_fisik_3+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $realisasi_keuangan_3+=$d->realisasi_keuangan;
            $realisasi_fisik_volume_3=$d->realisasi_fisik_volume;

            break;
            case 4:
            $perencanaan_kegiatan_pagu_dak_fisik_4+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $realisasi_keuangan_4+=$d->realisasi_keuangan;
            $realisasi_fisik_volume_4=$d->realisasi_fisik_volume;

            // code...
            $TW4[]=(array)$d;
            break;
          default:
            // code...
            break;
        }
      }

      $return=array(
        'reakap_realisasi'=>array(
          '1'=>[
              'keuangan'=>$realisasi_keuangan_1,
              'volume_fisik'=>$realisasi_fisik_volume_1,
              'pagu'=>$perencanaan_kegiatan_pagu_dak_fisik_1
            ],
          '2'=>[
              'keuangan'=>$realisasi_keuangan_2,
              'volume_fisik'=>$realisasi_fisik_volume_2,
              'pagu'=>$perencanaan_kegiatan_pagu_dak_fisik_2
            ],
          '3'=>[
              'keuangan'=>$realisasi_keuangan_3,
              'volume_fisik'=>$realisasi_fisik_volume_3,
              'pagu'=>$perencanaan_kegiatan_pagu_dak_fisik_3
            ],
          '4'=>[
              'keuangan'=>$realisasi_keuangan_4,
              'volume_fisik'=>$realisasi_fisik_volume_4,
              'pagu'=>$perencanaan_kegiatan_pagu_dak_fisik_4
            ]
        ),
        'data_daerah'=>[
            '1'=>$TW1,
            '2'=>$TW2,
            '3'=>$TW3,
            '4'=>$TW4,
          ]
      );

      return view('front.realisasi.nas.index')->with('data',$return);
    }

}
