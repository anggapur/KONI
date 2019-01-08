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
				    	<h3 class="box-title">Tambah Data Nomor Pertandingan</h3>				    
				    	<a href="{{ URL('/nomorPertandingan') }}"><button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</button></a>
				    </div>
				    	<div class="box-body">

		                	<!-- <center><h2>Data Nomor Pertandingan</h2></center> -->
		                    <div class="tableWrapper">
		                        <table class="table" id="table-np">
		                            <thead>
		                                <tr>                      
		                                   	<th>Cabang Olahraga</th>
		                                   	<th>Nomor Pertandingan</th>
		                                   	<th>Jumlah Atlet</th>
		                                    <th>Aksi</th>
		                                </tr>
		                            </thead>	                            
		                        </table>
		                    </div>

		                
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
		      <div id="body-nama-np" class="modal-body">
		      	
		      </div>
		      <div id="hapus-button" class="modal-footer">
		        
		      </div>
		    </div>
		  </div>
		</div>

    </section>
    <!-- /.content -->
    <script type="text/javascript">
	    $(function() {
        var oTable = $('#table-np').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("data-np") }}'
            },
            columns: [           
            {data: 'nama_cabor', name: 'nama_cabor'},
            {data: 'ket_np', name: 'ket_np'},
            {data: 'atlet', name: 'atlet'},
            {data: 'aksi', name: 'aksi'},
        ],
        });
    });
	</script>
	
	<script type="text/javascript">
		function del(id,nama){
			var url = "{{url('hapusNoPertandingan')}}/";
			$('#body-nama-np').html("<p> Yakin menghapus data "+nama+" ? </p>");
			$('#hapus-button').html("<a href='"+url+id+"'><button type='button' class='btn btn-danger' onclick='del("+id+")'>Hapus</button></a>");
			$('#delModal').modal('show');
		}
	</script>

@endsection