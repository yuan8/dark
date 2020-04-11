<h5 class="text-center"><b>PER OPD {{$data['nama']}} {{$data['tahun']}} TW {{$data['tw']}}</b></h5>
<div class="col-md-12" id="map_pro" style="min-height: 350px;"></div>
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
<div class="row">
	<div class="col-md-12">
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
	</div>
</div>

<script type="text/javascript">
var infowindow_pro = '';
var data_detail_pro=<?php echo json_encode($data['data'])?>;
var map_pro = new google.maps.Map(document.getElementById('map_pro'), {
    zoom: 7,
    center: {lat: {{$data['lat']}}, lng: {{$data['lng']}} }
  });

map_pro.data.loadGeoJson('{{$data['geojsonlink']}}');

map_pro.data.setStyle(function(feature) {

    var color='#222';
     if (data_detail_pro[feature.getProperty('id_kab_kot')]!=undefined) {
     	console.log(feature.getProperty('id_kab_kot'));
        color = data_detail_pro[feature.getProperty('id_kab_kot')].COLOR;
    }

    return ({
        fillColor: color,
        strokeColor: '#fff',
      strokeWeight: 0.1,
      fillOpacity:1
    });
  });


map_pro.data.addListener('click',function (event) {
   console.log(event.feature.getProperty('id_kab_kot'));
   console.log(data_detail_pro[event.feature.getProperty('id_kab_kot')]);

   console.log(event.feature);
});


  map_pro.data.addListener('mouseover', function(event) {
        if(infowindow_pro!=''){
           infowindow_pro.close();
        }
       
        this.setOptions({fillOpacity:0.3});
        infowindow_pro =  new google.maps.InfoWindow({
        content:'<h5 class="text-uppercase text-center">'+(data_detail_pro[event.feature.getProperty('id_kab_kot')].NAMA_DAERAH)+'</h5><p class="text-center"><b>'+data_detail_pro[event.feature.getProperty('id_kab_kot')].PERSENTASE+'%</b></p><div class="text-center">'
        +'<a class="btn btn-primary btn-xs" target="_blank" href="{{url('/pelaporan/detail-data/').'/'}}'+data_detail_pro[event.feature.getProperty('id_kab_kot')].KODE_DAERAH+'/'+{{$data['tw']}}+'">Detail</a></div>'
        ,
        // title: 'Uluru (Ayers Rock)',
        map: map_pro,
        position: event.latLng

        });
        infowindow_pro.open(map_pro, this);
              
              
    });
</script>

