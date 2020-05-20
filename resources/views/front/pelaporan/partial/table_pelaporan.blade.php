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
		
	    @foreach($datax as $d)
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