@extends('layouts.app')
@section('content')
<!-- Main content -->

    <section class="content">
		@if(session('status'))
			@if(session('status') == 'success')
			<div class="alert alert-success alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    <h4><i class="fa fa-check"></i> Data berhasil ditambahkan</h4>
			</div>
			@elseif(session('status') == 'edited')
			<div class="alert alert-success alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    <h4><i class="fa fa-check"></i> Data berhasil diubah</h4>
			</div>
			@elseif(session('status') == 'deleted')
			<div class="alert alert-success alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    <h4><i class="fa fa-check"></i> Data berhasil dihapus</h4>
			</div>
			@elseif(session('status') == 'failed add')
			<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    <h4><i class="fa fa-times"></i> Gagal menambah data</h4>		    
			</div>
			@elseif(session('status') == 'failed edit')
			<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    <h4><i class="fa fa-times"></i> Gagal mengubah data</h4>
			</div>
			@elseif(session('status') == 'failed delete')
			<div class="alert alert-danger alert-dismissible">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
s		    <h4><i class="fa fa-times"></i> Gagal menghapus data</h4>
			</div>
			@endif
		@endif
		  	          
	    <div class="row">
	       	<div class="col-xs-12">      	
				<div class="box box-primary">
				    <div class="box-header with-border">
				    	<h3 class="box-title">Tambah Data Nomor Pertandingan</h3>				    
				    	<a href="{{ URL('/nomorPertandingan') }}"><button class="btn btn-success"><i class="fa fa-plus"></i></button></a>
				    </div>
				    	<div class="box-body">

		                	<center><h2>Data Nomor Pertandingan</h2></center>
		                    <div class="tableWrapper">
		                        <table class="table" id="table-np">
		                            <thead>
		                                <tr>                      
		                                   	<th>Cabang Olahraga</th>
		                                   	<th>Nomor Pertandingan</th>
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
            {data: 'aksi', name: 'aksi'},
        ],
        });
    });
	</script>
	

@endsection