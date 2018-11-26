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
              <h3 class="box-title">Tampil Data Wasit </h3>
              <td>
              	<a href="{{url('manajemenWasit')}}" class="btn btn-success btn-xs">
              		<i class=" fa fa-plus"></i> Tambah
              	</a>
              </td>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama Wasit</th>
                  <th>No Kartu Anggota</th>
                  <th>Cabang Olahraga</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Wasit as $val)
                <tr>
                  <td>{{ $val->nama_wasit}}</td>
                  <td>{{$val->no_kartu_anggota}}</td>
                  <td>{{$val->nama_cabor}}</td>
                  <td> 
                  	<button onclick="view({{$val->id_wasit}})" class="btn btn-warning btn-xs "> 
                  		<i class=" fa fa-eye"></i>view </button>
                  	<a href="{{url('wasit/'.$val->id_wasit.'/edit')}}" class="btn btn-primary btn-xs">
                  		<i class="fa fa-edit"> </i> edit </a>
                  	<a href="{{url('hapusWasit/'.$val->id_wasit)}}" class="btn btn-danger btn-xs"> 
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
	        <h4 class="modal-title">Data Wasit</h4>
	      </div>
	      <div class="modal-body">
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

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

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
	            	
	            	$('#nama').val(data.nama_wasit);
	            	$('#nkta').val(data.no_kartu_anggota);
	            	$('#jenis_kelamin').val(data.jenis_kelamin);
	            	$('#tempat_lahir').val(data.tempat_lahir);
	            	$('#tgl_lahir').val(data.tgl_lahir);
	            	$('#alamat').val(data.alamat);
	            	$('#viewModal').modal('show');
				}
			});
		}
	</script>
@endsection