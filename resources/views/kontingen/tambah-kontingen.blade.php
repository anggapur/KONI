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
						<input id="nkta" class="form-control" type="text" name="nkta" required minlength="0" maxlength="10" onkeyup="return validation()">
					<label>Jenis Kelamin</label><br>					
						<input value="L" type="radio" name="jenis_kelamin" required> Laki-Laki <br>
						<input value="P" type="radio" name="jenis_kelamin" required> Perempuan <br>				
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
					<input id="submit" class="btn btn-primary" type="submit" name="submit" value="Simpan">					
					<input class="btn btn-warning" type="reset" name="reset" value="Reset">
		    	</form>
		    </div>
		</div>
    </section>

    <script type="text/javascript">
    	function validation(){

    		var status = 0;
    		var nkta = $('#nkta').val();    		
    		if(nkta.length == 10){        		
	    		$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
					}
				});
				dataString = "no="+nkta;
				$.ajax({
			   		type: "POST",
			   		url: "{{URL('/cek-no-kartu-anggota')}}",
			   		data: dataString,
			   		cache: false,
			   		success: function(html){		   			
			   			if(html == 'false'){
				   			alert("No Kartu Tanda Anggota sudah digunakan, silahkan cek kembali No Kartu Tanda Anggota yang anda inputkan");
				   			$('#nkta').focus();
				   		}				   		
			   		} 
				});
			}		
    	}
    </script>
@endsection