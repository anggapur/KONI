@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
    	@if (session('status'))
              <div class="alert alert-{{session('status')}} alert-dismissible">
              	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {!! session('message') !!}
              </div>
          @endif
          @if ($errors->any())
              <div class="alert alert-danger alert-dismissible">
              	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{!! $error !!}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
      <div class="box box-primary">
      	<div class="box-header with-border">
      		<div class="box-title"> Data Level</div>
      		<a href="{{route('level.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data Level</a>
      	</div>
      	<div class="box-body">
      		<div class="tableWrapper">
				<table id="tableData" class="table">
					<thead>
						<tr>				
							<th>Nama Level</th>
              <th>Keterangan</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>   
			</div>   
      	</div>
      </div>
     
    </section>
    <!-- Modal -->
	<div id="delModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Hapus Data</h4>
	      </div>
	      <div id="body-modal" class="modal-body">
	      	
	      </div>
	      <div id="hapus-button" class="modal-footer">
	        <form id="formDelete" method="POST" action="">
	        	{{csrf_field()}}
	        	@method('DELETE')
	        	<button type="submit" class="btn btn-danger">Hapus</button>
	        	
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
    <!-- /.content -->
    <script type="text/javascript">
	    $(function() {
        var oTable = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("getDataLevel") }}'
            },
            columns: [
            {data: 'nama_level', name: 'nama_level'},
            {data: 'keterangan', name: 'keterangan'},
            {data: 'aksi'},
        ],
        });
    });
	</script>
	<script type="text/javascript">
    	var url = "{{url('level')}}/";
		function hapus(nama,id){
			$('#body-modal').html("<p> Yakin menghapus data "+nama+" ? </p>");
			$('form#formDelete').attr('action',url+id);
			$('#delModal').modal('show');
			
		}
	</script>
@endsection
