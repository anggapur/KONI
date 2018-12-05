@extends('layouts.app')
@section('content')
<!-- Main content -->
    <style type="text/css">
        hr{
            margin-bottom:5px;
            margin-top:0px;
            padding:0;
            border-color:#dcdde1;
        }
    </style>
    <section class="content">
    @if(session('status'))        
        <div class="alert alert-{{session('status')}} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session('message') !!}
        </div>
    @endif
    	<div class="row">
    		<div class="col-md-12">
    			<div class="box box-primary">
    				<div class="box-header with-border">
    					<h3 class="box-title">Data Atlet</h3>
                        <a href="{{ URL('/add_atlet') }}"><button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</button></a>
    				</div>
    				<div class="box-body">
                        <div class="tableWrapper">
                            <table class="table" id="table-atlet">
                                <thead>
                                    <tr>                      
                                        <th>Nama</th>
                                        <th>Cabor</th>
                                        <th>No Kartu</th>
                                        <th>JK</th>
                                        <th>Tmp Lahir</th>
                                        <th>Tgl Lahir</th>                                        
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>                              
                            </table>
                        </div>
                		</div>
    				</form>
    			</div>
    		</div>
    	</div>
    </section>


    <!-- Modal -->
    <div id="viewModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detail Data Atlet</h4>
          </div>
          <div class="modal-body">
            <div id="images" style="text-align:center"></div>
            <b>Nama</b>
            <p id="nama_atlet"></p>
            <hr>
            <b>Cabang Olahraga</b>
            <p id="cabor"></p>
            <hr>
            <b>No Kartu Tanda Anggota</b>
            <p id="no_kartu"></p>
            <hr>
            <b>Jenis Kelamin</b>
            <p id="jk"></p>
            <hr>
            <b>TTL</b><br>
            <p><span id="tempat_lahir"></span>, <span id="tgl_lahir"></span><br></p>
            <hr>
            <b>Alamat</b>
            <p id="alamat"></p>
            <hr>
            <b>Tinggi Badan</b>
            <p id="tinggi"> cm</p>
            <hr>
            <b>Berat Badan</b>
            <p id="berat"> kg </p>
            <hr>                        
            <b>Tanggal Jadi Atlet</b>
            <p id="tgl_jadi_atlet"></p>
            <hr>            
            <div id="tgl_pensi" style="display: none;">
                <b>Tanggal Pensiun</b>
                <p id="tgl_pensiun"></p>
                <hr>
            </div>
            <b>Status</b>
            <p id="status"></p> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div id="delModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus Data</h4>
          </div>
          <div id="body-nama-atlet" class="modal-body">
            
          </div>
          <div id="hapus-button" class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>

    <!-- /.content -->
    <script type="text/javascript">
        $(function() {
        var oTable = $('#table-atlet').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("data-atlet") }}'
            },
            columns: [         
            {data: 'nama_atlet', name: 'nama_atlet'},
            {data: 'nama_cabor', name: 'nama_cabor'},
            {data: 'no_kartu_tanda_anggota', name: 'no_kartu_tanda_anggota'},
            {data: 'jenis_kelamin', name: 'jenis_kelamin'},
            {data: 'tempat_lahir', name: 'tempat_lahir'},
            {data: 'tgl_lahir', name: 'tgl_lahir'},            
            {data: 'status', name: 'status'},
            {data: 'aksi', name: 'aksi'},
        ],
        });
    });
    </script>

    <script type="text/javascript">
        function view(id){
        $('#viewModal').modal('show');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          var dataString = "id="+id;

          $.ajax({
                type: "POST",
                url: "{{URL('/get-data-atlet')}}",
                data: {
                    'id' : id,
                    '_token' : '{{csrf_token()}}',
                },
                cache: false,
                success: function(data){
                    data = JSON.parse(data);
                    $('#tgl_pensi').hide();
                    $("#nama_atlet").text(data.nama_atlet);
                    $("#cabor").text(data.nama_cabor);
                    $("#no_kartu").text(data.no_kartu_tanda_anggota);
                    $("#jk").text(data.jenis_kelamin);
                    $("#tempat_lahir").text(data.tempat_lahir);
                    $("#tgl_lahir").text(data.tgl_lahir);
                    $("#alamat").text(data.alamat);
                    $("#tinggi").text(data.tinggi);
                    $("#berat").text(data.berat);
                    $("#kabupaten").text(data.nama_kabupaten);
                    $("#tgl_jadi_atlet").text(data.tgl_jadi_atlet);
                    if(data.status != 'Aktif'){
                        $("#tgl_pensiun").text(data.tgl_pensiun);
                        $('#tgl_pensi').show();
                    }
                    $("#status").text(data.status);
                    $("#images").html("<img src='public/upload/fotoAtlet/"+data.nama_foto+"' style='max-width:300px;max-height:300px;margin-bottom:10px;'/> ");
                }
            });
        }
    </script>

    <script type="text/javascript">
        function del(id,nama){            
            var url = "{{url('hapus_atlet')}}/";
            $('#body-nama-atlet').html("<p> Yakin menghapus data "+nama+" ? </p>");
            $('#hapus-button').html("<a href='"+url+id+"'><button type='button' class='btn btn-danger' >Hapus</button></a>");
            $('#delModal').modal('show');
        }
    </script>
    
@endsection