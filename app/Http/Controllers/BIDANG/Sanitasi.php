<?php

namespace App\Http\Controllers\BIDANG;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use HP;

class Sanitasi extends Controller
{
    //

    public function index(Request $request){

    	$tw=1;
    	if($request->tw){
    		$tw=$request->tw;
    	}
    	$kode_daerah=11;

    	if($request->kode_daerah){
    		$kode_daerah=(int)$request->kode_daerah;
    	}

    	$kat=1;
    	if($request->kat){
    		$kat=$request->kat;
    	}
    	$map=array(
    		'1'=>4,
    		'2'=>15,
    		'3'=>25,
    		'4'=>'null'
    	);

    	$kategory='REGULER';
    	switch ($kat) {
    		case 1:
    			# code...
    		$kategory='REGULER';


    			break;
    		case 2:
    			# code...
    		$kategory='PENUGASAN';


    			break;
    		case 3:
    			# code...
    		$kategory='AFFIRMASI';


    			break;
    		case 4:
    			# code...
    		$kategory='NON FISIK';

    			break;
    		
    		default:
    			# code...
    			break;
    	}

    	$daerah=DB::table('master_daerah')->find($kode_daerah);
    	$tahun=HP::front_tahun();

    	$in="'KEGIATAN','SUB KEGIATAN','DETAIL SUB KEGIATAN','KEGIATAN (SILPA)'";
    	$in2="'KEGIATAN','SUB KEGIATAN','DETAIL SUB KEGIATAN','KEGIATAN (SILPA)',NULL";

    	DB::enableQueryLog();


    	$data=DB::table('master_daerah as p')
    	->leftJoin($daerah->table_name.'_'.$tahun .' as d',function ($q){
    		return $q->on('d.provinsi','=','p.id_pro')->on('d.kota_kab','=','p.id_kota');
    	})
    	->select(
    		'p.nama as nama_daerah',
    		'p.id_kota',
    		'p.id as kode_daerah',
    		DB::raw("case when d.id is not null then 'MELAPOR' else 'TIDAK MELAPOR' end  as melakukan_pelaporan "),
			DB::raw("CASE WHEN d.kolom='BIDANG' then d.nama end as nama_bidang "),    		
    		DB::raw("sum(case when (d.kategori_dak"."=".$kat." and "."d.tw"."=".$tw." and "."d.id_bidang_db"."=".$map[$kat]." and p.id"." like ".("'".$daerah->id."%'")." and d.kolom in (".$in."))  then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as pagu"),
    		DB::raw("sum(case when (d.kategori_dak"."=".$kat." and "."d.tw"."=".$tw." and "."d.id_bidang_db"."=".$map[$kat]." and p.id"." like ".("'".$daerah->id."%'")." and d.kolom in (".$in."))  then perencanaan_kegiatan_volume else 0 end ) as perencanaan_kegiatan_volume"),
    		DB::raw("sum(case when (d.kategori_dak"."=".$kat." and "."d.tw"."=".$tw." and "."d.id_bidang_db"."=".$map[$kat]." and p.id"." like ".("'".$daerah->id."%'")." and d.kolom in (".$in."))  then realisasi_keuangan else 0 end ) as realisasi_keuangan"),
    		DB::raw("sum(case when (d.kategori_dak"."=".$kat." and "."d.tw"."=".$tw." and "."d.id_bidang_db"."=".$map[$kat]." and p.id"." like ".("'".$daerah->id."%'")." and d.kolom in (".$in."))  then realisasi_fisik_volume else 0 end ) as realisasi_fisik_volume")
    	)
    	->groupBy('p.id')
    	->where('p.id','like',DB::raw("'".$daerah->id."%'"))

    
    	
    	->get();


    	$daerahs=DB::table('master_daerah')->where('kode_daerah_parent',null)->get();

    	
    	return view('perbidang.sanitasi')->with('data',$data)->with('tw',$tw)->with('kategory',$kategory)->with('bidang','Sanitasi')->with('kat',$kat)->with('daerahs',$daerahs)->with('kode_daerah',$kode_daerah);

    }
}
