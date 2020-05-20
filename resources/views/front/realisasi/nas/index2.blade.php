@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="text-center">REALISASI NASIOANAL</h1>
@stop

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body" id="pelaporan_chart">

      </div>

    </div>

  </div>
    <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body" id="pelaporan_chart_kat">

      </div>
        <div class="box-footer text-center" id="pelaporan_chart_kat_foot">
        <ul class="list-group list-group-horizontal"></ul>
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
            <th rowspan="2">REL PERKATEGORY</th>
            <th colspan="3" class="text-center">REALISASI</th>
            <th rowspan="2">FILE LAPORAN</th>

          </tr>
          <tr>
               <th>PAGU <small>(RP.(RIBUAN))</small></th>
              <th>KEUANGAN <small>(RP.(RIBUAN))</small></th>
              <th>FISIK <small>(Unit)</small></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <th colspan="3" class="text-center">TOTAL</th>
          <th></th>
          <th></th>
          <th>-</th>
          <th>-</th>



        </tfoot>

        </table>
      </div>

    </div>

  </div>

</div>
@stop


@section('js')
<script type="text/javascript">
Highcharts.chart('pelaporan_chart', {
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
        // tickmarkPlacement: 'on',
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
                        dropDaetail((this.index)+1);
                      }
                  }
            }
        },

    },
    series: [
      {
        name: 'PAGU YANG DI ANGGARKAN',
         dataLabels: {
          formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
          },

        data: [{{$data['reakap_realisasi']['1']['pagu']}},{{$data['reakap_realisasi']['2']['pagu']}},{{$data['reakap_realisasi']['3']['pagu']}},{{$data['reakap_realisasi']['4']['pagu']}}]
        },
        {
        name: 'KEUANGAN',
         dataLabels: {
          formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
          },

        data: [{{$data['reakap_realisasi']['1']['keuangan']}},{{$data['reakap_realisasi']['2']['keuangan']}},{{$data['reakap_realisasi']['3']['keuangan']}},{{$data['reakap_realisasi']['4']['keuangan']}}]
        },
        {
        name: 'VOLUM FISIK ',
         dataLabels: {
          formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
          },

        data: [{{$data['reakap_realisasi']['1']['volume_fisik']}},{{$data['reakap_realisasi']['2']['volume_fisik']}},{{$data['reakap_realisasi']['3']['volume_fisik']}},{{$data['reakap_realisasi']['4']['volume_fisik']}}]
        },


      ]
});

var perkatchart= Highcharts.chart('pelaporan_chart_kat', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'REALISASI PERKATEGORI  DAK TAHUN {{HP::front_tahun()}}'
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
                        console.log(this);
                        dropDaetail((this.index)+1);
                      }
                  }
            }
        },

    },
    series: [
      {
        name: 'PAGU REGULER',
        id:'reguler_s',
        visible:false,
         dataLabels: {
          formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
          },

        tooltip: {
          split: true,
            valuePrefix: 'Rp. ',
            valueSuffix:' (ribuan)'
        },
        data: [{{$data['reakap_realisasi']['1']['pagu_reguler']}},{{$data['reakap_realisasi']['2']['pagu_reguler']}},{{$data['reakap_realisasi']['3']['pagu_reguler']}},{{$data['reakap_realisasi']['4']['pagu_reguler']}}]
        },
        {
        name: 'KEUANGAN REGULER',
         dataLabels: {
          formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
    },
         linkedTo: 'reguler_s',
           tooltip: {
          split: true,
            valuePrefix: 'Rp. ',
            valueSuffix:' (ribuan)'
        },
        visible:false,
        data: [{{$data['reakap_realisasi']['1']['keuangan_reguler']}},{{$data['reakap_realisasi']['2']['keuangan_reguler']}},{{$data['reakap_realisasi']['3']['keuangan_reguler']}},{{$data['reakap_realisasi']['4']['keuangan_reguler']}}]
        },
        {
        name: 'VOLUM REGULER ',
         dataLabels: {
          formatter:function(){
            return ''+formatNumber(this.y)+''
          },
                enabled: true
    },
         linkedTo: 'reguler_s',
           tooltip: {
          split: true,
            valuePrefix: 'Rp. ',
            valueSuffix:' (ribuan)'
        },

        data: [{{$data['reakap_realisasi']['1']['volume_fisik_reguler']}},{{$data['reakap_realisasi']['2']['volume_fisik_reguler']}},{{$data['reakap_realisasi']['3']['volume_fisik_reguler']}},{{$data['reakap_realisasi']['4']['volume_fisik_reguler']}}]
        },
        {
        name: 'PAGU PENUGASAN',
         dataLabels: {
          formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
         },
        id:'penugasan_s',
        visible:false,

          tooltip: {
          split: true,
            valuePrefix: 'Rp. ',
            valueSuffix:' (ribuan)'
        },
        data: [{{$data['reakap_realisasi']['1']['pagu_penugasan']}},{{$data['reakap_realisasi']['2']['pagu_penugasan']}},{{$data['reakap_realisasi']['3']['pagu_penugasan']}},{{$data['reakap_realisasi']['4']['pagu_penugasan']}}]
        },
        {
        name: 'KEUANGAN PENUGASAN',
         dataLabels: {
           formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
        },
         linkedTo: 'penugasan_s',
           tooltip: {
          split: true,
            valuePrefix: 'Rp. ',
            valueSuffix:' (ribuan)'
        },

        data: [{{$data['reakap_realisasi']['1']['keuangan_penugasan']}},{{$data['reakap_realisasi']['2']['keuangan_penugasan']}},{{$data['reakap_realisasi']['3']['keuangan_penugasan']}},{{$data['reakap_realisasi']['4']['keuangan_penugasan']}}]
        },
        {
        name: 'VOLUM PENUGASAN ',
         dataLabels: {
           formatter:function(){
            return ''+formatNumber(this.y)+''
          },
            enabled: true
        },
         linkedTo: 'penugasan_s',
           tooltip: {
          split: true,
            valuePrefix: 'Rp. ',
            valueSuffix:' (ribuan)'
        },

        data: [{{$data['reakap_realisasi']['1']['volume_fisik_penugasan']}},{{$data['reakap_realisasi']['2']['volume_fisik_penugasan']}},{{$data['reakap_realisasi']['3']['volume_fisik_penugasan']}},{{$data['reakap_realisasi']['4']['volume_fisik_penugasan']}}]
        },
          {
        name: 'PAGU AFFIRMASI',
         dataLabels: {
          formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
    },
        id:'affirmasi_s',
        visible:false,

          tooltip: {
          split: true,
            valuePrefix: 'Rp. ',
            valueSuffix:' (ribuan)'
        },
        data: [{{$data['reakap_realisasi']['1']['pagu_affirmasi']}},{{$data['reakap_realisasi']['2']['pagu_affirmasi']}},{{$data['reakap_realisasi']['3']['pagu_affirmasi']}},{{$data['reakap_realisasi']['4']['pagu_affirmasi']}}]
        },
        {
        name: 'KEUANGAN AFFIRMASI',
         dataLabels: {
            formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
    },
          tooltip: {
          split: true,
            valuePrefix: 'Rp. ',
            valueSuffix:' (ribuan)'
        },
         linkedTo: 'affirmasi_s',

        data: [{{$data['reakap_realisasi']['1']['keuangan_affirmasi']}},{{$data['reakap_realisasi']['2']['keuangan_affirmasi']}},{{$data['reakap_realisasi']['3']['keuangan_affirmasi']}},{{$data['reakap_realisasi']['4']['keuangan_affirmasi']}}]
        },
        {
        name: 'VOLUM FISIK AFFIRMASI ',
         dataLabels: {
            formatter:function(){
            return ''+formatNumber(this.y)+''
          },
                enabled: true
    },
          tooltip: {
          split: true,
            valuePrefix: 'Rp. ',
            valueSuffix:' (ribuan)'
        },
         linkedTo: 'affirmasi_s',

        data: [{{$data['reakap_realisasi']['1']['volume_fisik_affirmasi']}},{{$data['reakap_realisasi']['2']['volume_fisik_affirmasi']}},{{$data['reakap_realisasi']['3']['volume_fisik_affirmasi']}},{{$data['reakap_realisasi']['4']['volume_fisik_affirmasi']}}]
        },
        {
        name: 'PAGU NON FISIK',
         dataLabels: {
            formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
    },
        id:'non_fisik_s',
        visible:false,

          tooltip: {
          split: true,
            valuePrefix: 'Rp. ',
            valueSuffix:' (ribuan)'
        },

        data: [{{$data['reakap_realisasi']['1']['pagu_non_fisik']}},{{$data['reakap_realisasi']['2']['pagu_non_fisik']}},{{$data['reakap_realisasi']['3']['pagu_non_fisik']}},{{$data['reakap_realisasi']['4']['pagu_non_fisik']}}]
        },
        {
        name: 'KEUANGAN NON FISIK',
         dataLabels: {
            formatter:function(){
            return 'Rp. '+formatNumber(this.y)+' (Ribuan)'
          },
                enabled: true
    },
         linkedTo: 'non_fisik_s',

        data: [{{$data['reakap_realisasi']['1']['keuangan_non_fisik']}},{{$data['reakap_realisasi']['2']['keuangan_non_fisik']}},{{$data['reakap_realisasi']['3']['keuangan_non_fisik']}},{{$data['reakap_realisasi']['4']['keuangan_non_fisik']}}]
        },
       

      ]
});

function getSeriesBreak(series){
  var domx='';
 var thisSeriesName = series.name;
    var thisSeriesVisibility = series.visible ? true : false;
    $(perkatchart.series).each(function(i, e) {
        
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
    cak=perkatchart.series[index];
   if(perkatchart.series[index].visible){
    $(dom).removeClass('bg-primary');
    perkatchart.series[index].hide();
   }else{
    $(dom).addClass('bg-primary');
    perkatchart.series[index].show();
   }
}

setTimeout(function(){
  getSeriesBreak(perkatchart.series[0]);

},1000);


var data_page=<?php echo json_encode($data,true); ?>;
var data_table='';
function dropDaetail(index){
  $('#table-view .box-header .title').html('REALISASI DAK TW '+index);
  var dom=$('#table-view').css('display');
  if(dom=='none'){
   $('#table-view').css('display','block');
     data_table=$('#view_in_table').DataTable({
       drawCallback: function () {
        var api = this.api();
        for($i=3;$i<=4;$i++){
          $(api.table().column($i).footer()).html(
              api.column($i).data().sum().toFixed(2)
          );  
        }
      },
      // sort:false,
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
          type:'html',
          render:function(data,type,data_row,meta){
            return '<a download href="{{url('storage/files/'.HP::front_tahun())}}'+'" class="btn btn-info btn-xs">Detail</a>';
          }
        },
        {
          data:'perencanaan_kegiatan_pagu_dak_fisik',
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
          data:'realisasi_fisik_volume',
          type:'currency',
          render:function(data){
            data=data!=null?(data):'';

            return ''+formatNumber(data);
          }
        },
        {
          data:'file_path',
          type:'html',
          render:function(data,type,data_row,meta){
            return '<div class="btn-group"><a download href="{{url('storage/files/'.HP::front_tahun())}}'+'/'+data+'" class="btn btn-primary btn-xs">Download</a>'+'<a href="{{url('/pelaporan/detail-data/')}}/'+data_row.kode_daerah+'/'+data_row.tw+'" target="_blank" class="btn btn-success btn-xs">Detail</a></div>';
          }

        },
        
      ]
    });
  }else{

  }


  // console.log(JSON.stringyfy);
  data_table.clear();
  data_table.rows.add(data_page.data_daerah[''+index]).draw();
  $('html, body').animate({
       scrollTop: $("#table-view").offset().top
   }, 1500);


}

</script>



@stop
