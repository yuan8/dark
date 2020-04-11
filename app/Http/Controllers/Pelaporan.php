<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use HP;
class Pelaporan extends Controller
{
    //

    public function index(){
      $tahun=HP::front_tahun();
      $in="'KEGIATAN','SUB KEGIATAN','DETAIL SUB KEGIATAN','KEGIATAN (SILPA)'";

      $tables=DB::table('master_daerah')->where('kode_daerah_parent',null)->select('id','nama','table','table_name')->get();


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
          DB::raw("sum(case when kolom in(".$in.") then realisasi_keuangan else 0 end ) as realisasi_keuangan"),
          DB::raw("sum(case when kolom in (".$in.") then realisasi_fisik_volume else 0 end ) as realisasi_fisik_volume")
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

      return view('front.pelaporan.index')->with('data',$return);

    }

    public function detail_data($id,$tw=1){
      $tahun=HP::front_tahun();
      if($tw==null){
        $tw=1;
      }

      $daerah=DB::table('master_daerah')->where('id',$id)->first();


      if($daerah){
       $in=['KEGIATAN','SUB KEGIATAN','DETAIL SUB KEGIATAN','KEGIATAN (SILPA)'];
       $inq="'KEGIATAN','SUB KEGIATAN','DETAIL SUB KEGIATAN','KEGIATAN (SILPA)'";

        $look=[];

        for($k=1;$k<5;$k++){
            $look[$k]=DB::table($daerah->table_name.'_'.$tahun.' as td')
            ->select(
              DB::raw("(sum(case when kolom in (".$inq.") then perencanaan_kegiatan_pagu_dak_fisik else 0 end )) as pagu"),
              DB::raw("(sum(case when kolom in (".$inq.") then realisasi_keuangan else 0 end )) as realisasi_keuangan"),
              DB::raw("(sum(case when kolom in (".$inq.") then perencanaan_kegiatan_volume else 0 end )) as perencanaan_kegiatan_volume"),
              DB::raw("(sum(case when kolom in (".$inq.") then realisasi_fisik_volume else 0 end )) as realisasi_fisik_volume")
            )
            ->where('td.provinsi',$daerah->id_pro)
            ->where('td.kota_kab',$daerah->id_kota)
            ->where('td.tw',$k)
            ->first();
        }
      

        $data=DB::table($daerah->table_name.'_'.$tahun)
        ->where('provinsi',$daerah->id_pro)
        ->where('kota_kab',$daerah->id_kota)
        ->where('tw',$tw)
        ->orderBy('id','ASC')
        ->get();



        $data_return=array(
          'REGULER'=>[],
          'PENUGASAN'=>[],
          'AFFIRMASI'=>[],
          'NON_FISIK'=>[],

        );

        $pagu=0;
        $keuangan=0;
        $volume_fisik=0;

        $pagu_reguler=0;
        $keuangan_reguler=0;
        $volume_fisik_reguler=0;

        $pagu_penugasan=0;
        $keuangan_penugasan=0;
        $volume_fisik_penugasan=0;

        $pagu_affirmasi=0;
        $keuangan_affirmasi=0;
        $volume_fisik_affirmasi=0;

        $pagu_non_fisik=0;
        $keuangan_non_fisik=0;

        $perbidang=[
          'REGULER'=>[],
          'PENUGASAN'=>[],
          'AFFIRMASI'=>[],
          'NON_FISIK'=>[],
        ];



        foreach($data as $d){
          switch ((int)$d->kategori_dak) {
            case 1:
              # code...
            $data_return['REGULER'][]=$d;

            if((!isset($perbidang['REGULER'][$d->id_bidang]))&&$d->kolom=='BIDANG'){
              $perbidang['REGULER'][$d->id_bidang]=[
                'nama'=>$d->nama,
                'pagu'=>0,
                'keuangan'=>0,
                'volume_fisik'=>0,
                'sub_bidang'=>[]
              ];
            }

             if((!isset($perbidang['REGULER'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]))&&$d->kolom=='SUB BIDANG'){
              $perbidang['REGULER'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]=[
                'nama'=>$d->nama,
                'pagu'=>0,
                'keuangan'=>0,
                'volume_fisik'=>0,
              ];
            }

            if(in_array($d->kolom,$in)){
              $pagu_reguler+=$d->perencanaan_kegiatan_pagu_dak_fisik;
              $keuangan_reguler+=$d->realisasi_keuangan;
              $volume_fisik_reguler+=$d->realisasi_fisik_volume;

             

              $perbidang['REGULER'][$d->id_bidang]['pagu']+=$d->perencanaan_kegiatan_pagu_dak_fisik;
              $perbidang['REGULER'][$d->id_bidang]['keuangan']+=$d->realisasi_keuangan;
              $perbidang['REGULER'][$d->id_bidang]['volume_fisik']+=$d->realisasi_fisik_volume;

              if(isset($perbidang['REGULER'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang])){

                  $perbidang['REGULER'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['pagu']+=$d->perencanaan_kegiatan_pagu_dak_fisik;

                  $perbidang['REGULER'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['keuangan']+=$d->realisasi_keuangan;
                  $perbidang['REGULER'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['volume_fisik']+=$d->realisasi_fisik_volume;
              }

            }




            break;
            case 2:
              # code...
            $data_return['PENUGASAN'][]=$d;

              if((!isset($perbidang['PENUGASAN'][$d->id_bidang]))&&$d->kolom=='BIDANG'){
              $perbidang['PENUGASAN'][$d->id_bidang]=[
                'nama'=>$d->nama,
                'pagu'=>0,
                'keuangan'=>0,
                'volume_fisik'=>0,
                'sub_bidang'=>[]
              ];
            }

             if((!isset($perbidang['PENUGASAN'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]))&&$d->kolom=='SUB BIDANG'){
              $perbidang['PENUGASAN'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]=[
                'nama'=>$d->nama,
                'pagu'=>0,
                'keuangan'=>0,
                'volume_fisik'=>0,
              ];
            }

            if(in_array($d->kolom,$in)){

              $pagu_penugasan+=$d->perencanaan_kegiatan_pagu_dak_fisik;
              $keuangan_penugasan+=$d->realisasi_keuangan;
              $volume_fisik_penugasan+=$d->realisasi_fisik_volume;



              $perbidang['PENUGASAN'][$d->id_bidang]['pagu']+=$d->perencanaan_kegiatan_pagu_dak_fisik;
              $perbidang['PENUGASAN'][$d->id_bidang]['keuangan']+=$d->realisasi_keuangan;
              $perbidang['PENUGASAN'][$d->id_bidang]['volume_fisik']+=$d->realisasi_fisik_volume;


              if(isset($perbidang['PENUGASAN'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang])){

                  $perbidang['PENUGASAN'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['pagu']+=$d->perencanaan_kegiatan_pagu_dak_fisik;

                  $perbidang['PENUGASAN'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['keuangan']+=$d->realisasi_keuangan;
                  $perbidang['PENUGASAN'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['volume_fisik']+=$d->realisasi_fisik_volume;
              }

            }

              break;
           case 3:
              # code...
            $data_return['AFFIRMASI'][]=$d;

              if((!isset($perbidang['AFFIRMASI'][$d->id_bidang]))&&$d->kolom=='BIDANG'){
              $perbidang['AFFIRMASI'][$d->id_bidang]=[
                'nama'=>$d->nama,
                'pagu'=>0,
                'keuangan'=>0,
                'volume_fisik'=>0,
                'sub_bidang'=>[]
              ];
            }

             if((!isset($perbidang['AFFIRMASI'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]))&&$d->kolom=='SUB BIDANG'){
              $perbidang['AFFIRMASI'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]=[
                'nama'=>$d->nama,
                'pagu'=>0,
                'keuangan'=>0,
                'volume_fisik'=>0,
              ];
            }

            if(in_array($d->kolom,$in)){

              $pagu_affirmasi+=$d->perencanaan_kegiatan_pagu_dak_fisik;
              $keuangan_affirmasi+=$d->realisasi_keuangan;
              $volume_fisik_affirmasi+=$d->realisasi_fisik_volume;


               $perbidang['AFFIRMASI'][$d->id_bidang]['pagu']+=$d->perencanaan_kegiatan_pagu_dak_fisik;
              $perbidang['AFFIRMASI'][$d->id_bidang]['keuangan']+=$d->realisasi_keuangan;
              $perbidang['AFFIRMASI'][$d->id_bidang]['volume_fisik']+=$d->realisasi_fisik_volume;


              if(isset($perbidang['AFFIRMASI'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang])){

                  $perbidang['AFFIRMASI'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['pagu']+=$d->perencanaan_kegiatan_pagu_dak_fisik;

                  $perbidang['AFFIRMASI'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['keuangan']+=$d->realisasi_keuangan;
                  $perbidang['AFFIRMASI'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['volume_fisik']+=$d->realisasi_fisik_volume;
              }
            }

              break;
           case 4:
              # code...
            $data_return['NON_FISIK'][]=$d;

              if((!isset($perbidang['NON_FISIK'][$d->id_bidang]))&&$d->kolom=='BIDANG'){
              $perbidang['NON_FISIK'][$d->id_bidang]=[
                'nama'=>$d->nama,
                'pagu'=>0,
                'keuangan'=>0,
                'volume_fisik'=>0,
                'sub_bidang'=>[]
              ];
            }

             if((!isset($perbidang['NON_FISIK'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]))&&$d->kolom=='SUB BIDANG'){
              $perbidang['NON_FISIK'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]=[
                'nama'=>$d->nama,
                'pagu'=>0,
                'keuangan'=>0,
                'volume_fisik'=>0,
              ];
            }

            if(in_array($d->kolom,$in)){

              $pagu_non_fisik+=$d->perencanaan_kegiatan_pagu_dak_fisik;
              $keuangan_non_fisik+=$d->realisasi_keuangan;
              // $volume_fisik_non_fisik+=$d->realisasi_fisik_volume;


              $perbidang['NON_FISIK'][$d->id_bidang]['pagu']+=$d->perencanaan_kegiatan_pagu_dak_fisik;
              $perbidang['NON_FISIK'][$d->id_bidang]['keuangan']+=$d->realisasi_keuangan;
              // $perbidang['AFFIRMASI'][$d->id_bidang]['volume_fisik']+=$d->realisasi_fisik_volume;


              if(isset($perbidang['NON_FISIK'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang])){

                  $perbidang['NON_FISIK'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['pagu']+=$d->perencanaan_kegiatan_pagu_dak_fisik;

                  $perbidang['NON_FISIK'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['keuangan']+=$d->realisasi_keuangan;
                  // $perbidang['AFFIRMASI'][$d->id_bidang]['sub_bidang'][$d->id_sub_bidang]['volume_fisik']+=$d->realisasi_fisik_volume;
              }
            }

              break;
            
            default:
              # code...
              break;
          }

            if(in_array($d->kolom,$in)){
              $pagu+=$d->perencanaan_kegiatan_pagu_dak_fisik;
              $keuangan+=$d->realisasi_keuangan;
              $volume_fisik+=$d->realisasi_fisik_volume;

            }
        }

        $detail=array(

          'REGULER'=>[
            'pagu'=>$pagu_reguler,
            'keuangan'=>$keuangan_reguler,
            'volume_fisik'=>$volume_fisik_reguler,
          ],
           'PENUGASAN'=>[
            'pagu'=>$pagu_penugasan,
            'keuangan'=>$keuangan_penugasan,
            'volume_fisik'=>$volume_fisik_penugasan,
          ],
          'AFFIRMASI'=>[
            'pagu'=>$pagu_affirmasi,
            'keuangan'=>$keuangan_affirmasi,
            'volume_fisik'=>$volume_fisik_affirmasi,
          ],
          'NON_FISIK'=>[
            'pagu'=>$pagu_non_fisik,
            'keuangan'=>$keuangan_non_fisik,
            // 'volume_fisik'=>$volume_fisik_non_fisik,
          ],
          'REKAP'=>[
             'pagu'=>$pagu,
            'keuangan'=>$keuangan,
            'volume_fisik'=>$volume_fisik,
          ]

        );


        return view('front.pelaporan.detail')->with(['data'=>$data_return,'tw'=>$tw,'daerah'=>$daerah,'detail'=>$detail,'perbidang'=>$perbidang,'timeline'=>$look]);

      }else{
        return abort('404');
      }
    }

    public function map($tw=1){
      $tahun=HP::front_tahun();
      $daerah=DB::table('master_daerah as d')
      ->select(
        "d.id as kode_daerah",
        "d.nama",
        "d.table_name",
        DB::raw("(select count(*) from  master_daerah where id_pro = d.id_pro) as jumlah_daerah"),
       DB::raw( "0 as jumlah_daerah_melapor"),
       DB::raw( "0 as persentase"),
       DB::raw( "'#222' as color")



      )
      ->orderBy('d.id','ASC')
      ->where('kode_daerah_parent',null)->get();

      $retrun=[];
      foreach ($daerah as $key => $value) {
        $daerah[$key]->jumlah_daerah_melapor=count(DB::table($value->table_name.'_'.$tahun)
        ->select(
          "provinsi",
          "kota_kab"
        )
        ->where('tw',$tw)
        ->groupBy('provinsi')
        ->groupBy('kota_kab')
        ->get());

        $daerah[$key]->persentase=round(($daerah[$key]->jumlah_daerah_melapor*100/$daerah[$key]->jumlah_daerah),2);
        $color='#222';
        switch (true) {
          case ($daerah[$key]->persentase>80):
            # code...
          $color="#00FF00";
            break;
          case ($daerah[$key]->persentase>60):
            # code...
          $color="#FFFF00";
            break;
          case ($daerah[$key]->persentase>40):
            # code...
          $color="#2C4F9B";
            break;
          case ($daerah[$key]->persentase>30):
            # code...
          $color="#cf6317";
            break;
          case ($daerah[$key]->persentase>1):
            # code...
          $color="#FF0000";
            break;

          default:
            # code...
          $color='#222';
            break;
        }

        $daerah[$key]->color=$color;

        $return[$value->kode_daerah]=(array)$daerah[$key];


      }


      return view('front.pelaporan.map.index')->with([
        'data_pro'=>$return,
        'tw'=>$tw
      ]);
    }


    public function map_pro($kode_daerah,$tahun,$tw=1){
        $daerah=DB::table('master_daerah')->where('id',$kode_daerah)->first();
        if($daerah){
          $list_daerah=DB::table('master_daerah')->where('id','like',($kode_daerah.'%'))->orderBy('id','ASC')->get();
          $data_return=['lat'=>$daerah->lat,'lng'=>$daerah->lang,'geojsonlink'=>url('map/'.$daerah->geojsonfile),'nama'=>$daerah->nama,'tahun'=>$tahun,'tw'=>$tw,'data'=>[]];
          foreach ($list_daerah as $key => $d) {
              $data=DB::select("select * from (select kategori_dak,id_bidang_db,(case when kolom='BIDANG' then nama end) as nama ,sum(perencanaan_kegiatan_pagu_dak_fisik) as l
                from ".$daerah->table_name.'_'.$tahun." where provinsi = ".$d->id_pro." and kota_kab = ".$d->id_kota." and tw = ".$tw."
                group by id_bidang_db,kategori_dak ) as j
                where l>0");

               $dr_r=[
                  'NAMA_DAERAH'=>$d->nama,
                  'KODE_DAERAH'=>$d->id,
                  'MELAPOR'=>0,
                  'REGULER'=>['tersedia'=>0,'data'=>[]],
                  'PENUGASAN'=>['tersedia'=>0,'data'=>[]],
                  'AFFIRMASI'=>['tersedia'=>0,'data'=>[]],
                  'NON_FISIK'=>['tersedia'=>0,'data'=>[]],
                  'TOTAL_KAT'=>0,
                  'TOTAL_KAT_TERSEDIA'=>11,
                  'PERSENTASE'=>0,
                  'COLOR'=>'#222'
                ];

              if($data){
                $dr_r['MELAPOR']=1;
                foreach ($data as $key => $v) {
                  switch ($v->kategori_dak) {
                    case 1:
                    $dr_r['REGULER']['data'][]=$v;
                    $dr_r['TOTAL_KAT']+=1;
                    break;
                    case 2:
                    $dr_r['PENUGASAN']['data'][]=$v;
                    $dr_r['TOTAL_KAT']+=1;
                    case 3:
                    $dr_r['AFFIRMASI']['data'][]=$v;
                    $dr_r['TOTAL_KAT']+=1;
                    case 4:
                    $dr_r['AFFIRMASI']['data'][]=$v;
                    $dr_r['TOTAL_KAT']+=1;
                    break;
                    
                    default:
                      # code...
                      break;
                  }
                }

              }else{

              }

              $color='#222';
              if($dr_r['TOTAL_KAT']!=0){
                $dr_r['PERSENTASE']=round($dr_r['TOTAL_KAT']*100/$dr_r['TOTAL_KAT_TERSEDIA'],3);
              }
              switch (true) {
              case ($dr_r['PERSENTASE']>80):
                # code...
              $color="#00FF00";
                break;
              case ($dr_r['PERSENTASE']>60):
                # code...
              $color="#FFFF00";
                break;
              case ($dr_r['PERSENTASE']>40):
                # code...
              $color="#2C4F9B";
                break;
              case ($dr_r['PERSENTASE']>30):
                # code...
              $color="#cf6317";
                break;
              case ($dr_r['PERSENTASE']>1):
                # code...
              $color="#FF0000";
                break;

              default:
                # code...
              $color='#222';
                break;
            }

            $dr_r['COLOR']=$color;
            $data_return['data'][$d->id_kota]=$dr_r;

          }

         

          return view('front.pelaporan.map.detail_pro')->with('data',$data_return);

        }

    }
}
