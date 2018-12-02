@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
    	<div class="row">
    		<div class="col-md-12">
    			<div class="box box-primary">
    				<div class="box-header with-border">
    					<h3 class="box-title">Data Atlet</h3>
    				</div>
    				<form role="form" method="POST" action="{{url('saveDataAtlet')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
    					<div class="box-body">
    						<!-- Nama atlet -->
    						<div class="form-group">
                  				<label>Nama Atlet</label>
                  				<input type="text" class="form-control" name="nama_atlet" placeholder="Masukkan nama atlet">
                			</div>
                			<!-- Cabang olahraga -->
                			<div class="form-group">
                				<label>Cabang Olahraga</label>
                				<select class="form-control" name="cabor_id">
                                    <option value="">--- pilih cabang olahraga</option>
                                    @foreach($listCabangOlahraga as $val)
                                        <option value="{{$val->id_cabor}}">{{$val->nama_cabor}}</option>
                                    @endforeach
                  				</select>
                			</div>
                			<!-- No kartu tanda peserta -->
                			<div class="form-group">
                				<label>No Kartu Tanda Peserta</label>
                				<input type="text" class="form-control" name="no_kartu_tanda_anggota" placeholder="Masukkan nomor kartu tanda peserta">
                			</div>
                			<!-- Jenis kelamin -->
                			<div class="form-group">
                				<label>Jenis Kelamin</label>
                				<div class="radio">
                					<label>
										<input type="radio" value="P" name="jenis_kelamin">
				                      	Perempuan
				                    </label>
                                    <label>
                                        <input type="radio" value="L" name="jenis_kelamin">
                                        Laki-laki
                                    </label>
                				</div>
    						</div>
    						<!-- Tempat lahir -->
    						<div class="row">
    							<div class="col-md-7">
    								<div class="form-group">
                						<label>Tempat Lahir</label>
                						<input type="text" class="form-control" name="tempat_lahir" placeholder="Masukkan tempat lahir">
                					</div>
    							</div>
    							<div class="col-md-5">
    								<div class="form-group">
                						<label>Tanggal Lahir</label>
                						<input type="date" class="form-control" name="tgl_lahir">
                					</div>
    							</div>
    						</div>	
    						<!-- Alamat -->
    						<div class="form-group">
                				<label>Alamat</label>
                				<input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat">
                			</div>
                			<!-- Tinggi dan Berat Badan-->
                			<div class="row">
                				<div class="col-md-2">
                					<div class="form-group">
                						<label>Tinggi Badan</label>
                						<div class="input-group">
                							<input type="text" class="form-control" name="tinggi">
                							<span class="input-group-addon">cm</span>
              							</div>
                					</div>
                				</div>
                				<div class="col-md-2">
                					<div class="form-group">
                						<label>Berat Badan</label>
                						<div class="input-group">
                							<input type="text" class="form-control" name="berat">
                							<span class="input-group-addon">kg</span>
              							</div>
                					</div>
                				</div>
                			</div>
                			<!-- Kabupaten-->
                			<div class="form-group">
                				<label>Kabupaten</label>
                				<select class="form-control" name="kabupaten_id">
                    				<option>--- pilih kabupaten</option>
                                    @foreach($listKabupaten as $val)
                                        <option value="{{$val->id_kabupaten}}">{{$val->nama_kabupaten}}</option>
                                    @endforeach
                  				</select>
                  			</div>
                  			<!-- Tanggal Jadi, Tanggal Pensiun, dan Status-->
                			<div class="row">
                				<div class="col-md-3">
                					<div class="form-group">
                						<label>Tanggal Jadi Atlet</label>
                						<input type="date" class="form-control" name="tgl_jadi_atlet">
                					</div>
                				</div>
                				<div class="col-md-3">
                					<div class="form-group">
                						<label>Tanggal Pensiun</label>
                						<input type="date" class="form-control" name="tgl_pensiun">
                					</div>
                				</div>
                				<div class="col-md-2">
                					<div class="form-group">
                						<label>Status</label>
                						<select class="form-control" name="status">
                    						<option value="1">Aktif</option>
                    						<option value="0">Tidak Aktif</option>
                  						</select>
                					</div>
                				</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Pertandingan</label>
                                        <select class="form-control" name="np_id">
                                           <option>--- pilih no pertandingan</option>
                                            @foreach($listNoPertandingan as $val)
                                                <option value="{{$val->id_np}}">{{$val->ket_np}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                			</div>
                  			<!-- Foto -->
                  			<div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputFile">Foto Atlet</label><br>
                                        <img src="http://placehold.it/100x100" id="showgambar" style="max-width:200px;max-height:200px;float:left;margin-bottom:10px;" />
                                    </div>
                                </div>
                  				<div class="row">
                                    <div class="col-md-12">
                                        <input type="file" id="inputgambar" name="gambar" class="validate">
                                        <p class="help-block">Ukuran foto maksimal 2 MB</p>
                                    </div>
                                </div>
                			</div>
                		</div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-left">Simpan</button>
                            <button type="cancel" class="btn btn-danger pull-left" style="margin-left:10px;">Bersihkan</button>
                        </div>
    				</form>
    			</div>
    		</div>
    	</div>
    </section>
    <!-- /.content -->
    <script type="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
    (function($){
        $(function(){
            $('.button-collapse').sideNav();    
        });
    })(jQuery);
</script>
<script type="text/javascript">

      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputgambar").change(function () {
        readURL(this);
    });

</script>
@endsection