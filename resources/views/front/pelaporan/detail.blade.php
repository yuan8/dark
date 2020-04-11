@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')
<style type="text/css">
	th,td{
		font-size: 9px;
	}
</style>
<div class="row"> 
	<div class="col-md-12">
		<div class="box-primary box">
			<div class="box-body" id="timeline"></div>
		</div>
	</div>
    <h3 class="text-center">{{$daerah->nama}} TW {{$tw}}</h3>

	<div class="col-md-12 table-responsive">
		<div class="box-primary box">
			<div class="box-body">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th rowspan="2">PAGU</th>
						<th rowspan="2">KEUANGAN</th>
						<th rowspan="2">VOLUME  FISIK</th>
						<th colspan="11" class="text-center">PERKATEGORI</th>
					</tr>
					<tr>
						<th>PAGU REGULER</th>
						<th>KEUANGAN REGULER</th>
						<th>VOLUME FISIK REGULER</th>
						<th>PAGU PENUGASAN</th>
						<th>KEUANGAN PENUGASAN</th>
						<th>VOLUME FISIK PENUGASAN</th>
						<th>PAGU AFFIRMASI</th>
						<th>KEUANGAN AFFIRMASI</th>
						<th>VOLUME FISIK AFFIRMASI</th>
						<th>PAGU NON FISIK</th>
						<th>KEUANGAN NON FISIK</th>


					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{number_format($detail['REKAP']['pagu'],0,'.',' ')}}</td>
						<td>{{number_format($detail['REKAP']['keuangan'],0,'.',' ')}}</td>
						<td>{{number_format($detail['REKAP']['volume_fisik'],0,'.',' ')}}</td>

						<td>{{number_format($detail['REGULER']['pagu'],0,'.',' ')}}</td>
						<td>{{number_format($detail['REGULER']['keuangan'],0,'.',' ')}}</td>
						<td>{{number_format($detail['REGULER']['volume_fisik'],0,'.',' ')}}</td>

						<td>{{number_format($detail['PENUGASAN']['pagu'],0,'.',' ')}}</td>
						<td>{{number_format($detail['PENUGASAN']['keuangan'],0,'.',' ')}}</td>
						<td>{{number_format($detail['PENUGASAN']['volume_fisik'],0,'.',' ')}}</td>

						<td>{{number_format($detail['AFFIRMASI']['pagu'],0,'.',' ')}}</td>
						<td>{{number_format($detail['AFFIRMASI']['keuangan'],0,'.',' ')}}</td>
						<td>{{number_format($detail['AFFIRMASI']['volume_fisik'],0,'.',' ')}}</td>

						<td>{{number_format($detail['NON_FISIK']['pagu'],0,'.',' ')}}</td>
						<td>{{number_format($detail['NON_FISIK']['keuangan'],0,'.',' ')}}</td>



					</tr>
				</tbody>
			</table>

			</div>
		</div>
	</div>
	<div class="col-md-12 text-center" style="margin-bottom: 15px;" >
		<div class="btn-group">
			@if(($tw-1)>0)
			<a href="{{route('pel.detail.data',['id'=>$daerah->id,'tw'=>($tw-1)])}}" class="btn btn-primary btn-sm">TW {{$tw-1}}</a>
			@else
			<a href="{{route('pel.detail.data',['id'=>$daerah->id,'tw'=>(1)])}}" disabled class="btn btn-primary btn-sm">TW 1</a>
			@endif
			@if(($tw+1)<5)

			<a href="{{route('pel.detail.data',['id'=>$daerah->id,'tw'=>($tw+1)])}}" class="btn btn-primary btn-sm">TW {{$tw+1}}</a>
			@else
			<a href="{{route('pel.detail.data',['id'=>$daerah->id,'tw'=>(4)])}}" disabled class="btn btn-primary btn-sm">TW 4</a>
			@endif

			@if(count($data['REGULER'])>0)
			<a href="{{url('storage/files/'.HP::front_tahun().'/'.$data['REGULER'][0]->url)}}" class="btn btn-success btn-sm" download="">Download File  TW {{$tw}}</a>
			@else
			<a href="" class="btn btn-success btn-sm" disabled>Tidak Melakukan Pelaporan</a>
			@endif
		</div>
	</div>
	<br>
	<div class="col-md-12">
		<div class="box box-primary">
	<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li role="presentation" class="active"><a href="#REGULER" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><b>REGULER</b></a></li>
        <li role="presentation" class=""><a href="#PENUGASAN" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>PENUGASAN</b></a></li>
        <li role="presentation" > <a href="#AFFIRMASI" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>AFFIRMASI </b></a>
         <li role="presentation" > <a href="#NON_FISIK" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>NON FISIK</b> </a>
            
        </li>
         <li role="presentation" > <a href="#PERBIDANG" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>PERBIDANG</b> </a>
            
        </li>
    </ul>
    
</div>
			<div class="box-body table-responsive">
				
					<div class="tab-content" id="myTabContent">
				        <div class="tab-pane fade active in" role="tabpanel" id="REGULER" aria-labelledby="home-tab">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="3">BIDANG</th>
										<th rowspan="3">SUB BIDANG</th>
										<th rowspan="3">SUB SUB BIDANG</th>

										<th rowspan="3">KEGIATAN</th>
										<th rowspan="3">SUB KEGIATAN</th>
										<th rowspan="3">DETAIL SUB KEGIATAN</th>
										<th colspan="2">LOKASI</th>
										<th colspan="5">PERENCANAAN</th>
										<th colspan="5">MEKANISME PELAKSANAAN</th>
										<th colspan="4">REALISASI</th>
										<th rowspan="3">KODE FIKASI PERMASALAHAN</th>
										<th rowspan="3">KETERANGAN PERMASALAHAN</th>



									</tr>
									<tr>
										<th rowspan="2">KECAMATAN</th>
										<th rowspan="2">DESA/KELURAHAN</th>
										<th colspan="2">VOLUME FISIK</th>
										<th colspan="2">PENERIMA MANFAAT</th>
										<th rowspan="2" ="">PAGU</th>
										<th colspan="2">SWAKELOLA</th>
										<th colspan="2">KOTRAKTUAL</th>
										<th rowspan="2" ="">METODE PEMBAYARAN</th>
										<th colspan="2">KEUANGAN</th>
										<th colspan="2">FISIK</th>
									</tr>
									<tr>
										<th>VOLUME</th>
										<th>SATUAN</th>
										<th>VOLUME</th>
										<th>SATUAN</th>
										<th>VOLUME</th>
										<th>Rp.</th>
										<th>VOLUME</th>
										<th>Rp.</th>
										<th>Rp.</th>
										<th>%</th>
										<th>VOLUME</th>
										<th>%</th>


									</tr>
								</thead>
								<tbody style="overflow-x:scroll; max-width: 1000px;">

							            @foreach($data['REGULER'] as $d)
										<?php 
										switch ($d->kolom) {
											case 'BIDANG':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}} bg bg-primary">
													<td colspan="23">{{$d->nama}}</td>
												</tr>
											<?php
												# code...
												break;
											case 'SUB BIDANG':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}} bg bg-info">
													<td></td>
													<td colspan="22">{{$d->nama}}</td>
												</tr>
											<?php
												# code...
												break;
											case 'KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="2"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;
											case 'SUB KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="3"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
											case 'DETAIL SUB KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="4"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;
											case 'KEGIATAN (SILPA)':
											// dd($d);
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="5"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;

												
											default:
												# code...
												break;
										}

										?>

									@endforeach
									</tbody>
									</table>
				        </div>
				        <div class="tab-pane fade " role="tabpanel" id="PENUGASAN" aria-labelledby="home-tab"> 
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="3">BIDANG</th>
										<th rowspan="3">SUB BIDANG</th>
										<th rowspan="3">SUB SUB BIDANG</th>
										<th rowspan="3">KEGIATAN</th>
										<th rowspan="3">SUB KEGIATAN</th>
										<th rowspan="3">DETAIL SUB KEGIATAN</th>
										<th colspan="2">LOKASI</th>
										<th colspan="5">PERENCANAAN</th>
										<th colspan="5">MEKANISME PELAKSANAAN</th>
										<th colspan="4">REALISASI</th>
										<th rowspan="3">KODE FIKASI PERMASALAHAN</th>
										<th rowspan="3">KETERANGAN PERMASALAHAN</th>



									</tr>
									<tr>
										<th rowspan="2">KECAMATAN</th>
										<th rowspan="2">DESA/KELURAHAN</th>
										<th colspan="2">VOLUME FISIK</th>
										<th colspan="2">PENERIMA MANFAAT</th>
										<th rowspan="2" ="">PAGU</th>
										<th colspan="2">SWAKELOLA</th>
										<th colspan="2">KOTRAKTUAL</th>
										<th rowspan="2" ="">METODE PEMBAYARAN</th>
										<th colspan="2">KEUANGAN</th>
										<th colspan="2">FISIK</th>
									</tr>
									<tr>
										<th>VOLUME</th>
										<th>SATUAN</th>
										<th>VOLUME</th>
										<th>SATUAN</th>
										<th>VOLUME</th>
										<th>Rp.</th>
										<th>VOLUME</th>
										<th>Rp.</th>
										<th>Rp.</th>
										<th>%</th>
										<th>VOLUME</th>
										<th>%</th>


									</tr>
								</thead>
								<tbody style="overflow-x:scroll; max-width: 1000px;">

							            @foreach($data['PENUGASAN'] as $d)
										<?php 
										switch ($d->kolom) {
											case 'BIDANG':
											?>
												<tr class=" bg bg-primary">
													<td colspan="23">{{$d->nama}}</td>
												</tr>
											<?php
												# code...
												break;
											case 'SUB BIDANG':
											?>
												<tr class=" bg bg-info">
													<td></td>
													<td colspan="22">{{$d->nama}}</td>
												</tr>
											<?php
												# code...
												break;
											case 'KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="2"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;
											case 'SUB KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="3"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
											case 'DETAIL SUB KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="4"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;
											case 'KEGIATAN (SILPA)':
											// dd($d);
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="5"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;

												
											default:
												# code...
												break;
										}

										?>

									@endforeach
									</tbody>
									</table>
				        </div>
				        <div class="tab-pane fade " role="tabpanel" id="AFFIRMASI" aria-labelledby="home-tab">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="3">BIDANG</th>
										<th rowspan="3">SUB BIDANG</th>
										<th rowspan="3">SUB SUB BIDANG</th>

										<th rowspan="3">KEGIATAN</th>
										<th rowspan="3">SUB KEGIATAN</th>
										<th rowspan="3">DETAIL SUB KEGIATAN</th>
										<th colspan="2">LOKASI</th>
										<th colspan="5">PERENCANAAN</th>
										<th colspan="5">MEKANISME PELAKSANAAN</th>
										<th colspan="4">REALISASI</th>
										<th rowspan="3">KODE FIKASI PERMASALAHAN</th>
										<th rowspan="3">KETERANGAN PERMASALAHAN</th>



									</tr>
									<tr>
										<th rowspan="2">KECAMATAN</th>
										<th rowspan="2">DESA/KELURAHAN</th>
										<th colspan="2">VOLUME FISIK</th>
										<th colspan="2">PENERIMA MANFAAT</th>
										<th rowspan="2" ="">PAGU</th>
										<th colspan="2">SWAKELOLA</th>
										<th colspan="2">KOTRAKTUAL</th>
										<th rowspan="2" ="">METODE PEMBAYARAN</th>
										<th colspan="2">KEUANGAN</th>
										<th colspan="2">FISIK</th>
									</tr>
									<tr>
										<th>VOLUME</th>
										<th>SATUAN</th>
										<th>VOLUME</th>
										<th>SATUAN</th>
										<th>VOLUME</th>
										<th>Rp.</th>
										<th>VOLUME</th>
										<th>Rp.</th>
										<th>Rp.</th>
										<th>%</th>
										<th>VOLUME</th>
										<th>%</th>


									</tr>
								</thead>
								<tbody style="overflow-x:scroll; max-width: 1000px;">

							            @foreach($data['AFFIRMASI'] as $d)
										<?php 
										switch ($d->kolom) {
											case 'BIDANG':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}  bg bg-primary">
													<td colspan="23">{{$d->nama}}</td>
												</tr>
											<?php
												# code...
												break;
											case 'SUB BIDANG':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}  bg bg-info">
													<td></td>
													<td colspan="22">{{$d->nama}}</td>
												</tr>
											<?php
												# code...
												break;
											case 'KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="2"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;
											case 'SUB KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="3"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
											case 'DETAIL SUB KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="4"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;
											case 'KEGIATAN (SILPA)':
											// dd($d);
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="5"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;

												
											default:
												# code...
												break;
										}

										?>

									@endforeach
									</tbody>
									</table>
				        </div>
				        <div class="tab-pane fade " role="tabpanel" id="NON_FISIK" aria-labelledby="home-tab">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="3">BIDANG</th>
										<th rowspan="3">SUB BIDANG</th>
										<th rowspan="3">SUB SUB BIDANG</th>

										<th rowspan="3">KEGIATAN</th>
										<th rowspan="3">SUB KEGIATAN</th>
										<th rowspan="3">DETAIL SUB KEGIATAN</th>
										<th colspan="2">LOKASI</th>
										<th colspan="5">PERENCANAAN</th>
										<th colspan="5">MEKANISME PELAKSANAAN</th>
										<th colspan="4">REALISASI</th>
										<th rowspan="3">KODE FIKASI PERMASALAHAN</th>
										<th rowspan="3">KETERANGAN PERMASALAHAN</th>



									</tr>
									<tr>
										<th rowspan="2">KECAMATAN</th>
										<th rowspan="2">DESA/KELURAHAN</th>
										<th colspan="2">VOLUME FISIK</th>
										<th colspan="2">PENERIMA MANFAAT</th>
										<th rowspan="2" ="">PAGU</th>
										<th colspan="2">SWAKELOLA</th>
										<th colspan="2">KOTRAKTUAL</th>
										<th rowspan="2" ="">METODE PEMBAYARAN</th>
										<th colspan="2">KEUANGAN</th>
										<th colspan="2">FISIK</th>
									</tr>
									<tr>
										<th>VOLUME</th>
										<th>SATUAN</th>
										<th>VOLUME</th>
										<th>SATUAN</th>
										<th>VOLUME</th>
										<th>Rp.</th>
										<th>VOLUME</th>
										<th>Rp.</th>
										<th>Rp.</th>
										<th>%</th>
										<th>VOLUME</th>
										<th>%</th>


									</tr>
								</thead>
								<tbody style="overflow-x:scroll; max-width: 1000px;">

							            @foreach($data['NON_FISIK'] as $d)
										<?php 
										switch ($d->kolom) {
											case 'BIDANG':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}  bg bg-primary" >
													<td colspan="23">{{$d->nama}}</td>
												</tr>
											<?php
												# code...
												break;
											case 'SUB BIDANG':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}  bg bg-info">
													<td></td>
													<td colspan="22">{{$d->nama}}</td>
												</tr>
											<?php
												# code...
												break;
											case 'KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="2"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;
											case 'SUB KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="3"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
											case 'DETAIL SUB KEGIATAN':
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="4"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;
											case 'KEGIATAN (SILPA)':
											// dd($d);
											?>
												<tr class="{{$d->penunjang?'bg bg-success':''}}">
													<td colspan="5"></td>
													<td colspan="">{{$d->nama}}</td>
													<td>{{$d->kecamatan}}</td>
													<td>{{$d->desa_kelurahan}}</td>
													<td>{{$d->perencanaan_kegiatan_volume}}</td>
													<td>{{$d->perencanaan_kegiatan_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat}}</td>
													<td>{{$d->perencanaan_kegiatan_jumlah_penerima_manfaat_satuan}}</td>
													<td>{{$d->perencanaan_kegiatan_pagu_dak_fisik}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_swakelola_pagu}}</td>
													<td>{{$d->mekanisme_pelaksanaan_kontraktual_volume}}</td>
													<td>{{$d->mekanisme_pelaksana_kontraktual_pagu}}</td>
													<td>{{$d->mekanisme_pelaksana_metoda_pembayaran}}</td>
													<td>{{$d->realisasi_keuangan}}</td>
													<td>{{$d->realisasi_keuangan_persen*100}}%</td>
													<td>{{$d->realisasi_fisik_volume}}</td>
													<td>{{$d->realisasi_fisik_persen*100}}%</td>
													<td></td>
													<td></td>
												</tr>
											<?php
												# code...
												break;

												
											default:
												# code...
												break;
										}

										?>

									@endforeach
									</tbody>
									</table>
				        </div>
				       
				    	<div class="tab-pane fade active in" role="tabpanel" id="PERBIDANG" aria-labelledby="home-tab">
				    		<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
    							<ul class="nav nav-tabs" id="p_b_tabs" role="tablist">
    								<li role="presentation" class="active"><a href="#PREGULER" id="PTR" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><b>REGULER</b></a></li>
								        <li role="presentation" class=""><a href="#PPENUGASAN" role="tab" id="PTP" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>PENUGASAN</b></a></li>
								        <li role="presentation" > <a href="#PAFFIRMASI" role="tab" id="PTA" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>AFFIRMASI </b></a>
								         <li role="presentation" > <a href="#PNON_FISIK" role="tab" id="PTN" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>NON FISIK</b> </a>
								         </li>
								     </ul>
							</div>
							<div class="tab-content" id="ptab-k">
								<div class="tab-pane fade active in" role="tabpanel" id="PREGULER" aria-labelledby="PTR">
									<table class="table-bordered table">
						    	  		<thead>
						    	  			<th>BIDANG</th>
						    	  			<th>SUB BIDANG</th>
						    	  			<th>PAGU</th>
						    	  			<th>KEUANGAN</th>
						    	  			<th>VOLUME FISIK</th>



						    	  		</thead>
						    	  		<tbody>
						    	  			@foreach($perbidang['REGULER'] as $t)
						    	  			<tr class="bg bg-info">
						    	  				<td colspan="2">{{$t['nama']}}</td>
						    	  				<td>{{number_format($t['pagu'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($t['keuangan'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($t['volume_fisik'],3,'.',' ')}}</td>
						    	  			</tr>
						    	  			@foreach($t['sub_bidang'] as $s)
						    	  			<tr>
						    	  				<td></td>
						    	  				<td>{{$s['nama']}}</td>
						    	  				<td>{{number_format($s['pagu'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($s['keuangan'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($s['volume_fisik'],3,'.',' ')}}</td>
						    	  			</tr>
						    	  			@endforeach
						    	  			
						    	  			@endforeach
						    	  		</tbody>
						    	  	</table>
								</div>
								<div class="tab-pane fade " role="tabpanel" id="PPENUGASAN" aria-labelledby="PTP">
									<table class="table-bordered table">
						    	  		<thead>
						    	  			<th>BIDANG</th>
						    	  			<th>SUB BIDANG</th>
						    	  			<th>PAGU</th>
						    	  			<th>KEUANGAN</th>
						    	  			<th>VOLUME FISIK</th>



						    	  		</thead>
						    	  		<tbody>
						    	  			@foreach($perbidang['PENUGASAN'] as $t)
						    	  			<tr class="bg bg-info">
						    	  				<td colspan="2">{{$t['nama']}}</td>
						    	  				<td>{{number_format($t['pagu'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($t['keuangan'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($t['volume_fisik'],3,'.',' ')}}</td>
						    	  			</tr>
						    	  			@foreach($t['sub_bidang'] as $s)
						    	  			<tr>
						    	  				<td></td>
						    	  				<td>{{$s['nama']}}</td>
						    	  				<td>{{number_format($s['pagu'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($s['keuangan'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($s['volume_fisik'],3,'.',' ')}}</td>
						    	  			</tr>
						    	  			@endforeach
						    	  			
						    	  			@endforeach
						    	  		</tbody>
						    	  	</table>
								</div>
								<div class="tab-pane fade " role="tabpanel" id="PAFFIRMASI" aria-labelledby="PTA">
									<table class="table-bordered table">
						    	  		<thead>
						    	  			<th>BIDANG</th>
						    	  			<th>SUB BIDANG</th>
						    	  			<th>PAGU</th>
						    	  			<th>KEUANGAN</th>
						    	  			<th>VOLUME FISIK</th>



						    	  		</thead>
						    	  		<tbody>
						    	  			@foreach($perbidang['AFFIRMASI'] as $t)
						    	  			<tr class="bg bg-info">
						    	  				<td colspan="2">{{$t['nama']}}</td>
						    	  				<td>{{number_format($t['pagu'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($t['keuangan'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($t['volume_fisik'],3,'.',' ')}}</td>
						    	  			</tr>
						    	  			@foreach($t['sub_bidang'] as $s)
						    	  			<tr>
						    	  				<td></td>
						    	  				<td>{{$s['nama']}}</td>
						    	  				<td>{{number_format($s['pagu'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($s['keuangan'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($s['volume_fisik'],3,'.',' ')}}</td>
						    	  			</tr>
						    	  			@endforeach
						    	  			
						    	  			@endforeach
						    	  		</tbody>
						    	  	</table>
								</div>
								<div class="tab-pane fade " role="tabpanel" id="PNON_FISIK" aria-labelledby="PTN">
									<table class="table-bordered table">
						    	  		<thead>
						    	  			<th>BIDANG</th>
						    	  			<th>SUB BIDANG</th>
						    	  			<th>PAGU</th>
						    	  			<th>KEUANGAN</th>
						    	  			<th>VOLUME FISIK</th>



						    	  		</thead>
						    	  		<tbody>
						    	  			@foreach($perbidang['NON_FISIK'] as $t)
						    	  			<tr class="bg bg-info">
						    	  				<td colspan="2">{{$t['nama']}}</td>
						    	  				<td>{{number_format($t['pagu'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($t['keuangan'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($t['volume_fisik'],3,'.',' ')}}</td>
						    	  			</tr>
						    	  			@foreach($t['sub_bidang'] as $s)
						    	  			<tr>
						    	  				<td></td>
						    	  				<td>{{$s['nama']}}</td>
						    	  				<td>{{number_format($s['pagu'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($s['keuangan'],3,'.',' ')}}</td>
						    	  				<td>{{number_format($s['volume_fisik'],3,'.',' ')}}</td>
						    	  			</tr>
						    	  			@endforeach
						    	  			
						    	  			@endforeach
						    	  		</tbody>
						    	  	</table>
								</div>
							</div>


							
				    	  </div>
				    </div>
						
					
			</div>
		</div>
	</div>
</div>

@stop


@section('js')
<script type="text/javascript">
Highcharts.chart('timeline', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'TIMELINE DAK {{$daerah->nama}} TAHUN {{HP::front_tahun()}}'
    },
    subtitle: {
        // text: 'Source: Wikipedia.org'
    },
    xAxis: {
        categories: ['TW I','TW II','TW III','TW IV'],
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'RP./UNIT'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        split: false,
    },
    plotOptions: {
        area: {
            cursor: 'pointer',
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            },
            point: {
                  events: {
                      click: function () {
                        window.location.href='{{route('pel.detail.data',['id'=>$daerah->id])}}/'+((this.index)+1);
                      }
                  }
            }
        },

    },
    series: [
    	{
	        name: 'PAGU',
	        data: [
	        	{{$timeline[1]->pagu?$timeline[1]->pagu:0}},
	        	{{$timeline[2]->pagu?$timeline[2]->pagu:0}},
	        	{{$timeline[3]->pagu?$timeline[3]->pagu:0}},
	        	{{$timeline[4]->pagu?$timeline[4]->pagu:0}},
	        	
	        	]
        
        },
        {
	        name: 'REALISASI KEUANGAN',
	        data: [
	        	{{$timeline[1]->realisasi_keuangan?$timeline[1]->realisasi_keuangan:0}},
	        	{{$timeline[2]->realisasi_keuangan?$timeline[2]->realisasi_keuangan:0}},
	        	{{$timeline[3]->realisasi_keuangan?$timeline[3]->realisasi_keuangan:0}},
	        	{{$timeline[4]->realisasi_keuangan?$timeline[4]->realisasi_keuangan:0}},
	        	
	        	]
        
        },
        {
	        name: 'PERENCANAAN VOLUME FISIK',
	        data: [
	        	{{$timeline[1]->perencanaan_kegiatan_volume?$timeline[1]->perencanaan_kegiatan_volume:0}},
	        	{{$timeline[2]->perencanaan_kegiatan_volume?$timeline[2]->perencanaan_kegiatan_volume:0}},
	        	{{$timeline[3]->perencanaan_kegiatan_volume?$timeline[3]->perencanaan_kegiatan_volume:0}},
	        	{{$timeline[4]->perencanaan_kegiatan_volume?$timeline[4]->perencanaan_kegiatan_volume:0}},
	        	

	        	]
        
        },
        {
	        name: 'REALISASI VOLUME FISIK',
	        data: [
	        	{{$timeline[1]->realisasi_fisik_volume?$timeline[1]->realisasi_fisik_volume:0}},
	        	{{$timeline[2]->realisasi_fisik_volume?$timeline[2]->realisasi_fisik_volume:0}},
	        	{{$timeline[3]->realisasi_fisik_volume?$timeline[3]->realisasi_fisik_volume:0}},
	        	{{$timeline[4]->realisasi_fisik_volume?$timeline[4]->realisasi_fisik_volume:0}},

	        
	        	
	        	]
        
        }
      ]
});
</script>

@stop