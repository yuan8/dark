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

    </div>

  </div>
  <div class="col-md-12"  id="table-view" style="display:none">
    <div class="box box-primary ">
      <div class="box-header with-border">
        <h5 class="text-center"><b class="title"></b> </h5>

      </div>
      <div class="box-body">
        <table class="table table-bordered" id="view_in_table" style="min-width:100%">
        <thead>
          <tr>
            <th>KODE DAERAH</th>
            <th>NAMA DAERAH</th>
            <th>PAGU</th>
            <th>REALISASI KEUNAGAN</th>
            <th>REALISASI FISIK</th>
            <th>DOWNLOAD FILE LAPORAN</th>
            <th>DATA REKAP APLIKASI</th>

          </tr>
        </thead>
        <tbody>

        </tbody>

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
        data: [{{$data['reakap_realisasi']['1']['pagu']}},{{$data['reakap_realisasi']['2']['pagu']}},{{$data['reakap_realisasi']['3']['pagu']}},{{$data['reakap_realisasi']['4']['pagu']}}]
        },
        {
        name: 'KEUANGAN',
        data: [{{$data['reakap_realisasi']['1']['keuangan']}},{{$data['reakap_realisasi']['2']['keuangan']}},{{$data['reakap_realisasi']['3']['keuangan']}},{{$data['reakap_realisasi']['4']['keuangan']}}]
        },
        {
        name: 'VOLUM FISIK ',
        data: [{{$data['reakap_realisasi']['1']['volume_fisik']}},{{$data['reakap_realisasi']['2']['volume_fisik']}},{{$data['reakap_realisasi']['3']['volume_fisik']}},{{$data['reakap_realisasi']['4']['volume_fisik']}}]
        },


      ]
});

Highcharts.chart('pelaporan_chart_kat', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'REALISASI PERKATEGORI DAK TAHUN {{HP::front_tahun()}}'
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
        column: {
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
        name: 'PAGU REGULER',
        data: [{{$data['reakap_realisasi']['1']['pagu_reguler']}},{{$data['reakap_realisasi']['2']['pagu_reguler']}},{{$data['reakap_realisasi']['3']['pagu_reguler']}},{{$data['reakap_realisasi']['4']['pagu_reguler']}}]
        },
        {
        name: 'KEUANGAN REGULER',
        data: [{{$data['reakap_realisasi']['1']['keuangan_reguler']}},{{$data['reakap_realisasi']['2']['keuangan_reguler']}},{{$data['reakap_realisasi']['3']['keuangan_reguler']}},{{$data['reakap_realisasi']['4']['keuangan_reguler']}}]
        },
        {
        name: 'VOLUM FISIK REGULER ',
        data: [{{$data['reakap_realisasi']['1']['volume_fisik_reguler']}},{{$data['reakap_realisasi']['2']['volume_fisik_reguler']}},{{$data['reakap_realisasi']['3']['volume_fisik_reguler']}},{{$data['reakap_realisasi']['4']['volume_fisik_reguler']}}]
        },
        {
        name: 'PAGU PENUGASAN',
        data: [{{$data['reakap_realisasi']['1']['pagu_penugasan']}},{{$data['reakap_realisasi']['2']['pagu_penugasan']}},{{$data['reakap_realisasi']['3']['pagu_penugasan']}},{{$data['reakap_realisasi']['4']['pagu_penugasan']}}]
        },
        {
        name: 'KEUANGAN PENUGASAN',
        data: [{{$data['reakap_realisasi']['1']['keuangan_penugasan']}},{{$data['reakap_realisasi']['2']['keuangan_penugasan']}},{{$data['reakap_realisasi']['3']['keuangan_penugasan']}},{{$data['reakap_realisasi']['4']['keuangan_penugasan']}}]
        },
        {
        name: 'VOLUM FISIK PENUGASAN ',
        data: [{{$data['reakap_realisasi']['1']['volume_fisik_penugasan']}},{{$data['reakap_realisasi']['2']['volume_fisik_penugasan']}},{{$data['reakap_realisasi']['3']['volume_fisik_penugasan']}},{{$data['reakap_realisasi']['4']['volume_fisik_penugasan']}}]
        },
          {
        name: 'PAGU AFFIRMASI',
        data: [{{$data['reakap_realisasi']['1']['pagu_affirmasi']}},{{$data['reakap_realisasi']['2']['pagu_affirmasi']}},{{$data['reakap_realisasi']['3']['pagu_affirmasi']}},{{$data['reakap_realisasi']['4']['pagu_affirmasi']}}]
        },
        {
        name: 'KEUANGAN AFFIRMASI',
        data: [{{$data['reakap_realisasi']['1']['keuangan_affirmasi']}},{{$data['reakap_realisasi']['2']['keuangan_affirmasi']}},{{$data['reakap_realisasi']['3']['keuangan_affirmasi']}},{{$data['reakap_realisasi']['4']['keuangan_affirmasi']}}]
        },
        {
        name: 'VOLUM FISIK AFFIRMASI ',
        data: [{{$data['reakap_realisasi']['1']['volume_fisik_affirmasi']}},{{$data['reakap_realisasi']['2']['volume_fisik_affirmasi']}},{{$data['reakap_realisasi']['3']['volume_fisik_affirmasi']}},{{$data['reakap_realisasi']['4']['volume_fisik_affirmasi']}}]
        },
        {
        name: 'PAGU NON FISIK',
        data: [{{$data['reakap_realisasi']['1']['pagu_non_fisik']}},{{$data['reakap_realisasi']['2']['pagu_non_fisik']}},{{$data['reakap_realisasi']['3']['pagu_non_fisik']}},{{$data['reakap_realisasi']['4']['pagu_non_fisik']}}]
        },
        {
        name: 'KEUANGAN NON FISIK',
        data: [{{$data['reakap_realisasi']['1']['keuangan_non_fisik']}},{{$data['reakap_realisasi']['2']['keuangan_non_fisik']}},{{$data['reakap_realisasi']['3']['keuangan_non_fisik']}},{{$data['reakap_realisasi']['4']['keuangan_non_fisik']}}]
        },
       

      ]
});


var data_page=<?php echo json_encode($data,true); ?>;
var data_table='';
function dropDaetail(index){
  $('#table-view .box-header .title').html('PELAPORAN DAK TW '+index);
  var dom=$('#table-view').css('display');
  if(dom=='none'){
    $('#table-view').css('display','block');
     data_table=$('#view_in_table').DataTable({
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
          data:'perencanaan_kegiatan_pagu_dak_reguler',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return 'Rp. '+formatNumber(data);
          }
        },
        {
          data:'realisasi_keuangan',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';

            return 'Rp. '+formatNumber(data);
          }
        },
        {
          data:'realisasi_reguler_volume',
          type:'string',
          render:function(data){
            data=data!=null?(data+''):'';
            return 'Rp. '+formatNumber(data);
          }
        },
        {
          data:'file_path',
          type:'html',
          render:function(data){
            return '<a download href="{{url('storage/files/'.HP::front_tahun())}}'+'/'+data+'" class="btn btn-primary btn-xs">Download</a>';
          }

        },
        {
          type:'html',
          render:function(data,type,data_row,meta){
            return '<a href="{{url('/pelaporan/detail-data/')}}/'+data_row.kode_daerah+'" target="_blank" class="btn btn-success btn-xs">Detail</a>';
          }
        }
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
