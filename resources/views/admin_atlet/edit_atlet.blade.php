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
    				<form role="form" method="POST" action="{{url('update_atlet')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
    					<div class="box-body">
                            <input type="hidden" class="form-control" name="id_atlet" value="{{ $data_atlet->id_atlet }}">
                            <input type="hidden" class="form-control" name="id_detail" value="{{ $data_atlet->id_detail }}">
                            <input type="hidden" class="form-control" name="id_foto" value="{{ $data_atlet->id_foto }}">
                            <input type="hidden" class="form-control" name="nama_foto" value="{{ $data_atlet->nama_foto }}">
    						<!-- Nama atlet -->
    						<div class="form-group">
                  				<label>Nama Atlet</label>
                  				<input type="text" class="form-control" name="nama_atlet" placeholder="Masukkan nama atlet" value="{{ $data_atlet->nama_atlet }}">
                			</div>
                			<!-- Cabang olahraga -->
                			<div class="form-group">
                				<label>Cabang Olahraga</label>
                				<select class="form-control" name="cabor_id" onchange="update_np(this.value)">
                                    @foreach($listCabangOlahraga as $val)
                                        <option value="{{$val->id_cabor}}"
                                        @if($data_atlet->cabor_id == $val->id_cabor):
                                        {{ "selected" }}
                                        @endif
                                        >
                                        {{$val->nama_cabor}}</option>
                                    @endforeach
                  				</select>
                			</div>

                            <div class="form-group">
                                <label>No Pertandingan</label>
                                <select class="form-control select2" name="np_id[]" id="np" multiple="multiple" data-placeholder="Pilih nomor pertandingan">
                                    @foreach($listNoPertandingan as $np)
                                        <option value="{{ $np->id_np }}" 
                                            @if( in_array($np->id_np,$atletNP1) )
                                                {{ "selected" }}
                                            @endif

                                        > {{ $np->ket_np }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="tambah-np" style="display: none;" class="form-group">
                                <a target="_blank" href="{{url('/nomorPertandingan')}}"><button type="button" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah data nomor pertandingan </button></a>
                            </div>
                			<!-- No kartu tanda peserta -->
                			<div id="nkta_error" class="form-group">
                				<label>No Kartu Tanda Peserta</label>
                				<input type="text" class="form-control" name="no_kartu_tanda_anggota" placeholder="Masukkan nomor kartu tanda peserta" value="{{ $data_atlet->no_kartu_tanda_anggota }}">
                                <span id="error" class="help-block" style="display: none;">No Kartu Tanda Anggota sudah terdaftar</span>
                			</div>
                			<!-- Jenis kelamin -->
                			<div class="form-group">
                				<label>Jenis Kelamin</label>
                				<div class="radio">
                                @if($data_atlet->jenis_kelamin == "P")
                                    <label>
                                        <input type="radio" value="P" name="jenis_kelamin" checked>
                                        Perempuan
                                    </label> <br>
                                    <label>
                                        <input type="radio" value="L" name="jenis_kelamin">
                                        Laki-laki
                                    </label>
                                @endif
                                @if($data_atlet->jenis_kelamin == "L")
                                    <label>
                                        <input type="radio" value="P" name="jenis_kelamin">
                                        Perempuan
                                    </label> <br>
                                    <label>
                                        <input type="radio" value="L" name="jenis_kelamin" checked>
                                        Laki-laki
                                    </label>
                                @endif
                				</div>
    						</div>
    						<!-- Tempat lahir -->
    						<div class="row">
    							<div class="col-md-7">
    								<div class="form-group">
                						<label>Tempat Lahir</label>
                						<input type="text" class="form-control" name="tempat_lahir" placeholder="Masukkan tempat lahir" value="{{ $data_atlet->tempat_lahir }}">
                					</div>
    							</div>
    							<div class="col-md-5">
    								<div class="form-group">
                						<label>Tanggal Lahir</label>
                						<input type="text" class="form-control datepicker" name="tgl_lahir" value="{{ $data_atlet->tgl_lahir }}">
                					</div>
    							</div>
    						</div>	
    						<!-- Alamat -->
    						<div class="form-group">
                				<label>Alamat</label>
                				<input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat" value="{{ $data_atlet->alamat }}">
                			</div>
                			<!-- Tinggi dan Berat Badan-->
                			<div class="row">
                				<div class="col-md-2">
                					<div class="form-group">
                						<label>Tinggi Badan</label>
                						<div class="input-group">
                							<input type="text" class="form-control" name="tinggi" value="{{ $data_atlet->tinggi }}">
                							<span class="input-group-addon">cm</span>
              							</div>
                					</div>
                				</div>
                				<div class="col-md-2">
                					<div class="form-group">
                						<label>Berat Badan</label>
                						<div class="input-group">
                							<input type="text" class="form-control" name="berat" value="{{ $data_atlet->berat }}">
                							<span class="input-group-addon">kg</span>
              							</div>
                					</div>
                				</div>
                			</div>
                			<!-- Kabupaten-->
                			<!-- <div class="form-group">
                				<label>Kabupaten</label>
                				<select class="form-control" name="kabupaten_id">
                                    @foreach($listKabupaten as $val)
                                        <option value="{{$val->id_kabupaten}}"
                                        @if($data_atlet->kabupaten_id == $val->id_kabupaten):
                                        {{ "selected" }}
                                        @endif
                                        >
                                        {{$val->nama_kabupaten}}</option>
                                    @endforeach
                  				</select>
                  			</div> -->
                  			<!-- Tanggal Jadi, Tanggal Pensiun, dan Status-->
                			<div class="row">
                				<div class="col-md-3">
                					<div class="form-group">
                						<label>Tanggal Jadi Atlet</label>
                						<input type="text" class="form-control datepicker" name="tgl_jadi_atlet" value="{{ $data_atlet->tgl_jadi_atlet }}">
                					</div>
                				</div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status" onchange="pensiun(this)">
                                        @if($data_atlet->status == 1)
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        @else
                                            <option value="1">Aktif</option>
                                            <option value="0" selected>Tidak Aktif</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                				<div class="col-md-3">                                
                					<div class="form-group" id="tgl_pensi" style="
                                    @if($data_atlet->status == 1)
                                        {{ "display:none" }}
                                    @endif
                                    ">
                						<label>Tanggal Pensiun</label>
                						<input type="text" class="form-control datepicker" name="tgl_pensiun" value="{{ $data_atlet->tgl_pensiun }}" placeholder="Masukkan tanggal pensiun">
                					</div>
                				</div>                                
                			</div>
                  			<!-- Foto -->
                  			<div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputFile">Foto Atlet</label><br>
                                        <img src="{{asset('public/upload/fotoAtlet/'.$data_atlet->nama_foto)}}" id="showgambar" style="max-width:200px;max-height:200px;float:left;margin-bottom:10px;" />
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