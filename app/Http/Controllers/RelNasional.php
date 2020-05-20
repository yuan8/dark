<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HP;
use DB;

class RelNasional extends Controller
{
    public function index(){
      $tahun=HP::front_tahun();

      $in="'KEGIATAN','SUB KEGIATAN','DETAIL SUB KEGIATAN','KEGIATAN (SILPA)'";
      $tables=DB::table('master_daerah')->where('kode_daerah_parent',null)->select('id','nama','table','table_name')->get();
      $data_daerah=[];
      $data_return=[];
      foreach ($tables as $key => $table) {
        $data=DB::table($table->table_name.'_'.$tahun.' as dd')
        ->select(
          // DB::raw("(case when dd.kota_kab is null then dd.provinsi else dd.kota_kab end) as kode_daerah"),
          DB::raw("(select nama from master_daerah as d where id_pro=dd.provinsi and id_kota=dd.kota_kab limit 1) as nama_daerah"),
          DB::raw("(select id from master_daerah as d where id_pro=dd.provinsi and id_kota=dd.kota_kab limit 1) as kode_daerah"),
          'dd.tw',
          DB::raw("max(dd.url) as file_path") ,
          DB::raw("sum(case when kolom in (".$in.") then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as pagu"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =1) then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as pagu_reguler"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =2) then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as pagu_penugasan"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =3) then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as pagu_affirmasi"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =4) then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as pagu_non_fisik"),
          DB::raw("sum(case when kolom in (".$in.") then realisasi_keuangan else 0 end ) as realisasi_keuangan"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =1) then realisasi_keuangan else 0 end ) as realisasi_keuangan_reguler"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =2) then realisasi_keuangan else 0 end ) as realisasi_keuangan_penugasan"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =3) then realisasi_keuangan else 0 end ) as realisasi_keuangan_affirmasi"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =4) then realisasi_keuangan else 0 end ) as realisasi_keuangan_non_fisik"),
            DB::raw("sum(case when kolom in (".$in.") then perencanaan_kegiatan_volume else 0 end ) as perencanaan_volume"),

          DB::raw("sum(case when kolom in (".$in.") then realisasi_fisik_volume else 0 end ) as realisasi_volume"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =1) then realisasi_fisik_volume else 0 end ) as realisasi_volume_reguler"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =2) then realisasi_fisik_volume else 0 end ) as realisasi_volume_penugasan"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =3) then realisasi_fisik_volume else 0 end ) as realisasi_volume_affirmasi"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =4) then realisasi_fisik_volume else 0 end ) as realisasi_volume_non_fisik"),
           //  DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =1) then perencanaan_kegiatan_volume else 0 end ) as perencanaan_volume_reguler"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =2) then perencanaan_kegiatan_volume else 0 end ) as perencanaan_volume_penugasan"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =3) then perencanaan_kegiatan_volume else 0 end ) as perencanaan_volume_affirmasi"),
           // DB::raw("sum(case when (kolom in (".$in.") and kategori_dak =4) then perencanaan_kegiatan_volume else 0 end ) as perencanaan_volume_non_fisik"),
           'kategori_dak'
        )
        ->orderBy('dd.tw','asc')
        ->orderBy('kode_daerah','asc')
        ->groupBy(['provinsi','kota_kab','tw','kategori_dak'])
        ->get()->toArray();

        $data_daerah=array_merge($data_daerah,$data);
      }

      foreach ($data_daerah as  $data) {

        $data_return['DATA_PERTW'][$data->tw][$data->kode_daerah]['nama_daerah']=$data->nama_daerah;
        $data_return['DATA_PERTW'][$data->tw][$data->kode_daerah]['kode']=$data->kode_daerah;

        $data_return['DATA_PERTW_PER_KAT'][$data->tw][$data->kategori_dak][$data->kode_daerah]['nama_daerah']=$data->nama_daerah;
        $data_return['DATA_PERTW_PER_KAT'][$data->tw][$data->kategori_dak][$data->kode_daerah]['kode']=$data->kode_daerah;

        foreach ($data as $key => $d) {



          if(!in_array($key, ['kategori_dak','tw','file_path','kode_daerah','nama_daerah'])){


               if(in_array($data->kategori_dak,[1,2,3])){
              
              if(!isset($data_return['FISIK'][$data->tw][$key])){
                $data_return['FISIK'][$data->tw][$key]=0;
              }

               $data_return['FISIK'][$data->tw][$key]+=$d;
            
            }else{

              if(!isset($data_return['NON_FISIK'][$data->tw][$key])){
                $data_return['NON_FISIK'][$data->tw][$key]=0;
              }
              
              $data_return['NON_FISIK'][$data->tw][$key]+=$d;

            }



            if(!isset($data_return['DATA_PERTW'][$data->tw][$data->kode_daerah][$key])){
              $data_return['DATA_PERTW'][$data->tw][$data->kode_daerah][$key]=0;
            }
            $data_return['DATA_PERTW'][$data->tw][$data->kode_daerah][$key]+=$d;

            if(!isset( $data_return['DATA_PERTW_PER_KAT'][$data->tw][$data->kategori_dak][$data->kode_daerah][$key])){
               $data_return['DATA_PERTW_PER_KAT'][$data->tw][$data->kategori_dak][$data->kode_daerah][$key]=0;
            }
            $data_return['DATA_PERTW_PER_KAT'][$data->tw][$data->kategori_dak][$data->kode_daerah][$key]+=$d;

            if(!isset($data_return['PERTW'][$data->tw][$key])){
              $data_return['PERTW'][$data->tw][$key]=0;
            }

            $data_return['PERTW'][$data->tw][$key]+=$d;

            if(!isset($data_return['PERTW_PER_KAT'][$data->tw][$data->kategori_dak][$key]) ){
              $data_return['PERTW_PER_KAT'][$data->tw][$data->kategori_dak][$key]=0;
            }

            $data_return['PERTW_PER_KAT'][$data->tw][$data->kategori_dak][$key]+=$d;

          }


        }


      }

      for($key=1; $key<5; $key++){
        
        if(!isset($data_return['DATA_PERTW'][$key])){
          $data_return['DATA_PERTW'][$key]=[];
        }else{
          $data_return['DATA_PERTW'][$key]=array_values($data_return['DATA_PERTW'][$key]);
        }

        for($i=1;$i<5;$i++){
          if(!isset($data_return['DATA_PERTW_PER_KAT'][$key][$i])){
            $data_return['DATA_PERTW_PER_KAT'][$key][$i]=[];
          }else{
            $data_return['DATA_PERTW_PER_KAT'][$key][$i]=array_values($data_return['DATA_PERTW_PER_KAT'][$key][$i]); 
          }

        }
      }


      return view('front.realisasi.nas.index')->with('data',$data_return);


      $TW1=[];
      $TW2=[];
      $TW3=[];
      $TW4=[];

      $PERKATEGORY=[];

      $pagu_1=0;
      $pagu_1_reguler=0;
      $pagu_1_penugasan=0;
      $pagu_1_affirmasi=0;
      $pagu_1_non_fisik=0;

      $pagu_2=0;
      $pagu_2_reguler=0;
      $pagu_2_penugasan=0;
      $pagu_2_affirmasi=0;
      $pagu_2_non_fisik=0;

      $pagu_3=0;
      $pagu_3_reguler=0;
      $pagu_3_penugasan=0;
      $pagu_3_affirmasi=0;
      $pagu_3_non_fisik=0;

      $pagu_4=0;
      $pagu_4_reguler=0;
      $pagu_4_penugasan=0;
      $pagu_4_affirmasi=0;
      $pagu_4_non_fisik=0;

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

      $PERTW=[];
      $REKAPNAS=[];
      $REKAP_PERKATEGORY=[];

      
      foreach($data_daerah as $d){

        $PERKATEGORY[$d->tw][$d->kategori_dak][]=$d;
        
        $PERTW[$d->tw][]=$d;



        switch ((int)$d->tw) {
            case 1:
            // code...
            $TW1[]=(array)$d;
            $pagu_1+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $pagu_1_reguler+=$d->pagu_reguler;
            $pagu_1_penugasan+=$d->pagu_penugasan;
            $pagu_1_affirmasi+=$d->pagu_affirmasi;
            $pagu_1_non_fisik+=$d->pagu_non_fisik;

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
            $pagu_2+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $pagu_2_reguler+=$d->pagu_reguler;
            $pagu_2_penugasan+=$d->pagu_penugasan;
            $pagu_2_affirmasi+=$d->pagu_affirmasi;
            $pagu_2_non_fisik+=$d->pagu_non_fisik;

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
            $pagu_3+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $pagu_3_reguler+=$d->pagu_reguler;
            $pagu_3_penugasan+=$d->pagu_penugasan;
            $pagu_3_affirmasi+=$d->pagu_affirmasi;
            $pagu_3_non_fisik+=$d->pagu_non_fisik;

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
            $pagu_4+=$d->perencanaan_kegiatan_pagu_dak_fisik;
            $pagu_4_reguler+=$d->pagu_reguler;
            $pagu_4_penugasan+=$d->pagu_penugasan;
            $pagu_4_affirmasi+=$d->pagu_affirmasi;
            $pagu_4_non_fisik+=$d->pagu_non_fisik;

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
              'pagu'=>$pagu_1,
              'keuangan_reguler'=>$realisasi_keuangan_1_reguler,
              'volume_fisik_reguler'=>$realisasi_fisik_volume_1_reguler,
              'pagu_reguler'=>$pagu_1_reguler,
              'keuangan_penugasan'=>$realisasi_keuangan_1_penugasan,
              'volume_fisik_penugasan'=>$realisasi_fisik_volume_1_penugasan,
              'pagu_penugasan'=>$pagu_1_penugasan,
              'keuangan_affirmasi'=>$realisasi_keuangan_1_affirmasi,
              'volume_fisik_affirmasi'=>$realisasi_fisik_volume_1_affirmasi,
              'pagu_affirmasi'=>$pagu_1_affirmasi,
              'keuangan_non_fisik'=>$realisasi_keuangan_1_non_fisik,
              'volume_fisik_non_fisik'=>$realisasi_fisik_volume_1_non_fisik,
              'pagu_non_fisik'=>$pagu_1_non_fisik,

            ],
          '2'=>[
              'keuangan'=>$realisasi_keuangan_2,
              'volume_fisik'=>$realisasi_fisik_volume_2,
              'pagu'=>$pagu_2,
              'keuangan_reguler'=>$realisasi_keuangan_2_reguler,
              'volume_fisik_reguler'=>$realisasi_fisik_volume_2_reguler,
              'pagu_reguler'=>$pagu_2_reguler,
              'keuangan_penugasan'=>$realisasi_keuangan_2_penugasan,
              'volume_fisik_penugasan'=>$realisasi_fisik_volume_2_penugasan,
              'pagu_penugasan'=>$pagu_2_penugasan,
              'keuangan_affirmasi'=>$realisasi_keuangan_2_affirmasi,
              'volume_fisik_affirmasi'=>$realisasi_fisik_volume_2_affirmasi,
              'pagu_affirmasi'=>$pagu_2_affirmasi,
              'keuangan_non_fisik'=>$realisasi_keuangan_2_non_fisik,
              'volume_fisik_non_fisik'=>$realisasi_fisik_volume_2_non_fisik,
              'pagu_non_fisik'=>$pagu_2_non_fisik,
            ],
          '3'=>[
              'keuangan'=>$realisasi_keuangan_3,
              'volume_fisik'=>$realisasi_fisik_volume_3,
              'pagu'=>$pagu_3,
              'keuangan_reguler'=>$realisasi_keuangan_3_reguler,
              'volume_fisik_reguler'=>$realisasi_fisik_volume_3_reguler,
              'pagu_reguler'=>$pagu_3_reguler,
              'keuangan_penugasan'=>$realisasi_keuangan_3_penugasan,
              'volume_fisik_penugasan'=>$realisasi_fisik_volume_3_penugasan,
              'pagu_penugasan'=>$pagu_3_penugasan,
              'keuangan_affirmasi'=>$realisasi_keuangan_3_affirmasi,
              'volume_fisik_affirmasi'=>$realisasi_fisik_volume_3_affirmasi,
              'pagu_affirmasi'=>$pagu_3_affirmasi,
              'keuangan_non_fisik'=>$realisasi_keuangan_3_non_fisik,
              'volume_fisik_non_fisik'=>$realisasi_fisik_volume_3_non_fisik,
              'pagu_non_fisik'=>$pagu_3_non_fisik,
            ],
          '4'=>[
              'keuangan'=>$realisasi_keuangan_4,
              'volume_fisik'=>$realisasi_fisik_volume_4,
              'pagu'=>$pagu_4,
              'keuangan_reguler'=>$realisasi_keuangan_4_reguler,
              'volume_fisik_reguler'=>$realisasi_fisik_volume_4_reguler,
              'pagu_reguler'=>$pagu_4_reguler,
              'keuangan_penugasan'=>$realisasi_keuangan_4_penugasan,
              'volume_fisik_penugasan'=>$realisasi_fisik_volume_4_penugasan,
              'pagu_penugasan'=>$pagu_4_penugasan,
              'keuangan_affirmasi'=>$realisasi_keuangan_4_affirmasi,
              'volume_fisik_affirmasi'=>$realisasi_fisik_volume_4_affirmasi,
              'pagu_affirmasi'=>$pagu_4_affirmasi,
              'keuangan_non_fisik'=>$realisasi_keuangan_4_non_fisik,
              'volume_fisik_non_fisik'=>$realisasi_fisik_volume_4_non_fisik,
              'pagu_non_fisik'=>$pagu_4_non_fisik,
            ]
        ),
        'data_per_kategori'=>$PERKATEGORY,
        'data_daerah'=>[
            '1'=>$TW1,
            '2'=>$TW2,
            '3'=>$TW3,
            '4'=>$TW4,
          ]
      );

// dd($return['data_daerah']['2']);

      return view('front.realisasi.nas.index')->with('data',$return);
    }






    public function perbidang(Request $request){
         $tahun=HP::front_tahun();

        if($request->kat){
          $kat=$request->kat;
        }

        $tw=1;
        if($request->tw){
          $tw=$request->tw;
        }
         $data=DB::table('mastering_bidang_'.$tahun)->get();
         $bidang=[
          1=>[],
          2=>[],
          3=>[],
          4=>[]
         ];

         foreach ($data as $key => $value) {
            if(!isset($bidang[$value->kategori_dak][$value->kode])){
              $bidang[$value->kategori_dak][$value->kode]=array(
                'nama'=>$value->nama,
                'data'=>[
                  "pagu"=>0,
                  "realisasi_keuangan"=>0,
                  "perencanaan_kegiatan_volume"=>0,
                  "realisasi_fisik_volume"=>0,
                  "realisasi_fisik_volume_persen"=>0,
                  "provinsi"=>[]
                ]
              );
            }
         }
      $in="'KEGIATAN','SUB KEGIATAN','DETAIL SUB KEGIATAN','KEGIATAN (SILPA)'";


        foreach( DB::table('master_daerah')->where('kode_daerah_parent',null)->get() as $d){
             $datax= DB::table($d->table_name.'_'.$tahun)->select(
                'id_bidang_db as kode_bidang',
                'kategori_dak as kategori_dak',
                'provinsi as  id_pro',
                DB::RAW("'".$d->nama."'  as nama_provinsi"),
                DB::raw("sum(perencanaan_kegiatan_pagu_dak_fisik) as pagu"),
                DB::raw("sum(realisasi_keuangan) as realisasi_keuangan"),
                DB::raw("sum(perencanaan_kegiatan_volume) as perencanaan_kegiatan_volume"),
                DB::raw("sum(realisasi_fisik_volume) as realisasi_fisik_volume"),
                DB::raw(" (((sum(realisasi_fisik_volume) / sum(perencanaan_kegiatan_volume))*100) OR 0)  as  realisasi_fisik_volume_persen") 
              )
             ->where('tw',$tw)
             ->whereRaw('kolom in ('.$in.')')
             ->groupBy('id_bidang_db','kategori_dak')
             ->get();


             if($datax){
               
                foreach ($datax as $key => $data) {


                  if(isset($data->kategori_dak)){
                    if(!isset($bidang[$data->kategori_dak][$data->kode_bidang])){
                      dd($data);
                    }

                    $bidang[$data->kategori_dak][$data->kode_bidang]['data']['pagu']+=(float)$data->pagu;
                    $bidang[$data->kategori_dak][$data->kode_bidang]['data']['realisasi_keuangan']+=(float)$data->realisasi_keuangan;
                    $bidang[$data->kategori_dak][$data->kode_bidang]['data']['perencanaan_kegiatan_volume']+=(float)$data->perencanaan_kegiatan_volume;
                    $bidang[$data->kategori_dak][$data->kode_bidang]['data']['realisasi_fisik_volume']+=(float)$data->realisasi_fisik_volume;
                    $bidang[$data->kategori_dak][$data->kode_bidang]['data']['provinsi'][]=(array)$data;
                  }
                  # code...
                  }
              }

              
         }

         for ($i=0; $i <4 ; $i++) { 
           # code...
           $bidang[$i+1]=array_values($bidang[$i+1]);

         }

        return view('front.realisasi.nas.perbidang')->with('data',$bidang)->with('tw',$tw);
    }
}
