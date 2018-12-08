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
				    	<h3 class="box-title">Tambah Data Rekor</h3>
				    	<a href="{{ URL('/tambahRekor') }}"><button class="btn btn-success btn-sm"><i class="fa fa-plus"></i>Tambah Data</button></a>
				    </div>
				    	<div class="box-body">

		                	<!-- <center><h2>Data Prestasi</h2></center> -->
		                    <div class="tableWrapper">
		                        <table class="table" id="table-np">
		                            <thead>		                            	
		                                <tr>                      
		                                	<th>Nama Atlet</th>
		                                   	<th>Cabang Olahraga</th>
		                                   	<th>Nomor Pertandingan</th>
		                                   	<th>Keterangan Rekor</th>
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
    <!-- /.content -->
    <!-- Modal -->
	<div id="viewModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Data Rekor</h4>
	      </div>
	      <div class="modal-body">
	      	<label>ID</label>
				<input class="form-control" type="text" id="id" disabled>
	        <label>Nama Atlet</label>
				<input class="form-control" type="text" id="nama" disabled>
			<label>Keterangan Rekor</label>
				<input class="form-control" type="text" id="rekor" disabled>
			<label>Cabang Olahraga</label>
				<input class="form-control" type="text" id="cabor" disabled>
			<label>Nomor Pertandingan</label>
				<input class="form-control" type="text" id="np" disabled>
			<label>Event</label>
				<input class="form-control" type="text" id="event" disabled>
			<label>Waktu</label>
				<input class="form-control" type="text" id="waktu" disabled>
			
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
	      <div id="body-nama" class="modal-body">
	      	
	      </div>
	      <div id="hapus-button" class="modal-footer">
	        
	      </div>
	    </div>
	  </div>
	</div>

    <script type="text/javascript">
	    $(function() {
        var oTable = $('#table-np').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("/get-data-rekor") }}'
            },
            columns: [
            {data: 'nama_atlet', name: 'nama_atlet'},
            {data: 'nama_cabor', name: 'nama_cabor'},
            {data: 'ket_np', name: 'ket_np'},
            {data: 'keterangan_rekor', name: 'keterangan_rekor'},
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
	            url: "{{URL('/get-detail-rekor')}}",
	            data: {
	            	'id' : id,
	            	'_token' : '{{csrf_token()}}',
	            },
	            cache: false,
	            success: function(data){
	            	data = JSON.parse(data);
	            	$('#id').val(data.id_rekor);
	            	$('#nama').val(data.nama_atlet);
	            	$('#rekor').val(data.keterangan_rekor);
	            	$('#cabor').val(data.nama_cabor);
	            	$('#np').val(data.ket_np);
	            	$('#event').val(data.nama_event);
	            	$('#waktu').val(data.waktu);
	            	$('#viewModal').modal('show');
				}
			});
		}
	</script>

	<script type="text/javascript">
		function hapus(nama,id){
			var url = "{{URL('/delete-data-rekor')}}/";
			$('#body-nama').html("<p> Yakin menghapus data Rekor "+nama+" ? </p>");
			$('#hapus-button').html("<a href="+url+id+"><button type='button' class='btn btn-danger'>Hapus</button></a>");
			$('#delModal').modal('show');
		}
	</script>
	

@endsection