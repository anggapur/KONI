@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
      
      <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Input Wasit</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{url('simpanWasit')}}">
            	{{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputNama">Nama Wasit</label>
                  <input type="text" class="form-control" id="exampleInputNama" placeholder="Input Nama" name="nama_wasit">
                </div>
                <div id="nkta_error" class="form-group">
                  <label for="exampleInputNoAnggota">No Kartu Anggota</label>
                  <input type="text" class="form-control" id="nkta" placeholder="No Kartu Anggota" name="no_kartu_anggota" required minlength="0" maxlength="10" onkeyup="return validation()">
                  <span id="error" class="help-block" style="display: none;">No Kartu Tanda Anggota sudah terdaftar</span>
                </div>
                <div class="form-group">
                  <label for="exampleInputjeniskelamin">Jenis Kelamin</label><br>
                  <input type="radio" name="jenis_kelamin" value="L"> Laki - Laki <br>
                  <input type="radio" name="jenis_kelamin" value="P"> Perempuan
                </div>
                <div class="form-group">
                	<br><label for="Inputtempatlahir">Tempat Lahir</label>
                	<input type="text" class="form-control id="Inputtempatlahir" placeholder="Tempat Lahir" name="tempat_lahir">
                </div class="form-group">
                <div class="form-group">
                	<label for="TanggalLahir"> Tanggal Lahir </label><br>
                	<input id="datepicker" type="text" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir">
                </div>
                <div class="form-group">
                	<label for="InputAlamat"> Alamat</label>
                	<textarea class="form-control" placeholder="Alamat" name="alamat"></textarea>
                </div>
                <!-- <div class="form-group">
                	<label for="InputKabupaten"> Kabupaten</label>
                	<select class="form-control" name="kabupaten_id">
                		@foreach($datakabupaten as $val)
                		<option value="{{$val->id_kabupaten}}">{{$val->nama_kabupaten}}</option>
                		@endforeach
                	</select>
                </div> -->
                <div class="form-group">
                	<label for="cabor_id"> Cabang Olahraga</label>
                	<select class="form-control" name="cabor_id">
                		@foreach($cabang_olahraga as $val)
                		<option value="{{$val->id_cabor}}">{{$val->nama_cabor}}</option>
                		@endforeach
                	</select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button id="submit" type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
    </section>

    <!-- /.content -->
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
    </script>
@endsection