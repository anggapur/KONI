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
                				<select class="form-control" name="cabor_id" onchange="update_np(this.value)">
                                    <option value="" selected disabled hidden>Pilih cabang olahraga</option>
                                    @foreach($listCabangOlahraga as $val)
                                        <option value="{{$val->id_cabor}}">{{$val->nama_cabor}}</option>
                                    @endforeach
                  				</select>
                			</div>
                            <!-- Nomor Pertandingan -->
                    
                            <div class="form-group">
                                <label>No Pertandingan</label>
                                <select class="form-control select2" name="np_id[]" id="np" multiple="multiple"data-placeholder="Pilih nomor pertandingan">                                   
                                </select>
                            </div>

                            <div id="tambah-np" style="display: none;" class="form-group">
                                <a target="_blank" href="{{url('/nomorPertandingan')}}"><button type="button" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah data nomor pertandingan </button></a>
                             </div>
                			<!-- No kartu tanda peserta -->
                			<div id="nkta_error" class="form-group">
                				<label>No Kartu Tanda Peserta</label>
                				<input id="nkta" class="form-control" type="text" name="nkta" minlength="0" maxlength="10" onkeyup="return validation()" placeholder="Masukkan nomor kartu tanda peserta">
                                <span id="error" class="help-block" style="display: none;">No Kartu Tanda Anggota sudah terdaftar</span>
                			</div>
                			<!-- Jenis kelamin -->
                			<div class="form-group">
                				<label>Jenis Kelamin</label>
                				<div class="radio">
                					<label>
										<input type="radio" value="P" name="jenis_kelamin">
				                      	Perempuan
				                    </label><br>
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
                						<input type="text" class="datepicker form-control" name="tgl_lahir" placeholder="Masukkan tanggal lahir">
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
                			<!-- <div class="form-group">
                				<label>Kabupaten</label>
                				<select class="form-control" name="kabupaten_id">
                    				<option>--- pilih kabupaten</option>
                                    @foreach($listKabupaten as $val)
                                        <option value="{{$val->id_kabupaten}}">{{$val->nama_kabupaten}}</option>
                                    @endforeach
                  				</select>
                  			</div> -->
                  			<!-- Tanggal Jadi, Tanggal Pensiun, dan Status-->
                			<div class="row">
                				<div class="col-md-3">
                					<div class="form-group">
                						<label>Tanggal Jadi Atlet</label>
                						<input type="text" class="datepicker1 form-control" name="tgl_jadi_atlet" placeholder="Masukkan tanggal menjadi atlet">
                					</div>
                				</div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status" onchange="pensiun(this)">
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                				<div id="tgl_pensi" class="col-md-3" style="display: none;">
                					<div class="form-group">
                						<label>Tanggal Pensiun</label>
                						<input id="form_pensi" type="text" class="datepicker2 form-control" name="tgl_pensiun" disabled placeholder="Masukkan tanggal pensiun">
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
                            <button id="submit" type="submit" class="btn btn-primary pull-left">Simpan</button>
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
<script type="text/javascript">
    function pensiun(form){        
        if(form.value == 1){
            $('#tgl_pensi').hide();
            $('#form_pensi').prop('disabled',true);
        }
        else{
            $('#tgl_pensi').show();
            $('#form_pensi').prop('disabled',false);
        }
    }
</script>
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

<script type="text/javascript">    
    function update_np(id){
        $("#np").html("<option value='' disabled selected hidden> Loading </option>");
      $.ajax({
            type: "POST",
            url: "{{URL('/getNP')}}",
            data: {
                'id' : id,
                '_token' : '{{csrf_token()}}',
            },
            cache: false,
            success: function(data){
                data = JSON.parse(data);
                
                if(data.length > 0){
                    var text ='';
                    for(var i=0;i<data.length;i++){
                        text += "<option value="+data[i].id_np+"> "+data[i].ket_np+" </option>";
                        $('#tambah-np').hide();
                    }
                }
                else{
                    text += "<option value='' disabled> Tidak ada data Nomor Pertandingan pada Cabang Olahraga ini </option>";
                    $('#tambah-np').show();
                }
                $("#np").html(text);
            }
        });         
    }
</script>
@endsection