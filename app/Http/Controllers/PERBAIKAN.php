<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DB;
use Storage;
use Carbon\Carbon;
class PERBAIKAN extends Controller
{
    //

	static function getID($val){
		if(preg_match_all("!{(.*?)}!",$val,$matches)) {
                return (int)$matches[1][0];
        }else{
        	return 0;
        }
	}

	static function number($val){
		$val=str_replace(',','', trim($val,true));

		$val=(double)($val);

		return $val;

	}

    public function index($tw=1,Request $request){
    	ini_set('memory_limit','8000M');
    	$index=0;

    	$tw=(int)$tw;
    	if($request->index){
    		$index=(int)$request->index;
    	}

    	$r_index=$index;


    	$tahun=2019;
    	$kode_daerah=11;
    	if($request->kode_daerah){
    		$kode_daerah=$request->kode_daerah;
    	}

    	// $daerah=DB::table('master_daerah')->where('kode_daerah_parent',null)->get();
    	// foreach ($daerah as $key => $value) {
    	// 	$data=DB::table($value->table_name.'_'.$tahun)
    	// 	->select('url',DB::raw("('".$value->table_name.'_'.$tahun."') as table_name"),"tw","provinsi","kota_kab")
    	// 	->where('tw',$tw)
    	// 	->groupBy('url')
    	// 	->get();
    		
    	// 	Storage::put('list/'.$value->id.'-tw-'.$tw.'.json',json_encode($data,JSON_PRETTY_PRINT));
    	// }



    	if(!file_exists(storage_path('app/list/'.$kode_daerah.'-tw-'.$tw.'.json'))){
    		echo 'not exist';
    		dd($kode_daerah);
    	}


    	$data=file_get_contents(storage_path('app/list/'.$kode_daerah.'-tw-'.$tw.'.json'));
    	$data=json_decode($data,true);
    	$data_glob=$data;
    	if(!isset($data[$index])) {
			$value=DB::table('master_daerah')->where('kode_daerah_parent',null)
    		->where('id','>',$kode_daerah)->first();

    		return $value->nama.' |||| '.$value->id.' done '.$tw.' <a  href="'.route('pinit',['kode_daerah'=>$value->id]).'">click</a> <script>setTimeout(function(){window.location.href="'.route('perbaikan',['tw'=>$tw,'kode_daerah'=>$value->id,'index'=>0]).'"},2000);</script>';
		}

    	$data=$data[$index];

    	if(file_exists(storage_path('app/file/2019/'.$data['url']))){

    		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(storage_path('app/file/2019/'.$data['url']));
    		$data_ex=[];
    		  if($spreadsheet){
    		  	Storage::put('file_sparate/2019/'.$tw.'/'.$data['table_name'].'/'.$data['url'],file_get_contents(storage_path('app/file/2019/'.$data['url'])));

    		  	for($i=0 ;$i<4;$i++) {
    		  		$data_ex[($i+1)]=[];
    		  		$start_row=13;
    		  		$bidang=0;
    		  		$sub=0;
    		  		$kolom='';

    		  		$id_bidang=0;
    		  		$id_sub_bidang=0;
    		  		$id_susub_bid=0;
    		  		$id_kegiatan=0;
    		  		$id_sub_kegiatan=0;
    		  		$id_detail_sub_kegiatan=0;
    		  		$parent=0;



    		  		$sheet = $spreadsheet->setActiveSheetIndex($i);

    		  		foreach ($sheet->toArray() as $key=> $d) {
    		  			if($key>=$start_row){

    		  				$approve=0;

                        
    		  				if(($bidang!=static::getID(trim($d[1]))) AND (trim($d[1])!='') ) {
                              
    		  					$bidang=static::getID($d[1]);
    		  					$sub=0;
    		  					$nama=$d[1];
    		  					$kolom='BIDANG';
    		  					$id_bidang+=1;
			    		  		$id_sub_bidang=0;
			    		  		$id_susub_bid=0;
			    		  		$id_kegiatan=0;
			    		  		$id_sub_kegiatan=0;
			    		  		$id_detail_sub_kegiatan=0;
			    		  		$parent=0;
    		  					$approve=1;

    		  				}

    		  				if((trim($d[2])!='') and ($sub!=static::getID(trim($d[2])))){
    		  					$sub=static::getID($d[2]);
    		  					$kolom='SUB BIDANG';
    		  					$nama=$d[2];
			    		  		$id_sub_bidang+=1;
			    		  		$id_susub_bid=0;
			    		  		$id_kegiatan=0;
			    		  		$id_sub_kegiatan=0;
			    		  		$id_detail_sub_kegiatan=0;
    		  					$approve=1;
			    		  		$parent=$id_bidang;

    		  				}

    		  				if(''!=(trim($d[3])) ){
    		  					$kolom='KEGIATAN';
    		  					$nama=$d[3];
			    		  		$id_kegiatan+=1;
			    		  		$id_sub_kegiatan=0;
			    		  		$id_detail_sub_kegiatan=0;
    		  					$approve=1;
			    		  		$parent=$id_sub_bidang;
    		  				}

    		  				if(''!=(trim($d[4]))){
    		  					$nama=$d[4];

    		  					$kolom='SUB KEGIATAN';
    		  					$id_sub_kegiatan+=1;
			    		  		$id_detail_sub_kegiatan=0;
    		  					$approve=1;
			    		  		$parent=$id_kegiatan;



    		  				}

    		  				if(''!=(trim($d[5]))) {
    		  					$nama=$d[5];

    		  					$kolom='DETAIL SUB KEGIATAN';
			    		  		$id_detail_sub_kegiatan+=1;
    		  					$approve=1;
			    		  		$parent=$id_sub_kegiatan;



    		  				}
    		  				if(''!=(trim($d[6]))){
    		  					$nama=$d[6];
    		  					$kolom='KEGIATAN (SILPA)';
    		  					$approve=1;
			    		  		$parent=$id_detail_sub_kegiatan;


    		  				}

    		  				

							
    		  			

    		  				if($approve){

    		  					$penunjang=null;

	    		  				if(''!=(trim($d[7]))){
	    		  					if((int)$d[7]>0){
	    		  						$penunjang=(int)$d[7];
	    		  					}
	    		  				}

	    		  				$permasalahan=[];
                                if(count($d)<24){
                                    dd($data);
                                }

	    		  				if(''!=(trim($d[25]))){
	    		  					$tmp=explode(',',$d[25]);
	    		  					foreach ($tmp as $p) {
	    		  						$permasalahan[]='@'.trim($p);
	    		  					}

	    		  				}

                                if($bidang==0){
                                    dd($d);
                                }

    		  					$data_row=[
    		  					'id_bidang_db'=>$bidang,
    		  					'id_sub_bidang_db'=>$sub,
    		  					'id_bidang'=>$id_bidang,
    		  					'url'=>$data['url'],
    		  					'id_sub_bidang'=>$id_sub_bidang,
    		  					'id_kegiatan'=>$id_kegiatan,
    		  					'id_sub_kegiatan'=>$id_sub_kegiatan,
    		  					'id_detail_sub_kegiatan'=>$id_detail_sub_kegiatan,
    		  					'kategori_dak'=>($i+1),
    		  					'kolom'=>$kolom,
    		  					'tw'=>$tw,
    		  					'nama'=>$nama,
    		  					'parent'=>$parent,
    		  					'penunjang'=>$penunjang,
    		  					'kecamatan'=>$d[9],
    		  					'desa_kelurahan'=>$d[10],
    		  					'kode_kegiatan'=>$d[8],
    		  					'perencanaan_kegiatan_volume'=>static::number($d[11]),	
    		  					'perencanaan_kegiatan_satuan'=>$d[12],
    		  					'perencanaan_kegiatan_jumlah_penerima_manfaat'=>static::number($d[13]),
    		  					'perencanaan_kegiatan_jumlah_penerima_manfaat_satuan'=>($d[14]),
    		  					'perencanaan_kegiatan_pagu_dak_fisik'=>static::number($d[15]),
    		  					'mekanisme_pelaksana_swakelola_volume'=>static::number($d[16]),
    		  					'mekanisme_pelaksana_swakelola_pagu'=>static::number($d[17]),
    		  					'mekanisme_pelaksanaan_kontraktual_volume'=>static::number($d[18]),	
    		  					'mekanisme_pelaksana_kontraktual_pagu'=>static::number($d[19]),
    		  					'mekanisme_pelaksana_metoda_pembayaran'=>$d[20],
    		  					'realisasi_keuangan'=>static::number($d[21]),
    		  					'realisasi_keuangan_persen'=>(static::number($d[22])>1)?(static::number($d[22])/100):(static::number($d[22])),
    		  					'realisasi_fisik_volume'=>static::number($d[23]),
    		  					'realisasi_fisik_persen'=>(static::number($d[24])>1)?(static::number($d[24])/100):(static::number($d[24])),
    		  					'kodefikasi_keterangan_permasalahan'=>implode('|',$permasalahan),
    		  					'provinsi'=>$data['provinsi'],
    		  					'kota_kab'=>$data['kota_kab'],
    		  					'tujuan_pelaporan'=>0,
    		  					'tgl_update'=>Carbon::now(),
    		  					'status_verifikasi'=>null,
    		  					'komentar_verifikasi'=>$d[26]

    		  				];

    		  				$data_ex[($i+1)][]=$data_row;

    		  				}
    		
    		  				

    		  			}
    		  		}

    		  	}
    		  }
    		 	
    		  $old=DB::table($data['table_name'])
    		  ->where('provinsi',$data['provinsi'])
    		  ->where('kota_kab',$data['kota_kab'])
    		  ->where('tw',$data['tw'])
    		  ->delete();




    		 foreach ($data_ex as $key => $value) {
    		  	$inserting=DB::table($data['table_name'])->insert($value);
    		  }



    		 if(isset($data_glob[$r_index+1])){

    		 	return view('perbaikan.index')->with([
    		 		'index_next'=>$r_index+1,
    		 		'kode_daerah'=>$kode_daerah.'--'.$data_glob[$r_index+1]['url'],
    		 		'tw'=>$tw,
    		 		'url'=>route('perbaikan',['tw'=>$tw,'kode_daerah'=>$kode_daerah,'index'=>$r_index+1])
    		 	]);

    		 }else{
    		 	$daerah_next=DB::table('master_daerah')->where('kode_daerah_parent',null)
    		 	->where('id','>',$kode_daerah)->first();
    		 	
    		 	if($daerah_next){
    		 		return view('perbaikan.index')->with([
    		 		'index_next'=>0,
    		 		'kode_daerah'=>$daerah_next->id,
    		 		'tw'=>$tw,
    		 		'url'=>route('perbaikan',['tw'=>$tw,'kode_daerah'=>$daerah_next->id,'index'=>0])
    		 		]);
    		 	}else{
    		 		dd('wes bar');
    		 	}

    		 }


    	}else{
    		echo 'not exist<br><br>';
    		echo json_encode($data);

    		die();
    	}




    }

    public function init($kode_daerah=11){

    	$tahun=2019;
    	$tw=4;

    	$value=DB::table('master_daerah')->where('kode_daerah_parent',null)
    	->where('id',$kode_daerah)->first();
		$data=DB::connection('server')->table($value->table_name.'_'.$tahun)
		->select('url',DB::raw("('".$value->table_name.'_'.$tahun."') as table_name"),"tw","provinsi","kota_kab")
		->where('tw',$tw)
		->groupBy('url')
		->get();

		Storage::put('list/'.$value->id.'-tw-'.$tw.'.json',json_encode($data,JSON_PRETTY_PRINT));
		$value=DB::table('master_daerah')->where('kode_daerah_parent',null)
    	->where('id','>',$value->id)->first();

    	return $value->nama.' |||| '.$value->id.' done '.$tw.' <a  href="'.route('pinit',['kode_daerah'=>$value->id]).'">click</a> <script>setTimeout(function(){window.location.href="'.route('pinit',['kode_daerah'=>$value->id]).'"},2000);</script>';


    }
}
