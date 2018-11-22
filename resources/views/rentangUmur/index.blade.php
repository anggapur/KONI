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
		    	<h3 class="box-title">Data Rentang Umur</h3>
		    	<a href="{{ URL('/administrator/rentangUmur/create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus" style="font-size: 11px"></i> Tambah Data</a>
		    </div>		
		    <div class="box-body">
                <table class="table" id="table-jenisumur">
                    <thead>
                        <tr>
                            <th>Jenis Umur</th>
                           	<th>Rentang Umur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>	                            
                </table>
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
	      <div id="body-nama-kontingen" class="modal-body">
	      	
	      </div>
	      <div id="hapus-button" class="modal-footer">
	        <form id="formDelete" method="POST" action="">
	        	{{csrf_field()}}
	        	@method('DELETE')
	        	<button type="submit" class="btn btn-danger">Hapus</button>
	        	}
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
    <!-- /.content -->
    <script type="text/javascript">
    	var url = "{{url('administrator/rentangUmur')}}/";
		function hapus(nama,id){
			$('#body-nama-kontingen').html("<p> Yakin menghapus data "+nama+" ? </p>");
			$('form#formDelete').attr('action',url+id);
			$('#delModal').modal('show');
			
		}
	</script>

     <script type="text/javascript">
	    $(function() {
        var oTable = $('#table-jenisumur').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("administrator/rentangUmur/getData") }}'
            },
            columns: [
            {data: 'jenis_umur', name: 'jenis_umur'},
            {data: 'rentang', name: 'rentang'},
            {data: 'aksi', name: 'aksi'},
        ],
        });
    });
	</script>
@endsection