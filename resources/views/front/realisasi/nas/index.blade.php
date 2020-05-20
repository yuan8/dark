@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="text-center">REALISASI NASIOANAL</h1>
@stop

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body" id="PERTW">

      </div>

    </div>

  </div>

   <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body" id="PERTW_PER_KAT">

      </div>
        <div class="box-footer text-center" id="pelaporan_chart_kat_foot">
        <ul class="list-group list-group-horizontal"></ul>
      </div>

    </div>

  </div>
 </div>

<div class="col-md-12"  id="table-view" style="display:none">
    <div class="box box-primary ">
      <div class="box-header with-border">
        <h5 class="text-center"><b class="title"></b> </h5>

      </div>
      <div class="box-body">
      <div class="box-body">
        <table class="table table-bordered" id="view_in_table" style="min-width:100%">
        <thead>
          <tr>
            <th rowspan="2">KODE DAERAH </th>
            <th rowspan="2">NAMA DAERAH</th>
            <th colspan="5" class="text-center">REALISASI</th>
            <th rowspan="2">ACTION</th>

          </tr>
          <tr>
              <th>PAGU <small>(RP.(RIBUAN))</small></th>
              <th>KEUANGAN <small>(RP.(RIBUAN))</small></th>
              <th>PERENCANAAN VOLUME <small></small></th>
              <th>REALISASI VOLUME <small></small></th>
              <th>REALISASI PERSENTASE <small></small></th>

          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <th colspan="2" class="text-center">TOTAL</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          



        </tfoot>

        </table>
      </div>

    </div>

  </div>



@stop


@section('js')
<script type="text/javascript">

	var data_source=<?php  echo json_encode($data,true) ?>;
	
	Highcharts.chart('PERTW', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'REALISASI TOTAL DAK TAHUN {{HP::front_tahun()}}'
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
            text: 'DAERAH'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
  
    plotOptions: {
        line: {
            cursor: 'pointer',
            // stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            },
            point: {
                  events: {
                      click: function () {
                        dropDaetail(data_source.DATA_PERTW[(this.index)+1],'PELAPORAN DAK TW '+(this.index+1)+' TAHUN {{HP::front_tahun()}}');
                      }
                  }
            }
        },

    },
    series: [
     	{
     		name:'PAGU',
     		dataLabels:{
     			formatter:function(){
           			 return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW[1]!=undefined?data_source.PERTW[1].pagu:0),data_source.PERTW[2]!=undefined?data_source.PERTW[2].pagu:0,data_source.PERTW[3]!=undefined?data_source.PERTW[3].pagu:0,data_source.PERTW[4]!=undefined?data_source.PERTW[4].pagu:0]
     	},
     	{
     		name:'REALISASI KEUANGAN',
     		dataLabels:{
     			formatter:function(){
           			 return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW[1]!=undefined?data_source.PERTW[1].realisasi_keuangan:0),data_source.PERTW[2]!=undefined?data_source.PERTW[2].realisasi_keuangan:0,data_source.PERTW[3]!=undefined?data_source.PERTW[3].realisasi_keuangan:0,data_source.PERTW[4]!=undefined?data_source.PERTW[4].realisasi_keuangan:0]

     	},
     	{
     		name:'PERENCANAAN VOLUME',
     		dataLabels:{
     			formatter:function(){
           			 return ''+formatNumber(this.y)+''
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW[1]!=undefined?data_source.PERTW[1].perencanaan_volume:0),data_source.PERTW[2]!=undefined?data_source.PERTW[2].perencanaan_volume:0,data_source.PERTW[3]!=undefined?data_source.PERTW[3].perencanaan_volume:0,data_source.PERTW[4]!=undefined?data_source.PERTW[4].perencanaan_volume:0]

     	},
     	{
     		name:'REALISASI VOLUME',
     		dataLabels:{
     			formatter:function(){
           			 return ''+formatNumber(this.y)+''
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW[1]!=undefined?data_source.PERTW[1].realisasi_volume:0),data_source.PERTW[2]!=undefined?data_source.PERTW[2].realisasi_volume:0,data_source.PERTW[3]!=undefined?data_source.PERTW[3].realisasi_volume:0,data_source.PERTW[4]!=undefined?data_source.PERTW[4].realisasi_volume:0]

     	}
    ]
});

	
	var PERTW_PER_KAT= Highcharts.chart('PERTW_PER_KAT', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'REALISASI TOTAL DAK PER KATEGORI TAHUN {{HP::front_tahun()}}'
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
            text: 'DAERAH'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    
  
    plotOptions: {
    	 series: {
        events: {
            legendItemClick: function(event){
                getSeriesBreak(this);
                event.preventDefault();

            }
          }
      },
        line: {
            cursor: 'pointer',
            // stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            },
            point: {
                  events: {
                      click: function () {
                      	if(this.series.linkedParent!==undefined){
                      		var name=this.series.linkedParent.name;
                      	}else{
                      		var name=this.series.name;
                      	}

                        dropDaetail(data_source.DATA_PERTW_PER_KAT[(this.index)+1][this.series.options.index_sub],'PELAPORAN DAK TW '+(this.index+1)+' '+name+' TAHUN {{HP::front_tahun()}}');
                      }
                  }
            }
        },

    },
    series:[
    	{
            id:"S_REGULER",
     		name:'REGULER',
     		visible:false,
     		index_sub:1,
     		dataLabels:{
     			formatter:function(){
           			 return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][1].pagu:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][1].pagu:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][1].pagu:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][1].pagu:0]
     	},
     	{   
            linkedTo:"S_REGULER",
     		name:'REALISASI KEUANGAN REGULER',
     		visible:false,
     		index_sub:1,
     		dataLabels:{
     			formatter:function(){
           			 return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][1].realisasi_keuangan:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][1].realisasi_keuangan:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][1].realisasi_keuangan:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][1].realisasi_keuangan:0]

     	},
     	{
            linkedTo:"S_REGULER",
     		name:'PERENCANNAN VOLUME REGULER',
     		visible:false,
     		index_sub:1,
     		dataLabels:{
     			formatter:function(){
           			 return ''+formatNumber(this.y)+''
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][1].perencanaan_volume:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][1].perencanaan_volume:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][1].perencanaan_volume:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][1].perencanaan_volume:0]

     	},
     	{
            linkedTo:"S_REGULER",
     		name:'REALISASI VOLUME REGULER',
     		visible:false,
     		index_sub:1,
     		dataLabels:{
     			formatter:function(){
           			 return ''+formatNumber(this.y)+''
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][1].realisasi_volume:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][1].realisasi_volume:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][1].realisasi_volume:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][1].realisasi_volume:0]

     	},
     	// ---------------------------------------


     	{
            id:"S_PENUGASAN",
     		name:'PENUGASAN',
     		visible:false,
     		index_sub:2,
     		dataLabels:{
     			formatter:function(){
           			 return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][2].pagu:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][2].pagu:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][2].pagu:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][2].pagu:0]
     	},
     	{   
            linkedTo:"S_PENUGASAN",
     		name:'REALISASI KEUANGAN PENUGASAN',
     		visible:false,
     		index_sub:2,
     		dataLabels:{
     			formatter:function(){
           			 return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][2].realisasi_keuangan:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][2].realisasi_keuangan:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][2].realisasi_keuangan:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][2].realisasi_keuangan:0]

     	},
     	{
            linkedTo:"S_PENUGASAN",
     		name:'PERENCANNAN VOLUME PENUGASAN',
     		visible:false,
     		index_sub:2,
     		dataLabels:{
     			formatter:function(){
           			 return ''+formatNumber(this.y)+''
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][2].perencanaan_volume:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][2].perencanaan_volume:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][2].perencanaan_volume:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][2].perencanaan_volume:0]

     	},
     	{
            linkedTo:"S_PENUGASAN",
     		name:'REALISASI VOLUME PENUGASAN',
     		visible:false,
     		index_sub:2,
     		dataLabels:{
     			formatter:function(){
           			 return ''+formatNumber(this.y)+''
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][2].realisasi_volume:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][2].realisasi_volume:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][2].realisasi_volume:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][2].realisasi_volume:0]

     	},
    // ---------------------------------


     	{
            id:"S_AFFIRMASI",
     		name:'AFFIRMASI',
     		visible:false,
     		index_sub:3,
     		dataLabels:{
     			formatter:function(){
           			 return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][3].pagu:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][3].pagu:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][3].pagu:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][3].pagu:0]
     	},
     	{   
            linkedTo:"S_AFFIRMASI",
     		name:'REALISASI KEUANGAN AFFIRMASI',
     		visible:false,
     		index_sub:3,
     		dataLabels:{
     			formatter:function(){
           			 return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][3].realisasi_keuangan:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][3].realisasi_keuangan:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][3].realisasi_keuangan:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][3].realisasi_keuangan:0]

     	},
     	{
            linkedTo:"S_AFFIRMASI",
     		name:'PERENCANNAN VOLUME AFFIRMASI',
     		visible:false,
     		index_sub:3,
     		dataLabels:{
     			formatter:function(){
           			 return ''+formatNumber(this.y)+''
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][3].perencanaan_volume:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][3].perencanaan_volume:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][3].perencanaan_volume:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][3].perencanaan_volume:0]

     	},
     	{
            linkedTo:"S_AFFIRMASI",
     		name:'REALISASI VOLUME AFFIRMASI',
     		visible:false,
     		index_sub:3,
     		dataLabels:{
     			formatter:function(){
           			 return ''+formatNumber(this.y)+''
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][3].realisasi_volume:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][3].realisasi_volume:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][3].realisasi_volume:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][3].realisasi_volume:0]

     	},
    
    	// ------------------------------------------------


     	{
            id:"S_NONFISIK",
     		name:'NONFISIK',
     		visible:false,
     		index_sub:4,
     		dataLabels:{
     			formatter:function(){
           			 return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][4].pagu:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][4].pagu:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][4].pagu:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][4].pagu:0]
     	},
     	{   
            linkedTo:"S_NONFISIK",
     		name:'REALISASI KEUANGAN NONFISIK',
     		visible:false,
     		index_sub:4,
     		dataLabels:{
     			formatter:function(){
           			 return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][4].realisasi_keuangan:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][4].realisasi_keuangan:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][4].realisasi_keuangan:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][4].realisasi_keuangan:0]

     	},
     	{
            linkedTo:"S_NONFISIK",
     		name:'PERENCANNAN VOLUME NONFISIK',
     		visible:false,
     		index_sub:4,
     		dataLabels:{
     			formatter:function(){
           			 return ''+formatNumber(this.y)+''
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][4].perencanaan_volume:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][4].perencanaan_volume:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][4].perencanaan_volume:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][4].perencanaan_volume:0]

     	},
     	{
            linkedTo:"S_NONFISIK",
     		name:'REALISASI VOLUME NONFISIK',
     		visible:false,
     		index_sub:4,
     		dataLabels:{
     			formatter:function(){
           			 return ''+formatNumber(this.y)+''
          		},
                enabled: true
     		},
     		data:[(data_source.PERTW_PER_KAT[1]!=undefined?data_source.PERTW_PER_KAT[1][4].realisasi_volume:0),data_source.PERTW_PER_KAT[2]!=undefined?data_source.PERTW_PER_KAT[2][4].realisasi_volume:0,data_source.PERTW_PER_KAT[3]!=undefined?data_source.PERTW_PER_KAT[3][4].realisasi_volume:0,data_source.PERTW_PER_KAT[4]!=undefined?data_source.PERTW_PER_KAT[4][4].realisasi_volume:0]

     	}
    
    ]
});





function getSeriesBreak(series){
  var domx='';
 var thisSeriesName = series.name;
    var thisSeriesVisibility = series.visible ? true : false;
    $(PERTW_PER_KAT.series).each(function(i, e) {
        
        if (thisSeriesName !== e.name) {

          if(e.linkedParent!=undefined){


              if(e.linkedParent.name===thisSeriesName){
          var class_visib='';

                 if(thisSeriesVisibility){
                    e.hide();
                  }else{
                    e.show();
                     class_visib='bg-primary';
                  }
                 domx+=('<li onclick="series_show(this,'+i+')" class="cursor-point list-group-item text-dark  '+class_visib+'">'+e.name+'</li>');
              }else{
                e.hide();
              }
          }else{
            e.hide()
          }

        } else {
          var class_visib='';

          if(thisSeriesVisibility){
            e.hide();
          }else{
            e.show();
             class_visib='bg-primary';
          }

          domx+=('<li onclick="series_show(this,'+i+')" class="cursor-point list-group-item text-dark '+class_visib+'">'+e.name+'</li>');

        }

    });
        $('#pelaporan_chart_kat_foot ul').html(domx);
}

var cak=[];
function series_show(dom,index){
    cak=PERTW_PER_KAT.series[index];
   if(PERTW_PER_KAT.series[index].visible){
    $(dom).removeClass('bg-primary');
    PERTW_PER_KAT.series[index].hide();
   }else{
    $(dom).addClass('bg-primary');
    PERTW_PER_KAT.series[index].show();
   }
}

setTimeout(function(){
  getSeriesBreak(PERTW_PER_KAT.series[0]);

},1000);

var data_table;
function dropDaetail(data_page,title=''){
  $('#table-view .box-header .title').html(title);
  var dom=$('#table-view').css('display');
  if(dom=='none'){
   $('#table-view').css('display','block');
     data_table=$('#view_in_table').DataTable({

        	dom: 'Bfrtip',
     	 buttons: [
            {
                extend: 'excelHtml5',
                text: 'DOWNLOAD EXCEL',
                className:'btn btn-success btn-xs',
                messageTop: title,
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6 ]
                }
            },
        ],
       drawCallback: function () {
        var api = this.api();
        $(api.table().column(0).footer()).html('TOTAL');

        for($i=2;$i<=5;$i++){
          $(api.table().column($i).footer()).html(
              api.column($i).data().sum().toFixed(2)
          );  

         	
        }
         persentase=((parseFloat($(api.table().column(5).footer()).html())/$(api.table().column(4).footer()).html())*100).toFixed(2);
	        if(Number.isNaN(persentase)|| persentase==='NaN'){
	          $(api.table().column(6).footer()).html('0%');
	        }else{
	          if((persentase===Infinity) || persentase==='Infinity'){
	          $(api.table().column(6).footer()).html('0%');
	          }else{
	          $(api.table().column(6).footer()).html(persentase+'%');
	          }
	        }

	        for($i=2;$i<=5;$i++){
	          $(api.table().column($i).footer()).html(formatNumber($(api.table().column($i).footer()).html()));
	        }
      },
      // sort:false,
      columns:[
        {
          data:'kode',
          type:'string'

        },
        {
          data:'nama_daerah',
          type:'string'

        },
        {
          data:'pagu',
          type:'currency',
          render:function(data){
            data=data!=null?(data):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'realisasi_keuangan',
          type:'currency',
          render:function(data){
            data=data!=null?(data):'';

            return ''+formatNumber(data);
          }
        },
         {
          data:'perencanaan_volume',
          type:'currency',
          render:function(data){
            data=data!=null?(data):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'realisasi_volume',
          type:'currency',
          render:function(data){
            data=data!=null?(data):'';

            return ''+formatNumber(data);
          }
        },
        {
          type:'string',
          render:function(data,type,dataRow){
            var rv=((parseFloat(dataRow.perencanaan_volume ) / parseFloat(dataRow.realisasi_volume))*100).toFixed(2);
        
            if(Number.isNaN(rv)|| rv==='NaN'){
              return '0%';
            }else{
              if((rv===Infinity) || rv==='Infinity'){
                return '0%';
              }else{
              return (parseFloat(rv))+'%';

              }
            }
          }
        },
     
        {
          data:'file_path',
          type:'html',
          render:function(data,type,data_row,meta){
            return '<div class="btn-group">'+'<a href="{{url('/pelaporan/detail-data/')}}/'+data_row.kode_daerah+'/'+data_row.tw+'" target="_blank" class="btn btn-success btn-xs">Detail</a></div>';
          }

        },
        
      ]
    });
  }else{

  }


  data_table.clear();
  data_table.rows.add(data_page).draw();

  $('html, body').animate({
       scrollTop: $("#table-view").offset().top
   }, 1500);


}


</script>

@stop