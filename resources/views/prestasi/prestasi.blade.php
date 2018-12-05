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
				    	<h3 class="box-title">Tambah Data Prestasi</h3>
				    	<a href="{{ URL('/tambahPrestasi') }}"><button class="btn btn-success btn-sm"><i class="fa fa-plus"></i>Tambah Data</button></a>
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
		                                   	<th>Juara</th>
		                                   	<th>Medali</th>
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
	        <h4 class="modal-title">Data Prestasi</h4>
	      </div>
	      <div class="modal-body">	      	
	        <label>Nama Atlet</label>
				<input class="form-control" type="text" id="nama" disabled>
			<label>Juara</label>
				<input class="form-control" type="text" id="juara" disabled>
			<label>Medali</label>
				<input class="form-control" type="text" id="medali" disabled>
			<label>Cabang Olahraga</label>
				<input class="form-control" type="text" id="cabor" disabled>
			<label>Nomor Pertandingan</label>
				<input class="form-control" type="text" id="np" disabled>
			<label>Tingkat</label>
				<input class="form-control" type="text" id="tingkat" disabled>
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
                url: '{{ url("/get-data-prestasi") }}'
            },
            columns: [
            {data: 'nama_atlet', name: 'nama_atlet'},
            {data: 'nama_cabor', name: 'nama_cabor'},
            {data: 'ket_np', name: 'ket_np'},
            {data: 'ket_juara', name: 'ket_juara'},
            {data: 'nama_medali', name: 'nama_medali'},
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
	            url: "{{URL('/get-detail-prestasi')}}",
	            data: {
	            	'id' : id,
	            	'_token' : '{{csrf_token()}}',
	            },
	            cache: false,
	            success: function(data){
	            	data = JSON.parse(data);	            	
	            	$('#nama').val(data.nama_atlet);
	            	$('#juara').val(data.ket_juara);
	            	$('#medali').val(data.nama_medali);
	            	$('#cabor').val(data.nama_cabor);
	            	$('#np').val(data.ket_np);
	            	$('#tingkat').val(data.nama_tingkat);
	            	$('#event').val(data.nama_event);
	            	$('#waktu').val(data.waktu);
	            	$('#viewModal').modal('show');
				}
			});
		}
	</script>

	<script type="text/javascript">
		function hapus(nama,id){			
			var url = "{{url('delete-data-prestasi') }}/";
			$('#body-nama').html("<p> Yakin menghapus data Prestasi "+nama+" ? </p>");
			$('#hapus-button').html("<a href='"+url+id+"'><button type='button' class='btn btn-danger'>Hapus</button></a>");
			$('#delModal').modal('show');
		}
	</script>
	

@endsection