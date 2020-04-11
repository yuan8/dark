@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1>PILIH TAHUN</h1> -->
@stop

@section('content')
  <div class="col-md-4 col-md-offset-4 mt-4" style="margin-top:20px">
    <div class="box-primary box">
      <form class="" action="{{route('f.pilih_tahun.store')}}" method="post">
        {{ csrf_field() }}
        <div class="box-body">
          <label for="">PILIH TAHUN</label>
          <select class="form-control" name="tahun" required>
            <option value="2019">2019</option>
          </select>
        </div>
        <div class="box-footer">
          <button type="submit" name="button" class="btn btn-primary btn-sm col-md-12">LIHAT LAPORAN</button>
        </div>
      </form>

    </div>

  </div>
@stop
