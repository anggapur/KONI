@extends('layouts.app')
@section('content')
<section class="content">
	<style type="text/css">
		#table-atlet td:first-child, thead{
			font-weight: bold;
		}
	</style>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Data Atlet</h3>
				</div>
				<div class="box-body">
                    <div class="tableWrapper">
                        <table class="table" id="table-atlet">
                        	<tbody>
                        		<tr>
                        			<td colspan="3" align="center">
                        				<img src="../public/upload/fotoAtlet/{{$atlet->nama_foto}}" style='max-width:300px;max-height:300px;margin-bottom:10px;'>
                        			</td>
                        		</tr>
                        		<tr>
                        			<td>Nama</td>
                        			<td> : </td>
                        			<td>{{$atlet->nama_atlet}}</td>
                        		</tr>
                        		<tr>
                        			<td>Cabang Olahraga</td>
                        			<td> : </td>
                        			<td>{{$atlet->nama_cabor}}</td>
                        		</tr>
                        		<tr>
                        			<td>No Kartu Tanda Anggota</td>
                        			<td> : </td>
                        			<td>{{$atlet->no_kartu_tanda_anggota}}</td>
                        		</tr>
                        		<tr>
                        			<td>Jenis Kelamin</td>
                        			<td> : </td>
                        			<td>@if($atlet->jenis_kelamin == 'L') {{"Laki - Laki"}} @else {{"Perempuan"}} @endif</td>
                        		</tr>
                        		<tr>
                        			<td>Tempat Lahir</td>
                        			<td> : </td>
                        			<td>{{$atlet->tempat_lahir}}</td>
                        		</tr>
                        		<tr>
                        			<td>Tanggal Lahir</td>
                        			<td> : </td>
                        			<td>{{$atlet->tgl_lahir}}</td>
                        		</tr>
                        		<tr>
                        			<td>Alamat</td>
                        			<td> : </td>
                        			<td>{{$atlet->alamat}}</td>
                        		</tr>
                        		<tr>
                        			<td>Tinggi</td>
                        			<td> : </td>
                        			<td>{{$atlet->tinggi}} Cm</td>
                        		</tr>
                        		<tr>
                        			<td>Berat</td>
                        			<td> : </td>
                        			<td>{{$atlet->berat}} Kg</td>
                        		</tr>
                        		<tr>
                        			<td>Tanggal jadi Atlet</td>
                        			<td> : </td>
                        			<td>{{$atlet->tgl_jadi_atlet}}</td>
                        		</tr>
                        		<tr>
                        			<td>Status</td>
                        			<td> : </td>
                        			<td>{{($atlet->status == 1) ? "Aktif" : "Tidak aktif" }}</td>
                        		</tr>
                        		@if($atlet->status == 0)
                        		<tr>
                        			<td>Tanggal Pensiun</td>
                        			<td> : </td>
                        			<td>{{$atlet->tgl_pensiun}}</td>
                        		</tr>
                        		@endif                        		
                        		<tr>
                        			<td>Nomor Pertandingan</td>
                        			<td> : </td>
                        			@foreach($np as $np)
                        			<td>{{$np->ket_np}}</td>
                        		</tr>
                        		<tr>
                        			<td></td>
                        			<td></td>
                        			@endforeach
                        		</tr>
                        		<tr>
                        			<td>Event yang pernah di ikuti</td>
                        			<td> : </td>
                                          @if(count($event) > 0)
                        			@foreach($event as $event)
                        			<td>{{$event->nama_event}}</td>
                        		</tr>
                        		<tr>
                        			<td></td>
                        			<td></td>
                        			@endforeach
                                          @else
                                          <td><b> - </b></td>
                                          @endif
                        		</tr>
                                    @if(count($prestasi) == 0)
                                    <tr>
                                          <td>Prestasi</td>
                                          <td> : </td>
                                          <td><b> - </b></td>
                                    </tr>
                                    @endif
                                    <tr>
                                          <td>Rekor</td>
                                          <td> : </td>
                                          <td><b> - </b></td>
                                    </tr>
                                    @if(count($rekor) == 0)
                                    @endif
                        	</tbody>
                        </table>
                        @if(count($prestasi) > 0)
                        <table class="table">
                        <thead>
                        	<tr>
                        		<td colspan="3" align="center">Prestasi</th>
                        	</tr>
                        	<tr>
                        		<td>Prestasi</td>
                        		<td>Nomor Pertandingan</td>
                        		<td>Event</td>
                        		<td>Waktu</td>
                        	</tr>
                        </thead>
                        	<tbody>
                        		@foreach($prestasi as $prestasi)
                        		<tr>
                        			<td>{{$prestasi->ket_juara}}</td>
                        			<td>{{$prestasi->ket_np}}</td>
                        			<td>{{$prestasi->nama_event}}</td>
                        			<td>{{$prestasi->waktu}}</td>
                        		</tr>
                        		@endforeach
                        	</tbody>                        	
                        </table>
                        @endif
                        @if(count($rekor) > 0)
                        <table class="table">
                        <thead>
                        	<tr>
                        		<td colspan="3" align="center">Rekor</th>
                        	</tr>
                        	<tr>
                        		<td>Rekor</td>
                        		<td>Nomor Pertandingan</td>
                        		<td>Event</td>
                        		<td>Waktu</td>
                        	</tr>
                        </thead>
                        	<tbody>
                        		@foreach($rekor as $rekor)
                        		<tr>
                        			<td>{{$rekor->keterangan_rekor}}</td>
                        			<td>{{$rekor->ket_np}}</td>
                        			<td>{{$rekor->nama_event}}</td>
                        			<td>{{$rekor->waktu}}</td>
                        		</tr>
                        		@endforeach
                        	</tbody>                        	
                        </table>
                        @endif
                    </div>
                </div>
			</div>
		</div>
	</div>
</section>
@endsection