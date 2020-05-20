<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HP;
USE DB;
class RelProvinsi extends Controller
{
    //
      public function index(Request $request){

    	$in="'KEGIATAN','SUB KEGIATAN','DETAIL SUB KEGIATAN','KEGIATAN (SILPA)'";
    	   $tahun=HP::front_tahun();
      $tables=DB::table('master_daerah')->where('kode_daerah_parent',null)->select('id','nama','table','table_name')->orderBy('nama','ASC');
      $list_d=$tables->get();

      if($request->p){
      	$tables=$tables->where('id',$request->p);
      }
      $tables=$tables->paginate(1);
      $data_daerah=[];
      foreach ($tables as $key => $table) {
        $data=DB::table($table->table_name.'_'.$tahun.' as dd')
        ->select(
          // DB::raw("(case when dd.kota_kab is null then dd.provinsi else dd.kota_kab end) as kode_daerah"),
          DB::raw("(select nama from master_daerah as d where id_pro=dd.provinsi and id_kota=dd.kota_kab limit 1) as nama_daerah"),
          DB::raw("(select id from master_daerah as d where id_pro=dd.provinsi and id_kota=dd.kota_kab limit 1) as kode_daerah"),
          'dd.tw',
          DB::raw("max(dd.url) as file_path") ,
          DB::raw("sum(case when kolom in (".$in.") then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as perencanaan_kegiatan_pagu_dak_fisik"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =1) then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as perencanaan_kegiatan_pagu_dak_fisik_reguler"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =2) then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as perencanaan_kegiatan_pagu_dak_fisik_penugasan"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =3) then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as perencanaan_kegiatan_pagu_dak_fisik_affirmasi"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =4) then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as perencanaan_kegiatan_pagu_dak_fisik_non_fisik"),
          DB::raw("sum(case when kolom in (".$in.") then realisasi_keuangan else 0 end ) as realisasi_keuangan"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =1) then realisasi_keuangan else 0 end ) as realisasi_keuangan_reguler"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =2) then realisasi_keuangan else 0 end ) as realisasi_keuangan_penugasan"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =3) then realisasi_keuangan else 0 end ) as realisasi_keuangan_affirmasi"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =4) then realisasi_keuangan else 0 end ) as realisasi_keuangan_non_fisik"),
          DB::raw("sum(case when kolom in (".$in.") then realisasi_fisik_volume else 0 end ) as realisasi_fisik_volume"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =1) then realisasi_fisik_volume else 0 end ) as realisasi_fisik_volume_reguler"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =2) then realisasi_fisik_volume else 0 end ) as realisasi_fisik_volume_penugasan"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =3) then realisasi_fisik_volume else 0 end ) as realisasi_fisik_volume_affirmasi"),
           DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =4) then realisasi_fisik_volume else 0 end ) as realisasi_fisik_volume_non_fisik")
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
      $perencanaan_kegiatan_pagu_dak_fisik_1_reguler=0;
      $perencanaan_kegiatan_pagu_dak_fisik_1_penugasan=0;
      $perencanaan_kegiatan_pagu_dak_fisik_1_affirmasi=0;
      $perencanaan_kegiatan_pagu_dak_fisik_1_non_fisik=0;

      $perencanaan_kegiatan_pagu_dak_fisik_2=0;
      $perencanaan_kegiatan_pagu_dak_fisik_2_reguler=0;
      $perencanaan_kegiatan_pagu_dak_fisik_2_penugasan=0;
      $perencanaan_kegiatan_pagu_dak_fisik_2_affirmasi=0;
      $perencanaan_kegiatan_pagu_dak_fisik_2_non_fisik=0;

      $perencanaan_kegiatan_pagu_dak_fisik_3=0;
      $perencanaan_kegiatan_pagu_dak_fisik_3_reguler=0;
      $perencanaan_kegiatan_pagu_dak_fisik_3_penugasan=0;
      $perencanaan_kegiatan_pagu_dak_fisik_3_affirmasi=0;
      $perencanaan_kegiatan_pagu_dak_fisik_3_non_fisik=0;

      $perencanaan_kegiatan_pagu_dak_fisik_4=0;
      $perencanaan_kegiatan_pagu_dak_fisik_4_reguler=0;
      $perencanaan_kegiatan_pagu_dak_fisik_4_penugasan=0;
      $perencanaan_kegiatan_pagu_dak_fisik_4_affirmasi=0;
      $perencanaan_kegiatan_pagu_dak_fisik_4_non_fisik=0;

      $realisasi_keuangan_1=0;
      $realisasi_keuangan_1_reguler=0;
      $realisasi_keuangan_1_penugasan=0;
      $realisasi_keuangan_1_affirmasi=0;
      $realisasi_keuangan_1_non_fisik=0;

      $realisasi_keuangan_2=0;
      $realisasi_keuangan_2_reguler=0;
      $realisasi_keuangan_2_penugasan=0;
      $realisasi_keuangan_2_affirmasi=0;
      $realisasi_keuangan_2_non_fisik=0;

      $realisasi_keuangan_3=0;
      $realisasi_keuangan_3_reguler=0;
      $realisasi_keuangan_3_penugasan=0;
      $realisasi_keuangan_3_affirmasi=0;
      $realisasi_keuangan_3_non_fisik=0;

      $realisasi_keuangan_4=0;
      $realisasi_keuangan_4_reguler=0;
      $realisasi_keuangan_4_penugasan=0;
      $realisasi_keuangan_4_affirmasi=0;
      $realisasi_keuangan_4_non_fisik=0;

      $realisasi_fisik_volume_1=0;
      $realisasi_fisik_volume_1_reguler=0;
      $realisasi_fisik_volume_1_penugasan=0;
      $realisasi_fisik_volume_1_affirmasi=0;
      $realisasi_fisik_volume_1_non_fisik=0;

      $realisasi_fisik_volume_2=0;
      $realisasi_fisik_volume_2_reguler=0;
      $realisasi_fisik_volume_2_penugasan=0;
      $realisasi_fisik_volume_2_affirmasi=0;
      $realisasi_fisik_volume_2_non_fisik=0;

      $realisasi_fisik_volume_3=0;
      $realisasi_fisik_volume_3_reguler=0;
      $realisasi_fisik_volume_3_penugasan=0;
      $realisasi_fisik_volume_3_affirmasi=0;
      $realisasi_fisik_volume_3_non_fisik=0;

      $realisasi_fisik_volume_4=0;
      $realisasi_fisik_volume_4_reguler=0;
      $realisasi_fisik_volume_4_penugasan=0;
      $realisasi_fisik_volume_4_affirmasi=0;
      $realisasi_fisik_volume_4_non_fisik=0;

      foreach($data_daerah as $d){
        switch ((int)$d->tw) {
            case 1:
            // code...
            $TW1[]=(array)$d;
            $perencanaan_kegiatan_pagu_dak_fisik_1+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $perencanaan_kegiatan_pagu_dak_fisik_1_reguler+=$d->perencanaan_kegiatan_pagu_dak_fisik_reguler;
            $perencanaan_kegiatan_pagu_dak_fisik_1_penugasan+=$d->perencanaan_kegiatan_pagu_dak_fisik_penugasan;
            $perencanaan_kegiatan_pagu_dak_fisik_1_affirmasi+=$d->perencanaan_kegiatan_pagu_dak_fisik_affirmasi;
            $perencanaan_kegiatan_pagu_dak_fisik_1_non_fisik+=$d->perencanaan_kegiatan_pagu_dak_fisik_non_fisik;

            $realisasi_keuangan_1+=$d->realisasi_keuangan;
            $realisasi_keuangan_1_reguler+=$d->realisasi_keuangan_reguler;
            $realisasi_keuangan_1_penugasan+=$d->realisasi_keuangan_penugasan;
            $realisasi_keuangan_1_affirmasi+=$d->realisasi_keuangan_affirmasi;
            $realisasi_keuangan_1_non_fisik+=$d->realisasi_keuangan_non_fisik;

            $realisasi_fisik_volume_1=$d->realisasi_fisik_volume;
            $realisasi_fisik_volume_1_reguler=$d->realisasi_fisik_volume_reguler;
            $realisasi_fisik_volume_1_penugasan=$d->realisasi_fisik_volume_penugasan;
            $realisasi_fisik_volume_1_affirmasi=$d->realisasi_fisik_volume_affirmasi;
            $realisasi_fisik_volume_1_non_fisik=$d->realisasi_fisik_volume_non_fisik;

            break;
            case 2:
            // code...
            $TW2[]=(array)$d;
            $perencanaan_kegiatan_pagu_dak_fisik_2+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $perencanaan_kegiatan_pagu_dak_fisik_2_reguler+=$d->perencanaan_kegiatan_pagu_dak_fisik_reguler;
            $perencanaan_kegiatan_pagu_dak_fisik_2_penugasan+=$d->perencanaan_kegiatan_pagu_dak_fisik_penugasan;
            $perencanaan_kegiatan_pagu_dak_fisik_2_affirmasi+=$d->perencanaan_kegiatan_pagu_dak_fisik_affirmasi;
            $perencanaan_kegiatan_pagu_dak_fisik_2_non_fisik+=$d->perencanaan_kegiatan_pagu_dak_fisik_non_fisik;

            $realisasi_keuangan_2+=$d->realisasi_keuangan;
            $realisasi_keuangan_2_reguler+=$d->realisasi_keuangan_reguler;
            $realisasi_keuangan_2_penugasan+=$d->realisasi_keuangan_penugasan;
            $realisasi_keuangan_2_affirmasi+=$d->realisasi_keuangan_affirmasi;
            $realisasi_keuangan_2_non_fisik+=$d->realisasi_keuangan_non_fisik;

            $realisasi_fisik_volume_2=$d->realisasi_fisik_volume;
            $realisasi_fisik_volume_2_reguler=$d->realisasi_fisik_volume_reguler;
            $realisasi_fisik_volume_2_penugasan=$d->realisasi_fisik_volume_penugasan;
            $realisasi_fisik_volume_2_affirmasi=$d->realisasi_fisik_volume_affirmasi;
            $realisasi_fisik_volume_2_non_fisik=$d->realisasi_fisik_volume_non_fisik;


            break;
            case 3:
            // code...
            $TW3[]=(array)$d;
            $perencanaan_kegiatan_pagu_dak_fisik_3+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $perencanaan_kegiatan_pagu_dak_fisik_3_reguler+=$d->perencanaan_kegiatan_pagu_dak_fisik_reguler;
            $perencanaan_kegiatan_pagu_dak_fisik_3_penugasan+=$d->perencanaan_kegiatan_pagu_dak_fisik_penugasan;
            $perencanaan_kegiatan_pagu_dak_fisik_3_affirmasi+=$d->perencanaan_kegiatan_pagu_dak_fisik_affirmasi;
            $perencanaan_kegiatan_pagu_dak_fisik_3_non_fisik+=$d->perencanaan_kegiatan_pagu_dak_fisik_non_fisik;

            $realisasi_keuangan_3+=$d->realisasi_keuangan;
            $realisasi_keuangan_3_reguler+=$d->realisasi_keuangan_reguler;
            $realisasi_keuangan_3_penugasan+=$d->realisasi_keuangan_penugasan;
            $realisasi_keuangan_3_affirmasi+=$d->realisasi_keuangan_affirmasi;
            $realisasi_keuangan_3_non_fisik+=$d->realisasi_keuangan_non_fisik;

            $realisasi_fisik_volume_3=$d->realisasi_fisik_volume;
            $realisasi_fisik_volume_3_reguler=$d->realisasi_fisik_volume_reguler;
            $realisasi_fisik_volume_3_penugasan=$d->realisasi_fisik_volume_penugasan;
            $realisasi_fisik_volume_3_affirmasi=$d->realisasi_fisik_volume_affirmasi;
            $realisasi_fisik_volume_3_non_fisik=$d->realisasi_fisik_volume_non_fisik;

            break;
            case 4:
            $perencanaan_kegiatan_pagu_dak_fisik_4+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $perencanaan_kegiatan_pagu_dak_fisik_4_reguler+=$d->perencanaan_kegiatan_pagu_dak_fisik_reguler;
            $perencanaan_kegiatan_pagu_dak_fisik_4_penugasan+=$d->perencanaan_kegiatan_pagu_dak_fisik_penugasan;
            $perencanaan_kegiatan_pagu_dak_fisik_4_affirmasi+=$d->perencanaan_kegiatan_pagu_dak_fisik_affirmasi;
            $perencanaan_kegiatan_pagu_dak_fisik_4_non_fisik+=$d->perencanaan_kegiatan_pagu_dak_fisik_non_fisik;

            $realisasi_keuangan_4+=$d->realisasi_keuangan;
            $realisasi_keuangan_4_reguler+=$d->realisasi_keuangan_reguler;
            $realisasi_keuangan_4_penugasan+=$d->realisasi_keuangan_penugasan;
            $realisasi_keuangan_4_affirmasi+=$d->realisasi_keuangan_affirmasi;
            $realisasi_keuangan_4_non_fisik+=$d->realisasi_keuangan_non_fisik;

            $realisasi_fisik_volume_4=$d->realisasi_fisik_volume;
            $realisasi_fisik_volume_4_reguler=$d->realisasi_fisik_volume_reguler;
            $realisasi_fisik_volume_4_penugasan=$d->realisasi_fisik_volume_penugasan;
            $realisasi_fisik_volume_4_affirmasi=$d->realisasi_fisik_volume_affirmasi;
            $realisasi_fisik_volume_4_non_fisik=$d->realisasi_fisik_volume_non_fisik;

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
              'pagu'=>$perencanaan_kegiatan_pagu_dak_fisik_1,
              'keuangan_reguler'=>$realisasi_keuangan_1_reguler,
              'volume_fisik_reguler'=>$realisasi_fisik_volume_1_reguler,
              'pagu_reguler'=>$perencanaan_kegiatan_pagu_dak_fisik_1_reguler,
              'keuangan_penugasan'=>$realisasi_keuangan_1_penugasan,
              'volume_fisik_penugasan'=>$realisasi_fisik_volume_1_penugasan,
              'pagu_penugasan'=>$perencanaan_kegiatan_pagu_dak_fisik_1_penugasan,
              'keuangan_affirmasi'=>$realisasi_keuangan_1_affirmasi,
              'volume_fisik_affirmasi'=>$realisasi_fisik_volume_1_affirmasi,
              'pagu_affirmasi'=>$perencanaan_kegiatan_pagu_dak_fisik_1_affirmasi,
              'keuangan_non_fisik'=>$realisasi_keuangan_1_non_fisik,
              'volume_fisik_non_fisik'=>$realisasi_fisik_volume_1_non_fisik,
              'pagu_non_fisik'=>$perencanaan_kegiatan_pagu_dak_fisik_1_non_fisik,

            ],
          '2'=>[
              'keuangan'=>$realisasi_keuangan_2,
              'volume_fisik'=>$realisasi_fisik_volume_2,
              'pagu'=>$perencanaan_kegiatan_pagu_dak_fisik_2,
              'keuangan_reguler'=>$realisasi_keuangan_2_reguler,
              'volume_fisik_reguler'=>$realisasi_fisik_volume_2_reguler,
              'pagu_reguler'=>$perencanaan_kegiatan_pagu_dak_fisik_2_reguler,
              'keuangan_penugasan'=>$realisasi_keuangan_2_penugasan,
              'volume_fisik_penugasan'=>$realisasi_fisik_volume_2_penugasan,
              'pagu_penugasan'=>$perencanaan_kegiatan_pagu_dak_fisik_2_penugasan,
              'keuangan_affirmasi'=>$realisasi_keuangan_2_affirmasi,
              'volume_fisik_affirmasi'=>$realisasi_fisik_volume_2_affirmasi,
              'pagu_affirmasi'=>$perencanaan_kegiatan_pagu_dak_fisik_2_affirmasi,
              'keuangan_non_fisik'=>$realisasi_keuangan_2_non_fisik,
              'volume_fisik_non_fisik'=>$realisasi_fisik_volume_2_non_fisik,
              'pagu_non_fisik'=>$perencanaan_kegiatan_pagu_dak_fisik_2_non_fisik,
            ],
          '3'=>[
              'keuangan'=>$realisasi_keuangan_3,
              'volume_fisik'=>$realisasi_fisik_volume_3,
              'pagu'=>$perencanaan_kegiatan_pagu_dak_fisik_3,
              'keuangan_reguler'=>$realisasi_keuangan_3_reguler,
              'volume_fisik_reguler'=>$realisasi_fisik_volume_3_reguler,
              'pagu_reguler'=>$perencanaan_kegiatan_pagu_dak_fisik_3_reguler,
              'keuangan_penugasan'=>$realisasi_keuangan_3_penugasan,
              'volume_fisik_penugasan'=>$realisasi_fisik_volume_3_penugasan,
              'pagu_penugasan'=>$perencanaan_kegiatan_pagu_dak_fisik_3_penugasan,
              'keuangan_affirmasi'=>$realisasi_keuangan_3_affirmasi,
              'volume_fisik_affirmasi'=>$realisasi_fisik_volume_3_affirmasi,
              'pagu_affirmasi'=>$perencanaan_kegiatan_pagu_dak_fisik_3_affirmasi,
              'keuangan_non_fisik'=>$realisasi_keuangan_3_non_fisik,
              'volume_fisik_non_fisik'=>$realisasi_fisik_volume_3_non_fisik,
              'pagu_non_fisik'=>$perencanaan_kegiatan_pagu_dak_fisik_3_non_fisik,
            ],
          '4'=>[
              'keuangan'=>$realisasi_keuangan_4,
              'volume_fisik'=>$realisasi_fisik_volume_4,
              'pagu'=>$perencanaan_kegiatan_pagu_dak_fisik_4,
              'keuangan_reguler'=>$realisasi_keuangan_4_reguler,
              'volume_fisik_reguler'=>$realisasi_fisik_volume_4_reguler,
              'pagu_reguler'=>$perencanaan_kegiatan_pagu_dak_fisik_4_reguler,
              'keuangan_penugasan'=>$realisasi_keuangan_4_penugasan,
              'volume_fisik_penugasan'=>$realisasi_fisik_volume_4_penugasan,
              'pagu_penugasan'=>$perencanaan_kegiatan_pagu_dak_fisik_4_penugasan,
              'keuangan_affirmasi'=>$realisasi_keuangan_4_affirmasi,
              'volume_fisik_affirmasi'=>$realisasi_fisik_volume_4_affirmasi,
              'pagu_affirmasi'=>$perencanaan_kegiatan_pagu_dak_fisik_4_affirmasi,
              'keuangan_non_fisik'=>$realisasi_keuangan_4_non_fisik,
              'volume_fisik_non_fisik'=>$realisasi_fisik_volume_4_non_fisik,
              'pagu_non_fisik'=>$perencanaan_kegiatan_pagu_dak_fisik_4_non_fisik,
            ]
        ),
        'data_daerah'=>[
            '1'=>$TW1,
            '2'=>$TW2,
            '3'=>$TW3,
            '4'=>$TW4,
          ]
      );

		return view('front.realisasi.daerah.pro.index')->with(
			[
				'data'=>$return,
				'links'=>$tables,
				'daerah'=>$tables[0],
				'list_d'=>$list_d
			]
		);



    }



    public function perbidang(Request $request){
      $in="'KEGIATAN','SUB KEGIATAN','DETAIL SUB KEGIATAN','KEGIATAN (SILPA)'";

       $kat=1;
        if($request->kat){
          $kat=$request->kat;
        }

        $tw=1;
        if($request->tw){
          $tw=$request->tw;
        }

        $kode_daerah=11;
        if($request->kode_daerah){
          $tw=$request->kode_daerah;
        }

       $tahun=HP::front_tahun();

      $master=DB::table('mastering_bidang_'.$tahun)->where('kategori_dak',$kat)->get();
      $bidang=[];
      foreach($master as $d){
        $bidang[$d->kode]=$d;
      }

      $ids=array_keys($bidang);

      
      $daerah=DB::table('master_daerah')->where('id',$kode_daerah)->first();


     $data=DB::table('master_daerah as p')
      ->leftJoin($daerah->table_name.'_'.$tahun .' as d',function ($q){
        return $q->on('d.provinsi','=','p.id_pro')->on('d.kota_kab','=','p.id_kota');
      })
      ->select(
        'p.nama as nama_daerah',
        'p.id_kota',
        'p.id as kode_daerah',
        'd.id_bidang_db',
        DB::raw("case when d.id is not null then 'MELAPOR' else 'TIDAK MELAPOR' end  as melakukan_pelaporan "),
        DB::raw("CASE WHEN d.kolom='BIDANG' then d.nama end as nama_bidang "),        
        DB::raw("sum(case when (d.kategori_dak"."=".$kat." and "."d.tw"."=".$tw." and p.id"." like ".("'".$daerah->id."%'")." and d.kolom in (".$in."))  then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as pagu"),
        DB::raw("sum(case when (d.kategori_dak"."=".$kat." and "."d.tw"."=".$tw." and p.id"." like ".("'".$daerah->id."%'")." and d.kolom in (".$in."))  then perencanaan_kegiatan_volume else 0 end ) as perencanaan_kegiatan_volume"),
        DB::raw("sum(case when (d.kategori_dak"."=".$kat." and "."d.tw"."=".$tw." and p.id"." like ".("'".$daerah->id."%'")." and d.kolom in (".$in."))  then realisasi_keuangan else 0 end ) as realisasi_keuangan"),
        DB::raw("sum(case when (d.kategori_dak"."=".$kat." and "."d.tw"."=".$tw." and p.id"." like ".("'".$daerah->id."%'")." and d.kolom in (".$in."))  then realisasi_fisik_volume else 0 end ) as realisasi_fisik_volume")
      )
      ->groupBy('p.id')
      ->groupBy('d.id_bidang_db')
      ->where('p.id','like',DB::raw("'".$daerah->id."%'"))
      ->whereIn('d.id_bidang_db',$ids)
      ->where('d.tw',$tw)  
      ->whereIn('d.kategori_dak',[$kat,null])      
      ->orderBy('p.id','ASC')

      ->get();

      dd($data);







    }
}
