<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HP;
use DB;
class RelDaerah extends Controller
{
    //
    public function index($tw=1,Request $request){


    	$tahun=HP::front_tahun();
    	$daerah=DB::table('master_daerah')
    	->where('kode_daerah_parent',null)
    	->orderBy(DB::raw("id::numeric"),'ASC');

        $list_d=$daerah->get();

    	if($request->p){
    		$daerah=$daerah->where('id',$request->p);
    	}
      	$in="'KEGIATAN','SUB KEGIATAN','DETAIL SUB KEGIATAN','KEGIATAN (SILPA)'";


    	$daerah=$daerah->paginate(1)->appends(['p'=>$request->p]);
    	$data_return=[];

    	foreach ($daerah as $key => $t) {
    		$data=DB::table('master_daerah as d')
    			->leftJoin(($tahun.$t->table.' as dt'),function($q)use ($tw){
    			 $q->on('dt.provinsi', '=', 'd.id_pro')->on('dt.kota_kab', '=', 'd.id_kota')
    			 ->where('dt.tw', '=',$tw );
    		})
    		->select(
    			"d.nama as nama_daerah",
                "d.id as kode_daerah",
    			DB::raw("count(dt.*) as count"),
    			DB::raw("sum(case when dt.kolom in (".$in.") then perencanaan_kegiatan_pagu_dak_fisik else 0 end ) as perencanaan_kegiatan_pagu_dak_fisik"),

    			DB::raw("sum(case when dt.kolom in (".$in.") then realisasi_keuangan else 0 end ) as realisasi_keuangan"),
    			DB::raw("sum(case when dt.kolom in (".$in.") then realisasi_fisik_volume else 0 end ) as realisasi_fisik_volume"),
    			DB::raw("max(url) as file")

    		)
    		->where('d.id','ilike',$t->id.'%')
    		->groupBy('d.id')
    		->orderBy('d.id','ASC')

    		->get()->toArray();
    		// dd(DB::getQueryLog());

    		$data_return=array_merge($data_return,(array)$data);




    	}

    	return view('front.realisasi.daerah.kab.index')->with([
    		'data'=>$data_return,
    		'tw'=>$tw,
    		'daerah'=>$daerah[0],
    		'link'=>$daerah,
            'list_d'=>$list_d
    	]);



    }
}
