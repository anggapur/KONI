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
              <table class="table" id="table-wasit">
                <thead>
                <tr>
                  <th>Nama Wasit</th>
                  <th>No Kartu Anggota</th>
                  <th>Cabang Olahraga</th>
                  <th>Aksi</th>
                </tr>
                </thead>                
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
				<input class="form-control" type="text" id="tgl_lahir" disabled><br>			
			<label>Alamat</label>
				<textarea class="form-control" id="alamat" disabled></textarea><br>
			<label>Cabang Olahraga</label>
				<input class="form-control" type="text" id="cabor" disabled="">

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
            	$('#cabor').val(data.nama_cabor);
            	$('#viewModal').modal('show');
			}
		});
	}
</script>

<script type="text/javascript">
    $(function() {
    var oTable = $('#table-wasit').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("data-wasit") }}'
        },
        columns: [
        {data: 'nama_wasit', name: 'nama_wasit'},
        {data: 'no_kartu_anggota', name: 'no_kartu_anggota'},
        {data: 'nama_cabor', name: 'nama_cabor'},        
        {data: 'aksi', name: 'aksi'},
    ],
    });
});
</script>

<script type="text/javascript">
	function hapus(nama,id){
		var url = "{{url('hapusWasit')}}/";
		$('#body-nama').html("<p> Yakin menghapus data "+nama+" ? </p>");
		$('#hapus-button').html("<a href='"+url+id+"'><button type='button' class='btn btn-danger'>Hapus</button>");
		$('#delModal').modal('show');
	}
</script>	
@endsection