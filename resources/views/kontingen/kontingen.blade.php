@extends('layouts.app')
@section('content')
<!-- Main content -->

    <section class="content">
		@if(session('status'))        
	        <div class="alert alert-{{session('status')}} alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            {!! session('message') !!}
	        </div>
	    @endif
		  	          
	    <div class="row">
	       	<div class="col-xs-12">      	
				<div class="box box-primary">
				    <div class="box-header with-border">
				    	<h3 class="box-title">Tambah Data Kontingen</h3>				    
				    	<a href="{{ URL('/tambah-kontingen') }}"><button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</button></a>
				    </div>
				    	<div class="box-body">

		                	<!-- <center><h2>Data Kontingen</h2></center> -->
		                    <div class="tableWrapper">
		                        <table class="table" id="table-kontingen">
		                            <thead>
		                                <tr>
		                                    <th>Nama Kontingen</th>
		                                   	<th>Cabang Olahraga</th>
		                                    <th>Jabatan</th>
		                                    <th>Aksi</th>
		                                </tr>
		                            </thead>	                            
		                        </table>
		                    </div>

		                
	                </div>
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
	        <h4 class="modal-title">Data Kontingen</h4>
	      </div>
	      <div class="modal-body">
	      	<label>ID</label>
				<input class="form-control" type="text" id="id" disabled>
	        <label>Nama</label>
				<input class="form-control" type="text" id="nama" disabled>
			<label>No Kartu Tanda Anggota</label>
				<input class="form-control" type="text" id="nkta" disabled>
			<label>Jenis Kelamin</label>
				<input class="form-control" type="text" id="jenis_kelamin" disabled>
			<label>Tempat Lahir</label>
				<input class="form-control" type="text" id="tempat_lahir" disabled><br>
			<label>Tanggal Lahir</label>
				<input class="form-control" type="date" id="tgl_lahir" disabled><br>
			<label>Alamat</label>
				<textarea class="form-control" id="alamat" disabled></textarea><br>
			<label>Jabatan</label>
				<input class="form-control" type="text" id="jabatan" disabled>
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
	      <div id="body-nama-kontingen" class="modal-body">
	      	
	      </div>
	      <div id="hapus-button" class="modal-footer">
	        
	      </div>
	    </div>
	  </div>
	</div>
    <!-- /.content -->
    <script type="text/javascript">
	    $(function() {
        var oTable = $('#table-kontingen').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("data-kontingen") }}'
            },
            columns: [
            {data: 'nama_kontingen', name: 'nama_kontingen'},
            {data: 'nama_cabor', name: 'nama_cabor'},
            {data: 'nama_jabatan', name: 'jabatan'},
            {data: 'aksi', name: 'aksi'},
        ],
        });
    });
	</script>

	<script type="text/javascript">
		function view(id){

			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

	      var dataString = "id="+id;

	      $.ajax({
	            type: "POST",
	            url: "{{URL('/get-data-kontingen')}}",
	            data: {
	            	'id' : id,
	            	'_token' : '{{csrf_token()}}',
	            },
	            cache: false,
	            success: function(data){
	            	data = JSON.parse(data);
	            	$('#id').val(data.id_kontingen);
	            	$('#nama').val(data.nama_kontingen);
	            	$('#nkta').val(data.no_kartu_tanda_anggota);
	            	$('#jenis_kelamin').val(data.jenis_kelamin);
	            	$('#tempat_lahir').val(data.tempat_lahir);
	            	$('#tgl_lahir').val(data.tgl_lahir);
	            	$('#alamat').val(data.alamat);
	            	$('#jabatan').val(data.nama_jabatan);
	            	$('#viewModal').modal('show');
				}
			});
		}
	</script>

	<script type="text/javascript">
		function hapus(nama,id){
			var url = "{{url('delete-data-kontingen')}}/";
			$('#body-nama-kontingen').html("<p> Yakin menghapus data "+nama+" ? </p>");
			$('#hapus-button').html("<a href='"+url+id+"'><button type='button' class='btn btn-danger'>Hapus</button>");
			$('#delModal').modal('show');
		}
	</script>	

@endsection