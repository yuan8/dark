@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="text-center">PELAPORAN DAK TW {{$tw}}</h1>
@stop

@section('content')

<div class="" id="map" style="min-height: 400px;">
	
</div>
<style type="text/css">
.navigator-list-h {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    margin-top: 10px;
    margin-bottom: 10px;
}
.navigator-list-h li {
    float: left;
    margin-left: 10px;
}
</style>
<ul class="navigator-list-h">
  <li><label class="" style="background:#00FF00; width:20px; height:20px; border-radius:100%; margin-bottom:-5px;">

  </label> Sangat Tinggi &gt; 80%</li>
  <li><label class="" style="background:#FFFF00; width:20px; height:20px; border-radius:100%; margin-bottom:-5px;">

  </label> Tinggi 60% - 80% </li>
  <li><label class="" style="background:#2C4F9B; width:20px; height:20px; border-radius:100%; margin-bottom:-5px;">

  </label> Sedang 40% - 60%</li>
  <li><label class="" style="background:#cf6317; width:20px; height:20px; border-radius:100%; margin-bottom:-5px;">

  </label> Rendah 30% - 40%</li>
  <li><label class="" style="background:#FF0000; width:20px; height:20px; border-radius:100%; margin-bottom:-5px;">

  </label> Sangat Rendah &lt; 30%</li>
  <li><label class="" style="background:#000; width:20px; height:20px; border-radius:100%; margin-bottom:-5px;">

  </label> Tidak Melapor 0%</li>
</ul>




@stop


@section('js')
<script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiEMHwxngTEjfDfnR-YAzShfCybbeKQeM&language=id&region=IDN">
  </script>

<script type="text/javascript">

  var infowindow = '';

  var data_pro=<?php echo json_encode($data_pro)?>;


  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: {lat:  -0.26369, lng: 115.1325883}
  });

  map.data.loadGeoJson('{{url('map/idn.geojson')}}');

  map.data.setStyle(function(feature) {

    var color='#222';
     if (data_pro[feature.getProperty('KODE')]!=undefined) {
        color = data_pro[feature.getProperty('KODE')].color;
       
    }
    return ({
        fillColor: color,
        strokeColor: '#fff',
      strokeWeight: 0.1,
      fillOpacity:1
    });
  });

   map.data.addListener('mouseover', function(event) {
        if(infowindow!=''){
           infowindow.close();
        }
       
        this.setOptions({fillOpacity:0.3});
        infowindow =  new google.maps.InfoWindow({
        content:'<h5>'+(event.feature.getProperty('NAME_1'))+'</h5><b>PERSENTASE PELAPORAN DAERAH : '+data_pro[event.feature.getProperty('KODE')].persentase+'%</b>'
        ,
        // title: 'Uluru (Ayers Rock)',
        map: map,
        position: event.latLng

        });
        infowindow.open(map, this);
              
              
    });



        
</script>
@stop