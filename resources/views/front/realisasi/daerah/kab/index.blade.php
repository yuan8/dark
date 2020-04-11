@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="text-center"><b>{{$daerah->nama}} TW {{$tw}}</b></h1>
    <hr>
@stop

@section('content')
<div class="row">
	<div class="col-md-12 text-center" style="margin-bottom: 15px;" >
		<div class="btn-group">
			@if(($tw-1)>0)
			<a href="{{route('rel.daerah.kota',['tw'=>($tw-1),'page'=>isset($_GET['page'])?$_GET['page']:1,'p'=>isset($_GET['p'])?$_GET['p']:''])}}" class="btn btn-primary btn-sm">TW {{$tw-1}}</a>
			@else
			<a href="" disabled class="btn btn-primary btn-sm">TW 1</a>
			@endif
			@if(($tw+1)<5)
			<a href="{{route('rel.daerah.kota',['tw'=>($tw+1),'page'=>isset($_GET['page'])?$_GET['page']:1,'p'=>isset($_GET['p'])?$_GET['p']:''])}}" class="btn btn-primary btn-sm">TW {{$tw+1}}</a>
			@else
			<a href="" disabled class="btn btn-primary btn-sm">TW 4</a>
			@endif

			
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
			<form action="{{route('rel.daerah.kota',['tw'=>($tw)])}}" method="get">
				<select class="form-control" name='p' id="sel" placeholder>
				<option value="" >-- SEMUA -</option>
				@foreach($list_d as $l)
				<option value="{{$l->id}}" {{$daerah->id==$l->id?'selected':''}}>{{$l->nama}}</option>
				@endforeach
			</select>
			</form>

			<script type="text/javascript">
				$('#sel').on('change',function(){
					$('#sel').parent().submit();
				});
			</script>

				
			</div>
			<div class="box-body">
				<table class="table table-bordered" ïd="d">
					<thead>
						<tr>
							<th rowspan="2">KODE DAERAH</th>
							<th rowspan="2">NAMA DAERAH</th>
							<th rowspan="2">STATUS PELAPORAN TW {{$tw}}</th>
							<th rowspan="2">PAGU</th>
							<th colspan="2">REALISASI</th>
							
						</tr>
						<tr>
							<th>KEUANGAN</th>
							<th>FISIK VOLUME</th>

						</tr>
					</thead>
					<tbody>
						@foreach($data as $d)
							<tr>
								<td>{{$d->kode_daerah}}</td>
								<td>{{$d->nama_daerah}}</td>
								@if($d->count > 0)

								<td class="{{$d->count==0?'bg bg-danger':''}}">
									<div class="btn-group">
										<a href="{{url('storage/files/'.HP::front_tahun().'/'.$d->file)}}" class="btn btn-primary btn-sm">Download File</a>
									<a href="{{route('pel.detail.data',['id'=>$d->kode_daerah,'tw'=>$tw])}}" class="btn btn-success btn-sm" target="_blank">Detail</a>
									</div>
									
								</td>
								@else
								<td class="{{$d->count==0?'bg bg-danger':''}} text-center" colspan="4">
									<b class="text-center">TIDAK MELAPOR</b>
								</td>

								@endif
								
								@if($d->count>0)
								<td>
									{{number_format($d->perencanaan_kegiatan_pagu_dak_fisik,3,'.',' ')}}
								</td>
								<td>
									{{number_format($d->realisasi_keuangan,3,'.',' ')}}
									
								</td>
								<td>
									{{number_format($d->realisasi_fisik_volume,3,'.',' ')}}
									
								</td>

								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		{{$link->links()}}
	</div>
</div>

@stop

@section('js')

<script type="text/javascript">
	$('#d').DataTable({
		'sort':false
	});
</script>
@stop