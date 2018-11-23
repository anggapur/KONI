@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
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
                <div class="form-group">
                  <label for="exampleInputNoAnggota">No Kartu Anggota</label>
                  <input type="text" class="form-control" id="exampleInputNoAnggota" placeholder="No Kartu Anggota" name="no_kartu_anggota">
                </div>
                <div class="form-group">
                  <label for="exampleInputjeniskelamin">Jenis Kelamin</label><br>
                  <input type="radio" name="jenis_kelamin" value="L"> Laki - Laki
                  <input type="radio" name="jenis_kelamin" value="P"> Perempuan
                </div>
                <div class="form-group">
                	<br><label for="Inputtempatlahir">Tempat Lahir</label>
                	<input type="text" class="form-control id="Inputtempatlahir" placeholder="Tempat Lahir" name="tempat_lahir">
                </div class="form-group">
                <div class="form-group">
                	<label for="TanggalLahir"> Tanggal Lahir </label><br>
                	<input type="date" class="form-control" name="tgl_lahir">
                </div>
                <div class="form-group">
                	<label for="InputAlamat"> Alamat</label>
                	<textarea class="form-control" placeholder="Alamat" name="alamat"></textarea>
                </div>
                <div class="form-group">
                	<label for="InputKabupaten"> Kabupaten</label>
                	<select class="form-control" name="kabupaten_id">
                		@foreach($datakabupaten as $val)
                		<option value="{{$val->id_kabupaten}}">{{$val->nama_kabupaten}}</option>
                		@endforeach
                	</select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection
    </section>
    <!-- /.content -->
@endsection