@extends('layouts.app')	
@section('content')
<!-- Main content -->
    <section class="content">
    	<div class="box box-primary">
		    <div class="box-header with-border">
		    	<div></div>
		    	<h3 class="box-title">Tambah Data Kontingen</h3>
		    	<form method="post" action="{{URL('update-kontingen')}}">
		    		<input type="hidden" name="id" value="{{ $data->id_kontingen }}">
		    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    		<label>Nama</label>
						<input class="form-control" type="text" name="nama" value="{{$data->nama_kontingen}}" required>
					<label>No Kartu Tanda Anggota</label>
						<input class="form-control" type="text" name="nkta" value="{{$data->no_kartu_tanda_anggota}}" required>
					<label>Jenis Kelamin</label><br>
						<input class="" type="radio" name="jenis_kelamin" value="L" @if($data->jenis_kelamin == 'L') {{ "checked" }} @endif required> Laki-Laki <br>
						<input class="" type="radio" name="jenis_kelamin" value="P" @if($data->jenis_kelamin == 'P') {{ "checked" }} @endif required> Perempuan					<br>
					<label>Tempat Lahir</label>
						<input class="form-control" type="text" name="tempat_lahir" value="{{$data->tempat_lahir}}" required><br>
					<label>Tanggal Lahir</label>
						<input class="form-control" type="date" name="tgl_lahir" value="{{$data->tgl_lahir}}" required><br>
					<label>Alamat</label>
						<textarea class="form-control" name="alamat"required>{{$data->alamat}}</textarea><br>
					<label>Jabatan</label>
						<select class="form-control" type="text" name="jabatan" required>
							<option value="" selected disabled hidden>Pilih jabatan</option>
							@foreach($data['jabatan'] as $jabatan)
								<option value="{{$jabatan->id_jabatan}}"
									@if($jabatan->id_jabatan == $data->id_jabatan) {{"selected"}}	@endif
									>{{$jabatan->nama_jabatan}}</option>
							@endforeach
						</select><br>
					<input class="btn btn-success" type="submit" name="submit" value="simpan">
		    	</form>
		    </div>
		</div>
    </section>
@endsection