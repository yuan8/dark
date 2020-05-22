@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
@stop
@section('content')
<style type="text/css">
th,
td {
    font-size: 9px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box-primary box">
            <div class="box-body" id="timeline"></div>
        </div>
    </div>
    <h3 class="text-center">{{$daerah->nama}} TW {{$tw}}</h3>
    <div class="col-md-12 table-responsive">
        <div class="box-primary box">
            <div class="box-body table-responsive">
                <table class="table table-bordered" id="TABLE_REKAP">
                    <thead>
                        <tr>
                            <th rowspan="3">PAGU FISIK</th>
                            <th rowspan="3">REL KEUANGAN FISIK</th>
                            <th rowspan="3">PERSENTASE REL KEUANGAN FISIK</th>
                            <th rowspan="3">PERENCANAAN  VOLUME FISIK</th>
                            <th rowspan="3">REL VOLUME FISIK</th>
                            <th rowspan="3">PERSENTASE  REL VOLUME FISIK</th>
                            <th colspan="24" class="text-center">PERKATEGORI</th>
                        </tr>
                        <tr>
                        	<th colspan="6">REGULER</th>
                        	<th colspan="6">PENUGASAN</th>
                        	<th colspan="6">AFFIRMASI</th>
                        	<th colspan="6">NON FISIK</th>
                        </tr>
                        <tr>
                            <th>PAGU (REGULER)</th>
                            <th>REL KEUANGAN (REGULER)</th>
                            <th>PERSENTASE REL KEUNAGAN (REGULER)</th>
                            <th>PERENCANAAN VOLUME (REGULER)</th>
                            <th>REL VOLUME (REGULER) </th>
                            <th>PERSENTASE REL VOLUME (REGULER)</th>

                             <th>PAGU (PENUGASAN)</th>
                            <th>REL KEUANGAN (PENUGASAN)</th>
                            <th>PERSENTASE REL KEUNAGAN (PENUGASAN)</th>
                            <th>PERENCANAAN VOLUME (PENUGASAN)</th>
                            <th>REL VOLUME (REGULER) </th>
                            <th>PERSENTASE REL VOLUME (PENUGASAN)</th>

                           <th>PAGU (AFFIRMASI)</th>
                            <th>REL KEUANGAN (AFFIRMASI)</th>
                            <th>PERSENTASE REL KEUNAGAN (AFFIRMASI)</th>
                            <th>PERENCANAAN VOLUME (AFFIRMASI)</th>
                            <th>REL VOLUME (REGULER) </th>
                            <th>PERSENTASE REL VOLUME (AFFIRMASI)</th>


                           <th>PAGU (NON FISIK)</th>
                            <th>REL KEUANGAN (NON FISIK)</th>
                            <th>PERSENTASE REL KEUNAGAN (NON FISIK)</th>
                            <th>PERENCANAAN VOLUME (NON FISIK)</th>
                            <th>REL VOLUME (NON FISIK) </th>
                            <th>PERSENTASE REL VOLUME (NON FISIK)</th>




                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{number_format($detail['REKAP']['pagu'],0,'.',' ')}}</td>
                            <td>{{number_format($detail['REKAP']['keuangan'],0,'.',' ')}}</td>
                              <td>
                            	@if(($detail['REKAP']['pagu']==0)OR($detail['REKAP']['keuangan']==0))
                            		0%
                            	@else
                            	{{(($detail['REKAP']['keuangan']/$detail['REKAP']['pagu'])*100).'%'}}

                            	@endif

                            </td>
                            <td>{{number_format($detail['REKAP']['perencanaan_volume'],0,'.',' ')}}</td>
                            <td>{{number_format($detail['REKAP']['volume_fisik'],0,'.',' ')}}</td>
                            <td>
                            	@if(($detail['REKAP']['perencanaan_volume']==0)OR($detail['REKAP']['volume_fisik']==0))
                            		0%
                            	@else
                            	{{(($detail['REKAP']['perencanaan_volume']/$detail['REKAP']['volume_fisik'])*100).'%'}}

                            	@endif

                            </td>


                           <td>{{number_format($detail['REGULER']['pagu'],0,'.',' ')}}</td>
                            <td>{{number_format($detail['REGULER']['keuangan'],0,'.',' ')}}</td>
                              <td>
                            	@if(($detail['REGULER']['pagu']==0)OR($detail['REGULER']['keuangan']==0))
                            		0%
                            	@else
                            	{{(($detail['REGULER']['keuangan']/$detail['REGULER']['pagu'])*100).'%'}}

                            	@endif

                            </td>
                            <td>{{number_format($detail['REGULER']['perencanaan_volume'],0,'.',' ')}}</td>
                            <td>{{number_format($detail['REGULER']['volume_fisik'],0,'.',' ')}}</td>
                            <td>
                            	@if(($detail['REGULER']['perencanaan_volume']==0)OR($detail['REGULER']['volume_fisik']==0))
                            		0%
                            	@else
                            	{{(($detail['REGULER']['perencanaan_volume']/$detail['REGULER']['volume_fisik'])*100).'%'}}

                            	@endif

                            </td>

                             <td>{{number_format($detail['PENUGASAN']['pagu'],0,'.',' ')}}</td>
                            <td>{{number_format($detail['PENUGASAN']['keuangan'],0,'.',' ')}}</td>
                              <td>
                            	@if(($detail['PENUGASAN']['pagu']==0)OR($detail['PENUGASAN']['keuangan']==0))
                            		0%
                            	@else
                            	{{(($detail['PENUGASAN']['keuangan']/$detail['PENUGASAN']['pagu'])*100).'%'}}

                            	@endif

                            </td>
                            <td>{{number_format($detail['PENUGASAN']['perencanaan_volume'],0,'.',' ')}}</td>
                            <td>{{number_format($detail['PENUGASAN']['volume_fisik'],0,'.',' ')}}</td>
                            <td>
                            	@if(($detail['PENUGASAN']['perencanaan_volume']==0)OR($detail['PENUGASAN']['volume_fisik']==0))
                            		0%
                            	@else
                            	{{(($detail['PENUGASAN']['perencanaan_volume']/$detail['PENUGASAN']['volume_fisik'])*100).'%'}}

                            	@endif

                            </td>

                             <td>{{number_format($detail['AFFIRMASI']['pagu'],0,'.',' ')}}</td>
                            <td>{{number_format($detail['AFFIRMASI']['keuangan'],0,'.',' ')}}</td>
                              <td>
                            	@if(($detail['AFFIRMASI']['pagu']==0)OR($detail['AFFIRMASI']['keuangan']==0))
                            		0%
                            	@else
                            	{{(($detail['AFFIRMASI']['keuangan']/$detail['AFFIRMASI']['pagu'])*100).'%'}}

                            	@endif

                            </td>
                            <td>{{number_format($detail['AFFIRMASI']['perencanaan_volume'],0,'.',' ')}}</td>
                            <td>{{number_format($detail['AFFIRMASI']['volume_fisik'],0,'.',' ')}}</td>
                            <td>
                            	@if(($detail['AFFIRMASI']['perencanaan_volume']==0)OR($detail['AFFIRMASI']['volume_fisik']==0))
                            		0%
                            	@else
                            	{{(($detail['AFFIRMASI']['perencanaan_volume']/$detail['AFFIRMASI']['volume_fisik'])*100).'%'}}

                            	@endif

                            </td>

                             <td>{{number_format($detail['NON_FISIK']['pagu'],0,'.',' ')}}</td>
                            <td>{{number_format($detail['NON_FISIK']['keuangan'],0,'.',' ')}}</td>
                              <td>
                            	@if(($detail['NON_FISIK']['pagu']==0)OR($detail['NON_FISIK']['keuangan']==0))
                            		0%
                            	@else
                            	{{(($detail['NON_FISIK']['keuangan']/$detail['NON_FISIK']['pagu'])*100).'%'}}

                            	@endif

                            </td>
                            <td>{{number_format($detail['NON_FISIK']['perencanaan_volume'],0,'.',' ')}}</td>
                            <td>{{number_format($detail['NON_FISIK']['volume_fisik'],0,'.',' ')}}</td>
                            <td>
                            	@if(($detail['NON_FISIK']['perencanaan_volume']==0)OR($detail['NON_FISIK']['volume_fisik']==0))
                            		0%
                            	@else
                            	{{(($detail['NON_FISIK']['perencanaan_volume']/$detail['NON_FISIK']['volume_fisik'])*100).'%'}}

                            	@endif

                            </td>

                          
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center" style="margin-bottom: 15px;">
        <div class="btn-group">
            @if(($tw-1)>0)
            <a href="{{route('pel.detail.data',['id'=>$daerah->id,'tw'=>($tw-1)])}}" class="btn btn-primary btn-sm">TW {{$tw-1}}</a>
            @else
            <a href="{{route('pel.detail.data',['id'=>$daerah->id,'tw'=>(1)])}}" disabled class="btn btn-primary btn-sm">TW 1</a>
            @endif
            @if(($tw+1)<5) <a href="{{route('pel.detail.data',['id'=>$daerah->id,'tw'=>($tw+1)])}}" class="btn btn-primary btn-sm">TW {{$tw+1}}</a>
                @else
                <a href="{{route('pel.detail.data',['id'=>$daerah->id,'tw'=>(4)])}}" disabled class="btn btn-primary btn-sm">TW 4</a>
                @endif
                @if(count($data['REGULER'])>0)
                <a href="{{url('storage/files/'.HP::front_tahun().'/'.$data['REGULER'][0]->url)}}" class="btn btn-success btn-sm" download="">Download File TW {{$tw}}</a>
                @else
                <a href="" class="btn btn-success btn-sm" disabled>Tidak Melakukan Pelaporan</a>
                @endif
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li role="presentation" class="active"><a href="#REGULER" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><b>REGULER</b></a></li>
                    <li role="presentation" class=""><a href="#PENUGASAN" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>PENUGASAN</b></a></li>
                    <li role="presentation"> <a href="#AFFIRMASI" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>AFFIRMASI </b></a>
                    <li role="presentation"> <a href="#NON_FISIK" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>NON FISIK</b> </a>
                    </li>
                    <li role="presentation"> <a href="#PERBIDANG" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>PERBIDANG</b> </a>
                    </li>
                </ul>
            </div>
            <div class="box-body table-responsive" style="max-height:700px; overflow:scroll;">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" role="tabpanel" id="REGULER" aria-labelledby="home-tab">
                        @include('front.pelaporan.partial.table_pelaporan',['datax'=>$data['REGULER']])
                    </div>
                    <div class="tab-pane fade " role="tabpanel" id="PENUGASAN" aria-labelledby="home-tab">
                        @include('front.pelaporan.partial.table_pelaporan',['datax'=>$data['PENUGASAN']])
                    </div>
                    <div class="tab-pane fade " role="tabpanel" id="AFFIRMASI" aria-labelledby="home-tab">
                        @include('front.pelaporan.partial.table_pelaporan',['datax'=>$data['AFFIRMASI']])
                    </div>
                    <div class="tab-pane fade " role="tabpanel" id="NON_FISIK" aria-labelledby="home-tab">
                        @include('front.pelaporan.partial.table_pelaporan',['datax'=>$data['NON_FISIK']])
                    </div>
                    <div class="tab-pane fade active " role="tabpanel" id="PERBIDANG" aria-labelledby="home-tab">
                        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                            <ul class="nav nav-tabs" id="p_b_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#PREGULER" id="PTR" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><b>REGULER</b></a></li>
                                <li role="presentation" class=""><a href="#PPENUGASAN" role="tab" id="PTP" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>PENUGASAN</b></a></li>
                                <li role="presentation"> <a href="#PAFFIRMASI" role="tab" id="PTA" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>AFFIRMASI </b></a>
                                <li role="presentation"> <a href="#PNON_FISIK" role="tab" id="PTN" data-toggle="tab" aria-controls="profile" aria-expanded="false"><b>NON FISIK</b> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="ptab-k">
                            <div class="tab-pane fade active in" role="tabpanel" id="PREGULER" aria-labelledby="PTR">
                             <table class="table-bordered table" id="TABLE_PREGULER">
                                    <thead>
                                        <tr>
                                            <th>BIDANG</th>
                                            <th>SUB BIDANG</th>
                                            <th>PAGU</th>
                                            <th>REL KEUANGAN</th>
                                            <th>PERSENTASE REL KEUANGAN</th>
                                            <th>PERENCANAAN VOLUME</th>
                                            <th>REL VOLUME </th>
                                            <th>PERSENTASE REL VOLUME </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perbidang['REGULER'] as $t)
                                        <tr class="bg bg-info">
                                            <td colspan="">{{$t['nama']}}</td>
                                            <td></td>
                                            <td>{{number_format($t['pagu'],3,'.',' ')}}</td>
                                            <td>{{number_format($t['keuangan'],3,'.',' ')}}</td>
                                            <td>
                                            	@if(($t['pagu']==0)OR($t['keuangan']==0))
                                            		0%
                                            	@else
                                            		{{ (($t['keuangan']/$t['pagu'])*100).'%'}}
                                            	@endif

                                            </td>
                                            <td>
                                           	 {{number_format($t['perencanaan_volume'],3,'.',' ')}}
                                            </td>

                                            <td>{{number_format($t['volume_fisik'],3,'.',' ')}}</td>
                                            <td>

                                            @if(($t['volume_fisik']==0)OR($t['perencanaan_volume']==0))
                                            		0%
                                            	@else
                                            		{{ (($t['volume_fisik']/$t['perencanaan_volume'])*100).'%'}}
                                            	@endif

                                            </td>
                                        </tr>
                                        @foreach($t['sub_bidang'] as $s)
                                        <tr>
											<td></td>

                                           <td colspan="">{{$s['nama']}}</td>
											<td>{{number_format($s['pagu'],3,'.',' ')}}</td>
											<td>{{number_format($s['keuangan'],3,'.',' ')}}</td>
											<td>
												@if(($s['pagu']==0)OR($s['keuangan']==0))
													0%
												@else
													{{ (($s['keuangan']/$s['pagu'])*100).'%'}}
												@endif

											</td>
											<td>
												 {{number_format($s['perencanaan_volume'],3,'.',' ')}}
											</td>

											<td>{{number_format($s['volume_fisik'],3,'.',' ')}}</td>
											<td>

											@if(($s['volume_fisik']==0)OR($s['perencanaan_volume']==0))
													0%
												@else
													{{ (($s['volume_fisik']/$s['perencanaan_volume'])*100).'%'}}
												@endif

											</td>

                                        </tr>
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                               
                            </div>
                            <div class="tab-pane fade " role="tabpanel" id="PPENUGASAN" aria-labelledby="PTP">
                                <table class="table-bordered table" id="TABLE_PENUGASAN">
                                    <thead>
                                        <tr>
                                             <th>BIDANG</th>
                                            <th>SUB BIDANG</th>
                                            <th>PAGU</th>
                                            <th>REL KEUANGAN</th>
                                            <th>PERSENTASE REL KEUANGAN</th>
                                            <th>PERENCANAAN VOLUME</th>
                                            <th>REL VOLUME </th>
                                            <th>PERSENTASE REL VOLUME </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perbidang['PENUGASAN'] as $t)
                                        <tr class="bg bg-info">
                                           <td colspan="">{{$t['nama']}}</td>
											    <td></td>
											    <td>{{number_format($t['pagu'],3,'.',' ')}}</td>
											    <td>{{number_format($t['keuangan'],3,'.',' ')}}</td>
											    <td>
											        @if(($t['pagu']==0)OR($t['keuangan']==0))
											            0%
											        @else
											            {{ (($t['keuangan']/$t['pagu'])*100).'%'}}
											        @endif

											    </td>
											    <td>
											     {{number_format($t['perencanaan_volume'],3,'.',' ')}}
											    </td>

											    <td>{{number_format($t['volume_fisik'],3,'.',' ')}}</td>
											    <td>

											    @if(($t['volume_fisik']==0)OR($t['perencanaan_volume']==0))
											            0%
											        @else
											            {{ (($t['volume_fisik']/$t['perencanaan_volume'])*100).'%'}}
											        @endif

											    </td>
                                        </tr>
                                        @foreach($t['sub_bidang'] as $s)
                                        <tr>
                                           <td></td>
													<td colspan="">{{$s['nama']}}</td>

													<td>{{number_format($s['pagu'],3,'.',' ')}}</td>
													<td>{{number_format($s['keuangan'],3,'.',' ')}}</td>
													<td>
														@if(($s['pagu']==0)OR($s['keuangan']==0))
															0%
														@else
															{{ (($s['keuangan']/$s['pagu'])*100).'%'}}
														@endif

													</td>
													<td>
														 {{number_format($s['perencanaan_volume'],3,'.',' ')}}
													</td>

													<td>{{number_format($s['volume_fisik'],3,'.',' ')}}</td>
													<td>

													@if(($s['volume_fisik']==0)OR($s['perencanaan_volume']==0))
															0%
														@else
															{{ (($s['volume_fisik']/$s['perencanaan_volume'])*100).'%'}}
														@endif

													</td>

                                        </tr>
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade " role="tabpanel" id="PAFFIRMASI" aria-labelledby="PTA">
                                <table class="table-bordered table" id="TABLE_AFFIRMASI">
                                     <thead>
                                        <tr>
                                             <th>BIDANG</th>
                                            <th>SUB BIDANG</th>
                                            <th>PAGU</th>
                                            <th>REL KEUANGAN</th>
                                            <th>PERSENTASE REL KEUANGAN</th>
                                            <th>PERENCANAAN VOLUME</th>
                                            <th>REL VOLUME </th>
                                            <th>PERSENTASE REL VOLUME </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perbidang['AFFIRMASI'] as $t)
                                        <tr class="bg bg-info">
                                           <td colspan="">{{$t['nama']}}</td>
											    <td></td>
											    <td>{{number_format($t['pagu'],3,'.',' ')}}</td>
											    <td>{{number_format($t['keuangan'],3,'.',' ')}}</td>
											    <td>
											        @if(($t['pagu']==0)OR($t['keuangan']==0))
											            0%
											        @else
											            {{ (($t['keuangan']/$t['pagu'])*100).'%'}}
											        @endif

											    </td>
											    <td>
											     {{number_format($t['perencanaan_volume'],3,'.',' ')}}
											    </td>

											    <td>{{number_format($t['volume_fisik'],3,'.',' ')}}</td>
											    <td>

											    @if(($t['volume_fisik']==0)OR($t['perencanaan_volume']==0))
											            0%
											        @else
											            {{ (($t['volume_fisik']/$t['perencanaan_volume'])*100).'%'}}
											        @endif

											    </td>
                                        </tr>
                                        @foreach($t['sub_bidang'] as $s)
                                        <tr>
                                           <td></td>
													<td colspan="">{{$s['nama']}}</td>

													<td>{{number_format($s['pagu'],3,'.',' ')}}</td>
													<td>{{number_format($s['keuangan'],3,'.',' ')}}</td>
													<td>
														@if(($s['pagu']==0)OR($s['keuangan']==0))
															0%
														@else
															{{ (($s['keuangan']/$s['pagu'])*100).'%'}}
														@endif

													</td>
													<td>
														 {{number_format($s['perencanaan_volume'],3,'.',' ')}}
													</td>

													<td>{{number_format($s['volume_fisik'],3,'.',' ')}}</td>
													<td>

													@if(($s['volume_fisik']==0)OR($s['perencanaan_volume']==0))
															0%
														@else
															{{ (($s['volume_fisik']/$s['perencanaan_volume'])*100).'%'}}
														@endif

													</td>

                                        </tr>
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade " role="tabpanel" id="PNON_FISIK" aria-labelledby="PTN">
                                <table class="table-bordered table" id="TABLE_NON_FISIK">
                                   <thead>
                                        <tr>
                                             <th>BIDANG</th>
                                            <th>SUB BIDANG</th>
                                            <th>PAGU</th>
                                            <th>REL KEUANGAN</th>
                                            <th>PERSENTASE REL KEUANGAN</th>
                                            <th>PERENCANAAN VOLUME</th>
                                            <th>REL VOLUME </th>
                                            <th>PERSENTASE REL VOLUME </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perbidang['NON_FISIK'] as $t)
                                          <tr class="bg bg-info">
                                           <td colspan="">{{$t['nama']}}</td>
											    <td></td>
											    <td>{{number_format($t['pagu'],3,'.',' ')}}</td>
											    <td>{{number_format($t['keuangan'],3,'.',' ')}}</td>
											    <td>
											        @if(($t['pagu']==0)OR($t['keuangan']==0))
											            0%
											        @else
											            {{ (($t['keuangan']/$t['pagu'])*100).'%'}}
											        @endif

											    </td>
											    <td>
											     {{number_format($t['perencanaan_volume'],3,'.',' ')}}
											    </td>

											    <td>{{number_format($t['volume_fisik'],3,'.',' ')}}</td>
											    <td>

											    @if(($t['volume_fisik']==0)OR($t['perencanaan_volume']==0))
											            0%
											        @else
											            {{ (($t['volume_fisik']/$t['perencanaan_volume'])*100).'%'}}
											        @endif

											    </td>
                                        </tr>
                                        @foreach($t['sub_bidang'] as $s)
                                        <tr>
                                           <td></td>
													<td colspan="">{{$s['nama']}}</td>

													<td>{{number_format($s['pagu'],3,'.',' ')}}</td>
													<td>{{number_format($s['keuangan'],3,'.',' ')}}</td>
													<td>
														@if(($s['pagu']==0)OR($s['keuangan']==0))
															0%
														@else
															{{ (($s['keuangan']/$s['pagu'])*100).'%'}}
														@endif

													</td>
													<td>
														 {{number_format($s['perencanaan_volume'],3,'.',' ')}}
													</td>

													<td>{{number_format($s['volume_fisik'],3,'.',' ')}}</td>
													<td>

													@if(($s['volume_fisik']==0)OR($s['perencanaan_volume']==0))
															0%
														@else
															{{ (($s['volume_fisik']/$s['perencanaan_volume'])*100).'%'}}
														@endif

													</td>

                                        </tr>
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script type="text/javascript">
Highcharts.chart('timeline', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'TIMELINE DAK {{$daerah->nama}} TAHUN {{HP::front_tahun()}}'
    },
    subtitle: {
        // text: 'Source: Wikipedia.org'
    },
    xAxis: {
        categories: ['TW I', 'TW II', 'TW III', 'TW IV'],
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'RP./UNIT'
        },
        labels: {
            formatter: function() {
                return this.value;
            }
        }
    },
    tooltip: {
        split: false,
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
                    click: function() {
                        window.location.href = '{{route('pel.detail.data',['id '=>$daerah->id]) }}/' + ((this.index) + 1);
                    }
                }
            }
          
        },

    },
    series: [{
            name: 'PAGU',
            data: [
                {{ $timeline[1]->pagu ? $timeline[1]->pagu : 0 }},
                {{ $timeline[2]->pagu ? $timeline[2]->pagu : 0 }},
                {{ $timeline[3]->pagu ? $timeline[3]->pagu : 0 }},
                {{ $timeline[4]->pagu ? $timeline[4]->pagu : 0 }},

            ]

        },
        {
            name: 'REALISASI KEUANGAN',
            data: [
                {{ $timeline[1]->realisasi_keuangan ? $timeline[1]->realisasi_keuangan : 0 }},
                {{ $timeline[2]->realisasi_keuangan ? $timeline[2]->realisasi_keuangan : 0 }},
                {{ $timeline[3]->realisasi_keuangan ? $timeline[3]->realisasi_keuangan : 0 }},
                {{ $timeline[4]->realisasi_keuangan ? $timeline[4]->realisasi_keuangan : 0 }},

            ]

        },
        {
            name: 'PERENCANAAN VOLUME FISIK',
            data: [
                {{ $timeline[1]->perencanaan_kegiatan_volume ? $timeline[1]->perencanaan_kegiatan_volume : 0 }},
                {{ $timeline[2]->perencanaan_kegiatan_volume ? $timeline[2]->perencanaan_kegiatan_volume : 0 }},
                {{ $timeline[3]->perencanaan_kegiatan_volume ? $timeline[3]->perencanaan_kegiatan_volume : 0 }},
                {{ $timeline[4]->perencanaan_kegiatan_volume ? $timeline[4]->perencanaan_kegiatan_volume : 0 }},


            ]

        },
        {
            name: 'REALISASI VOLUME FISIK',
            data: [
                {{ $timeline[1]->realisasi_fisik_volume ? $timeline[1]->realisasi_fisik_volume : 0 }},
                {{ $timeline[2]->realisasi_fisik_volume ? $timeline[2]->realisasi_fisik_volume : 0 }},
                {{ $timeline[3]->realisasi_fisik_volume ? $timeline[3]->realisasi_fisik_volume : 0 }},
                {{ $timeline[4]->realisasi_fisik_volume ? $timeline[4]->realisasi_fisik_volume : 0 }},
            ]

        }
    ]
});


$(function() {
  	var REGULER = $('#TABLE_PREGULER').DataTable({
  		sort:false,
  		 dom: 'Bfrtip',
     	 buttons: [
            {
                extend: 'excelHtml5',
                text: 'DOWNLOAD EXCEL',
                className:'btn btn-success btn-xs',
                messageTop: 'REKAP PERBIDANG REGULER  {{$daerah->nama}} TW {{$tw}}',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7 ]
                }
            },
        ],
  	}); 

  	var PENUGASAN = $('#TABLE_PENUGASAN').DataTable({
  		sort:false,
  		 dom: 'Bfrtip',
     	 buttons: [
            {
                extend: 'excelHtml5',
                text: 'DOWNLOAD EXCEL',
                className:'btn btn-success btn-xs',
                messageTop: 'REKAP PERBIDANG PENUGASAN {{$daerah->nama}} TW {{$tw}}',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7 ]
                }
            },
        ],
  	}); 

  	var AFFIRMASI = $('#TABLE_AFFIRMASI').DataTable({
  		sort:false,
  		 dom: 'Bfrtip',
     	 buttons: [
            {
                extend: 'excelHtml5',
                text: 'DOWNLOAD EXCEL',
                className:'btn btn-success btn-xs',
                messageTop: 'REKAP PERBIDANG AFFIRMASI  {{$daerah->nama}} TW {{$tw}}',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7 ]
                }
            },
        ],
  	}); 

  	var NON_FISIK = $('#TABLE_NON_FISIK').DataTable({
  		sort:false,
  		 dom: 'Bfrtip',
     	 buttons: [
            {
                extend: 'excelHtml5',
                text: 'DOWNLOAD EXCEL',
                className:'btn btn-success btn-xs',
                messageTop: 'REKAP PERBIDANG  NON FISIK {{$daerah->nama}} TW {{$tw}}',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7 ]
                }
            },
        ],
  	}); 
});


	var REKAP = $('#TABLE_REKAP').DataTable({
  		sort:false,
  		 dom: 'Bfrtip',
     	 buttons: [
            {
                extend: 'excelHtml5',
                text: 'DOWNLOAD EXCEL',
                className:'btn btn-success btn-xs',
                messageTop: 'REKAP  {{$daerah->nama}} TW {{$tw}}',
                
            },
        ],
  	}); 


</script>
@stop