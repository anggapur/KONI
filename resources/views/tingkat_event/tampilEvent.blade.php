@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
      		
      		@if(session('status'))
      		<div class="alert alert-{{session('status')}}">
      			{{session('message')}}
      		</div>
      		@endif


            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tampil Data Tingkat Event </h3>
              <td>
              	<a href="{{url('tambahdata_event')}}" class="btn btn-success btn-xs">
              		<i class=" fa fa-plus"></i> Tambah
              	</a>
              </td>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Tingkat Event</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datatingkat as $val)
                <tr>
                  <td>{{ $val->nama_tingkat}}</td>
                  <td> 
                  	<a href="{{url('#')}}" class="btn btn-primary btn-xs">
                  		<i class="fa fa-edit"> </i> edit </a>
                  	<a href="{{url('#')}}" class="btn btn-danger btn-xs"> 
                  		<i class="fa fa-trash"></i>delete </a>
                  </td>
                </tr>
                @endforeach
                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->

    <div id="viewModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Data Tingkat Event</h4>
	      </div>
	      <div class="modal-body">
	        <label>Nama Tingkat Event</label>
				<input class="form-control" type="text" id="nama" disabled>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!--Modal-->
<!-- 	<div id="delModal" class="modal fade" role="dialog">
	  <div class="modal-dialog"> -->
	    <!-- Modal content-->
<!-- 	    <div class="modal-content">
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
 -->
<script type="text/javascript">
		function view(id){

		
	      var dataString = "id="+id;

	      $.ajax({
	            type: "POST",
	            url: "{{URL('/get-data-wasit')}}",
	            data: {
	            	'id' : id,
	            	'_token' : '{{csrf_token()}}',
	            },
	            cache: false,
	            success: function(data){
	            	console.log(data);
	            	
	            	$('#nama').val(data.nama_tingkat);
	            	$('#viewModal').modal('show');
				}
			});
		}
	</script>

<!-- 	<script type="text/javascript">
		function hapus(nama,id){
			$('#body-nama-kontingen').html("<p> Yakin menghapus data "+nama+" ? </p>");
			$('#hapus-button').html("<button type='button' class='btn btn-danger' onclick='del("+id+")'>Hapus</button>");
			$('#delModal').modal('show');
		}
	</script> -->
@endsection