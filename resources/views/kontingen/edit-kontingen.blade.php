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

		    		<div class="form-group">
		                <label>Nama</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-user"></i>
		                  </div>
		                  <input class="form-control" type="text" name="nama" value="{{$nama_kontingen}}" required>
		                </div>		                
		             </div>

		             <div  id="nkta_error" class="form-group">
		                <label>No Kartu Tanda Anggota</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-book"></i>
		                  </div>
		                  <input id="nkta" class="form-control" type="text" name="nkta" value="{{$no_kartu_tanda_anggota}}" maxlength="10" minlength="0" required onkeyup="if($('#nkta').val() != {{$no_kartu_tanda_anggota}}) return validation(); else return normal();">
		                </div>
		                <span id="error" class="help-block" style="display: none;">No Kartu Tanda Anggota sudah terdaftar</span>
		             </div>

		            <div class="form-group">
						<label>Jenis Kelamin</label><br>					
							<input class="" type="radio" name="jenis_kelamin" value="L" @if($jenis_kelamin == 'L') {{ "checked" }} @endif required> Laki-Laki <br>
							<input class="" type="radio" name="jenis_kelamin" value="P" @if($jenis_kelamin == 'P') {{ "checked" }} @endif required> Perempuan<br>
					</div>

					<div class="form-group">
		                <label>Tempat Lahir</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-home"></i>
		                  </div>
		                  <input class="form-control" type="text" name="tempat_lahir" value="{{$tempat_lahir}}" required><br>
		                </div>		                
		             </div>
						
					<div class="form-group">
		                <label>Tanggal Lahir</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-calendar"></i>
		                  </div>
		                  <input id="datepicker" class="form-control" type="text" name="tgl_lahir" value="{{$tgl_lahir}}" required><br>
		                </div>		                
		             </div>

		             <div class="form-group">
		                <label>Alamat</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-home"></i>
		                  </div>
		                  <textarea class="form-control" name="alamat"required>{{$alamat}}</textarea><br>
		                </div>		                
		             </div>

		             <div class="form-group">
		                <label>Cabang Olahraga</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-code-branch"></i>
		                  </div>
		                  <select class="form-control select2" type="text" name="cabor_id" required>
							<option value="" selected disabled hidden>Pilih cabor</option>
							@foreach($cabor as $data)
								<option value="{{$data->id_cabor}}"
									@if($data->id_cabor == $cabor_id) {{ "selected" }} @endif
									>{{$data->nama_cabor}}</option>
							@endforeach
						</select><br>
		                </div>		                
		             </div>

		             <div class="form-group">
		                <label>Jabatan</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-user-tie"></i>
		                  </div>
		                  <select class="form-control select2" type="text" name="jabatan" required>
							<option value="" selected disabled hidden>Pilih jabatan</option>
							@foreach($jabatan as $jabatan)
								<option value="{{$jabatan->id_jabatan}}"
									@if($jabatan->id_jabatan == $id_jabatan) {{"selected"}}	@endif
									>{{$jabatan->nama_jabatan}}</option>
							@endforeach
						</select><br>
		                </div>		                
		             </div>				
					<input id="submit" class="btn btn-success" type="submit" name="submit" value="Simpan">
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
				   			$('#nkta').focus();
				   			$('#nkta_error').addClass(' has-error');
				   			$('#error').show();
				   			$('#submit').prop('disabled',true);
				   		}else{
				   			$('#nkta_error').removeClass(' has-error');
				   			$('#error').hide();
				   			$('#submit').prop('disabled',false);
				   		}
			   		} 
				});
			}		
    	}

    	function normal(){
    		$('#nkta_error').removeClass(' has-error');
   			$('#error').hide();
   			$('#submit').prop('disabled',false);
    	}
    </script>
@endsection