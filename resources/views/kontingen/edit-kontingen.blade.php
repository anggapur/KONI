@extends('layouts.app')	
@section('content')
<!-- Main content -->
    <section class="content">
    	<div class="box box-primary">
		    <div class="box-header with-border">
		    	<div></div>
		    	<h3 class="box-title">Tambah Data Kontingen</h3>
		    	<form method="post" action="{{URL('update-kontingen')}}">
		    		<input type="hidden" name="id" value="{{ $id_kontingen }}">
		    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    		<label>Nama</label>
						<input class="form-control" type="text" name="nama" value="{{$nama_kontingen}}" required>
					<label>No Kartu Tanda Anggota</label>
						<input class="form-control" type="text" name="nkta" value="{{$no_kartu_tanda_anggota}}" required>
					<label>Jenis Kelamin</label><br>
						<input class="" type="radio" name="jenis_kelamin" value="L" @if($jenis_kelamin == 'L') {{ "checked" }} @endif required> Laki-Laki <br>
						<input class="" type="radio" name="jenis_kelamin" value="P" @if($jenis_kelamin == 'P') {{ "checked" }} @endif required> Perempuan					<br>
					<label>Tempat Lahir</label>
						<input class="form-control" type="text" name="tempat_lahir" value="{{$tempat_lahir}}" required><br>
					<label>Tanggal Lahir</label>
						<input class="form-control" type="date" name="tgl_lahir" value="{{$tgl_lahir}}" required><br>
					<label>Alamat</label>
						<textarea class="form-control" name="alamat"required>{{$alamat}}</textarea><br>
					<label>Cabang Olahraga</label>
						<select class="form-control" type="text" name="cabor_id" required>
							<option value="" selected disabled hidden>Pilih cabor</option>
							@foreach($cabor as $data)
								<option value="{{$data->id_cabor}}"
									@if($data->id_cabor == $cabor_id) {{ "selected" }} @endif
									>{{$data->nama_cabor}}</option>
							@endforeach
						</select><br>
					<label>Jabatan</label>
						<select class="form-control" type="text" name="jabatan" required>
							<option value="" selected disabled hidden>Pilih jabatan</option>
							@foreach($jabatan as $jabatan)
								<option value="{{$jabatan->id_jabatan}}"
									@if($jabatan->id_jabatan == $id_jabatan) {{"selected"}}	@endif
									>{{$jabatan->nama_jabatan}}</option>
							@endforeach
						</select><br>
					<input class="btn btn-success" type="submit" name="submit" value="simpan">
		    	</form>
		    </div>
		</div>
    </section>
@endsection