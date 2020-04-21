@extends('adminlte::page')


@section('content_header')
<h1 class="text-uppercase text-center"><b>BIDANG {{$bidang}}</b> TW {{$tw}} KATEGORI {{$kategory}}</h1>
@stop

@section('content')
    <div class="row">
      <form action="{{route('f.sanitasi')}}" method="GET">
          <div class="col-md-4">
         <select class="form-control" name="kode_daerah">
          @foreach($daerahs as $d)
          <option value="{{$d->id}}" {{$d->id==$kode_daerah?'selected':''}}>{{$d->nama}}</option>

          @if($d->id==$kode_daerah)

          <?php $nama_daerah=$d->nama; ?>
          @endif

          @endforeach
        </select>
        
      </div>
      <div class="col-md-4">
         <select class="form-control" name="kat">
          <option value="1" {{$kat==1?'selected':''}}>REGULER</option>
          <option value="2" {{$kat==2?'selected':''}}>PENUGASAN</option>
          <option value="3" {{$kat==3?'selected':''}}>AFFIRMASI</option>
          <option value="4" {{$kat==4?'selected':''}}>NON FISIK</option>

        </select>
        
      </div>
      <div class="col-md-4">
          <select class="form-control" name="tw">
            <option value="1" {{$tw==1?'selected':''}}>I</option>
            <option value="2" {{$tw==2?'selected':''}}>II</option>
            <option value="3" {{$tw==3?'selected':''}}>III</option>
            <option value="4" {{$tw==4?'selected':''}}>IV</option>
          
        </select>
      </div>

      <div class="col-md-12 btn-group" style="margin-top:15px;">
        <button  type="submit" class="btn btn-primary  btn-sm">Submit</button>
        <button  onclick="exportTableToExcel('data_perbidang','{{$nama_daerah}}')" class="btn btn-success  btn-sm">Download</button>

      </div>

      </form>
      <div class="col-md-12" style="margin-top:15px;">
       
        
        <div class="box box-primary">
          <div class="box-body table-responsive">
            <table class="table table-bordered" id="data_perbidang">
              <thead>
                 <tr>
                <th>
                    DAERAH
                </th>
                <th>
                  MELAPOR
                </th>
                <th>
                  PAGU
                </th>
                <th>
                  RENCANA VOLUM FISIK
                </th>
                <th>
                  REALISASI KEUANGAN
                </th>
                <th>
                  REALISASI PERSENTASE
                </th>
                <th>
                  REALISASI FISIK
                </th>
                <th>
                  REALISASI PERSENTASE
                </th>
              </tr>
              </thead>
              <tbody>
                @foreach($data as $d)
                <tr class="{{strlen($d->kode_daerah)==2?'bg bg-primary':''}}">
                  <td>{{$d->nama_daerah}}</td>
                  <td>{{$d->melakukan_pelaporan}}</td>
                  <td>{{ number_format($d->pagu,3,'.',',') }}</td>
                  <td>{{ number_format($d->perencanaan_kegiatan_volume,3,'.',',') }}</td>
                  <td>{{number_format($d->realisasi_keuangan,3,'.',',')}}</td>
                  <td>
                    @if(($d->pagu!=0)and($d->realisasi_keuangan!=0))

                      {{number_format((($d->realisasi_keuangan*100)/$d->pagu),2,',','.' ) }} %

                    @else
                      0 %
                    @endif


                  </td>
                  <td>{{$d->realisasi_fisik_volume}}</td>
                  <td>
                       @if(($d->perencanaan_kegiatan_volume!=0)and($d->realisasi_fisik_volume!=0))

                      {{number_format((($d->realisasi_fisik_volume*100)/$d->perencanaan_kegiatan_volume),2,'.',',' ) }} %

                    @else
                      0 %
                    @endif

                  </td>
                </tr>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

@stop

@section('js')
<script type="text/javascript">
  function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

</script>

@stop