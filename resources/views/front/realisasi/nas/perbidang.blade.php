@extends('adminlte::page')


@section('content_header')
    <h1 class="text-center">REALISASI NASIONAL PERBIDANG TW {{$tw}}</h1>
@stop

@section('content')



<div class="box box-primary">
	<div class="box-header">
		<div class="box-header">
			<div class="form-group"><label>TW</label>
				<form action="{{url()->current()}}" method="get" id="twch">
					<select class="form-control" name="tw" onchange="changetw(this)">
					<option class="" value="1" {{$tw==1?'selected':''}}>TW I</option>
					<option class="" value="2" {{$tw==2?'selected':''}}>TW II</option>
					<option class="" value="3" {{$tw==3?'selected':''}}>TW III</option>
					<option class="" value="4" {{$tw==4?'selected':''}}>TW IV</option>
				</select>

				</form>
				<script type="text/javascript">
					function changetw(){
						$('#twch').submit();
					}	
				</script>
			</div>
		</div>
	</div>
	<div class="box-body">
		<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<?php for ($i=1; $i < 5 ; $i++) { 

					switch ($i) {
						case 1:
						$name='REGULER';
							# code...
							break;
						
						case 2:
						$name='PENUGASAN';
							# code...
							break;
						
						case 3:
						$name='AFFIRMASI';
							# code...
							break;
						
						case 4:
						$name='NON FISIK';
							# code...
							break;
						
						
						default:
							# code...
							break;
					}
	   	?>
			<li class="{{$i==1?'active':''}}"><a href="#content-tab-{{$i}}" id="tab-{{$i}}" role="tab" data-toggle="tab" aria-controls="content_{{$i}}" aria-expanded="true">{{$name}}</a></li>

				<?php
	   		}

	   	?>
			
		  
		</ul>

		<div class="tab-content" id="myTabContent" style="margin-top: 10px;">

	   	<?php for ($i=1; $i < 5 ; $i++) { 
	   	?>

	   	<div class="tab-pane fade in {{$i==1?'active':''}}" role="tabpanel" id="content-tab-{{$i}}" aria-labelledby="tab-{{$i}}">
	     <table class="table table-bordered text-dark" id="table_{{$i}}" style="min-width: 100%">
			<thead class="text-center">
				<tr>
					<th rowspan="2" class="text-center">NAMA BIDANG</th>
					<th colspan="2" class="text-center">KEUANGAN</th>
					<th colspan="3" class="text-center">PELAKSANAAN KEGIATAN</th>
				</tr>
				<tr>
					<th>PAGU <small>(Ribuan)</small></th>
					<th>REALISASI KEUANGAN <small>(Ribuan)</small></th>
					<th>PERENCANAAN VOLUME </th>
					<th>REALISASI VOLUME</th>
					<th>REALISASI VOLUME PERSENTASE</th>
				</tr>
			</thead>
			<tbody></tbody>
			<tfoot>
				<tr>
					<th>Total</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th>-</th>
				</tr>
			</tfoot>
		</table>
	   </div>

	   	<?php
	   		}

	   	?>

	   
	</div>


		
	</div>
</div>



@stop


@section('js')

<script type="text/javascript">
	var data_source=<?php echo json_encode($data)?>;

	<?php for ($i=0; $i < 5; $i++) { 
	?>
	var table_{{$i}}=$('#table_{{$i}}').DataTable({
		sort:false,
		  dom: 'Bfrtip',
     	 buttons: [
            {
                extend: 'excelHtml5',
                text: 'DOWNLOAD EXCEL',
                className:'btn btn-success btn-xs',
                messageTop: '',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5 ]
                }
            },
        ],
		 drawCallback: function () {
	      var api = this.api();
		    for($i=1;$i<=4;$i++){
		    	$(api.table().column($i).footer() ).html('TOTAL');
			    $(api.table().column($i).footer()).html(
			     		api.column($i).data().sum().toFixed(2)
			    );	
		    } 
		    persentase=((parseFloat($(api.table().column(4).footer()).html())/$(api.table().column(3).footer()).html())*100).toFixed(2);
	        if(Number.isNaN(persentase)|| persentase==='NaN'){
	          $(api.table().column(5).footer()).html('0%');
	        }else{
	          if((persentase===Infinity) || persentase==='Infinity'){
	          $(api.table().column(5).footer()).html('0%');
	          }else{
	          $(api.table().column(5).footer()).html(persentase+'%');
	          }
	        }

	        for($i=2;$i<=4;$i++){
	          $(api.table().column($i).footer()).html(formatNumber($(api.table().column($i).footer()).html()));
	        }
		  },
		columns:[
			{
				data:'nama',

			},
			{
				data:'data.pagu',
				render:function(data){
						return formatNumber(data);
				}


			},
			{
				data:'data.realisasi_keuangan',
				render:function(data){
						return formatNumber(data);
				}

			},
			{
				data:'data.perencanaan_kegiatan_volume',
				render:function(data){
						return formatNumber(data);
				}

			},
			{
				data:'data.realisasi_fisik_volume',
				render:function(data){
						return formatNumber(data);
				}

			},

			{
				data:'data',
				render:function(data){
					

					return ((parseFloat(data.realisasi_fisik_volume) / parseFloat(data.perencanaan_kegiatan_volume))*100).toFixed(2)+'%';
				}

			},
		]
	});

	table_{{$i}}.rows.add(data_source[{{$i}}]).draw();
	<?php
	}
	?>

</script>

@stop