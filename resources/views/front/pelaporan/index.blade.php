@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="text-center">PELAPORAN DAK</h1>
@stop

@section('content')

<div class="row">
  <div class="col-md-12">
<div class="box box-primary">
<div class="box-body" id="pelaporan_chart">

</div>

</div>

  </div>
  <div class="col-md-12"  id="table-view" style="display:none">
    <div class="box box-primary ">
      <div class="box-header with-border">
        <h5 class="text-center"><b class="title"></b> </h5>

      </div>
      <div class="box-body">

      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">SEMUA</a></li>
        <li><a data-toggle="tab" href="#menu1">FISIK</a></li>
        <li><a data-toggle="tab" href="#menu2">NON FISIK</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
                  <table class="table table-bordered" id="view_in_table" style="min-width:100%">
        <thead>
          <tr>
            <th>KODE DAERAH</th>
            <th>NAMA DAERAH</th>
            <th>PAGU</th>
            <th>REALISASI KEUNAGAN</th>
            <th>PERENCANAAN VOLUME </th>

            <th>REALISASI VOLUME</th>
            <th>REALISASI VOLUME PERSENTASE</th>

            <th>DATA REKAP APLIKASI</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
          <tr>
            <th colspan="2"></th>

            <th></th>

            <th></th>

            <th></th>

            <th></th>
            <th colspan=""></th>

          </tr>
        </tfoot>

        </table>

         
        </div>
        <div id="menu1" class="tab-pane fade">
                  <table class="table table-bordered" id="table_fisik" style="min-width:100%">
        <thead>
          <tr>
            <th>KODE DAERAH</th>
            <th>NAMA DAERAH</th>
            <th>PAGU</th>
            <th>REALISASI KEUNAGAN</th>
            <th>PERENCANAAN VOLUME </th>

            <th>REALISASI VOLUME</th>
            <th>REALISASI VOLUME PERSENTASE</th>

            <th>DATA REKAP APLIKASI</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
          <tr>
            <th colspan="2"></th>

            <th></th>

            <th></th>

            <th></th>

            <th></th>
            <th colspan=""></th>

          </tr>
        </tfoot>

        </table>

         
        </div>
        <div id="menu2" class="tab-pane fade">
                  <table class="table table-bordered" id="table_non_fisik" style="min-width:100%">
        <thead>
          <tr>
            <th>KODE DAERAH</th>
            <th>NAMA DAERAH</th>
            <th>PAGU</th>
            <th>REALISASI KEUNAGAN</th>
            <th>PERENCANAAN VOLUME </th>

            <th>REALISASI VOLUME</th>
            <th>REALISASI VOLUME PERSENTASE</th>

            <th>DATA REKAP APLIKASI</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
          <tr>
            <th colspan="2"></th>

            <th></th>

            <th></th>

            <th></th>

            <th></th>
            <th colspan=""></th>

          </tr>
        </tfoot>

        </table>

         
        </div>
      </div>

      </div>

    </div>

  </div>

</div>
@stop


@section('js')
<script type="text/javascript">
Highcharts.chart('pelaporan_chart', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'TINGKAT PELAPORAN DAK TAHUN {{HP::front_tahun()}}'
    },
    subtitle: {
        // text: 'Source: Wikipedia.org'
    },
    xAxis: {
        categories: ['TW I','TW II','TW III','TW IV'],
        tickmarkPlacement: 'on',
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
    tooltip: {
        split: true,
        valueSuffix: ' DAERAH'
    },
    dataLabel:{
      enabled:true
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
                        dropDaetail((this.index)+1);
                      }
                  }
            }
        },

    },
    series: [{
        name: 'TINGKAT PELAPORAN',
        dataLabels: {
              enabled: true,
               formatter:function(){
                return this.y+' DAERAH';
               }
        },
        data: [{{count($data['data_daerah']['1'])}}, {{count($data['data_daerah']['2'])}}, {{count($data['data_daerah']['3'])}}, {{count($data['data_daerah']['4'])}}]
        }
      ]
});

var data_page=<?php echo json_encode($data,true); ?>;
var data_page_fisik=<?php echo json_encode($fisik,true); ?>;
var data_page_non_fisik=<?php echo json_encode($non_fisik,true); ?>;


var data_table='';
function dropDaetail(index){
  $('#table-view .box-header .title').html('PELAPORAN DAK TW '+index);
  var dom=$('#table-view').css('display');
  if(dom=='none'){
    $('#table-view').css('display','block');

     table_non_fisik=$('#table_non_fisik').DataTable({
       // sort:false,
        dom: 'Bfrtip',
        drawCallback: function () {
        var api = this.api();
        $(api.table().column(0).footer() ).html('TOTAL');
        $(api.table().column(6).footer() ).html('-');

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
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'DOWNLOAD EXCEL',
                className:'btn btn-success btn-xs',
                messageTop: 'REKAP DAERAH PELAPOR DAK TAHUN {{HP::front_tahun()}} (NON FISIK)',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6 ]
                }
            },
        ],
      columns:[
        {
          data:'kode_daerah',
          type:'string'

        },
        {
          data:'nama_daerah',
          type:'string'

        },
        {
          data:'perencanaan_kegiatan_pagu_dak_fisik',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'realisasi_keuangan',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'perencanaan_kegiatan_volume',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'realisasi_fisik_volume',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';
            return ''+formatNumber(data);
          }
        },
         {
          type:'string',
          render:function(data,type,dataRow){
            var rv=((parseFloat(dataRow.realisasi_fisik_volume ) / parseFloat(dataRow.perencanaan_kegiatan_volume))*100).toFixed(2);
        
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
          type:'html',
          orderable:false,

          render:function(data,type,data_row,meta){
            return '<a href="{{url('/pelaporan/detail-data/')}}/'+data_row.kode_daerah+'" target="_blank" class="btn btn-success btn-xs">Detail</a>';
          }
        }
      ]
    });





      // ---------------------------------- 

        table_fisik=$('#table_fisik').DataTable({
       // sort:false,
        dom: 'Bfrtip',
        drawCallback: function () {
        var api = this.api();
        $(api.table().column(0).footer() ).html('TOTAL');
        $(api.table().column(6).footer() ).html('-');

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
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'DOWNLOAD EXCEL',
                className:'btn btn-success btn-xs',
                messageTop: 'REKAP DAERAH PELAPOR DAK TAHUN {{HP::front_tahun()}} (FISIK)',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6 ]
                }
            },
        ],
      columns:[
        {
          data:'kode_daerah',
          type:'string'

        },
        {
          data:'nama_daerah',
          type:'string'

        },
        {
          data:'perencanaan_kegiatan_pagu_dak_fisik',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'realisasi_keuangan',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'perencanaan_kegiatan_volume',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'realisasi_fisik_volume',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';
            return ''+formatNumber(data);
          }
        },
         {
          type:'string',
          render:function(data,type,dataRow){
            var rv=((parseFloat(dataRow.realisasi_fisik_volume ) / parseFloat(dataRow.perencanaan_kegiatan_volume))*100).toFixed(2);
        
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
          type:'html',
          orderable:false,

          render:function(data,type,data_row,meta){
            return '<a href="{{url('/pelaporan/detail-data/')}}/'+data_row.kode_daerah+'" target="_blank" class="btn btn-success btn-xs">Detail</a>';
          }
        }
      ]
    });


      // ------------------------------------
   
        data_table=$('#view_in_table').DataTable({
       // sort:false,
        dom: 'Bfrtip',
        drawCallback: function () {
        var api = this.api();
        $(api.table().column(0).footer() ).html('TOTAL');
        $(api.table().column(6).footer() ).html('-');

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
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'DOWNLOAD EXCEL',
                className:'btn btn-success btn-xs',
                messageTop: 'REKAP DAERAH PELAPOR DAK TAHUN {{HP::front_tahun()}}',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6 ]
                }
            },
        ],
      columns:[
        {
          data:'kode_daerah',
          type:'string'

        },
        {
          data:'nama_daerah',
          type:'string'

        },
        {
          data:'perencanaan_kegiatan_pagu_dak_fisik',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'realisasi_keuangan',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'perencanaan_kegiatan_volume',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'realisasi_fisik_volume',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';
            return ''+formatNumber(data);
          }
        },
         {
          type:'string',
          render:function(data,type,dataRow){
            var rv=((parseFloat(dataRow.realisasi_fisik_volume ) / parseFloat(dataRow.perencanaan_kegiatan_volume))*100).toFixed(2);
        
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
          type:'html',
          orderable:false,

          render:function(data,type,data_row,meta){
            return '<a href="{{url('/pelaporan/detail-data/')}}/'+data_row.kode_daerah+'" target="_blank" class="btn btn-success btn-xs">Detail</a>';
          }
        }
      ]
    });

    // -------------------------------



  }else{

  }

  data_table.clear();
  table_fisik.clear();

  table_non_fisik.clear();

  table_fisik.rows.add(data_page_fisik.data_daerah[''+index]).draw();

  table_non_fisik.rows.add(data_page_non_fisik.data_daerah[''+index]).draw();

  data_table.rows.add(data_page.data_daerah[''+index]).draw();


  $('html, body').animate({
       scrollTop: $("#table-view").offset().top
   }, 1500);


}

</script>



@stop
