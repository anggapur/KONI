@extends('layouts.app')	
@section('content')
<!-- Main content -->
    <section class="content">
    	<div class="box box-primary">
		    <div class="box-header with-border">
		    	<div></div>
		    	<h3 class="box-title">Tambah Data Kontingen</h3>
		    	<form method="post" action="{{URL('/add-kontingen')}}">
		    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    		<label>Nama</label>
						<input class="form-control" type="text" name="nama" required>
					<label>No Kartu Tanda Anggota</label>
						<input class="form-control" type="text" name="nkta" required minlength="0" maxlength="10">
					<label>Jenis Kelamin</label>
						<input value="L" type="radio" name="jenis_kelamin" required> Laki-Laki
						<input value="P" type="radio" name="jenis_kelamin" required> Perempuan
						<br>
					<label>Tempat Lahir</label>
						<input class="form-control" type="text" name="tempat_lahir" required><br>
					<label>Tanggal Lahir</label>
						<input class="form-control" type="date" name="tgl_lahir" required><br>
					<label>Alamat</label>
						<textarea class="form-control" name="alamat" required></textarea><br>
					<label>Jabatan</label>
						<select class="form-control" type="text" name="jabatan" required>
							<option value="" selected disabled hidden>Pilih jabatan</option>
							@foreach($data['jabatan'] as $data)
								<option value="{{$data->id_jabatan}}">{{$data->nama_jabatan}}</option>
							@endforeach
						</select><br>
					<input class="btn btn-primary" type="submit" name="submit" value="simpan">
		    	</form>
		    </div>
		</div>
    </section>
@endsection