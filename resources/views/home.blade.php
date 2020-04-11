@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')
       <div class="col-md-4 col-md-offset-4 text-center animated bounceInUp" style="margin-top: 20px;">
    	<img src="{{url('logo.png')}}" class="" style="max-width: 40%">
    	<h2><b>BANGDA KEMENDAGRI</b></h2>
    	<h2><b>BINWASDAK {{date('Y')}}</b></h2>
    	<hr>
    </div>


    <style media="screen">
      div.content-wrapper{
        background-color: #D9AFD9;
        background-image: linear-gradient(0deg, #D9AFD9 0%, #97D9E1 100%)!important;
      }
      
    </style>
@stop
