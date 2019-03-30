@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
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
		    	<h3 class="box-title">Tambah Data Level</h3>
		    </div>	
		    <div class="box-body">
		    	<form method="POST" action="{{route('level.update',$data->id_level)}}">
		    		{{csrf_field()}}
		    		@method('PUT')
			    	<div class="row">
			    		<div class="col-md-12">
			    			<div class="form-group">
				    			<label>Nama Level</label>
				    			<input type="text" name="nama_level" class="form-control" placeholder="Nama Level" value="{{$data->nama_level}}">
				    		</div>
			    		</div>
			    		<div class="col-md-12">
			    			<div class="form-group">
				    			<label>Keterangan</label>
				    			<textarea class="form-control" name="keterangan" placeholder="Keterangan Level">{{$data->keterangan}}</textarea>
				    		</div>
			    		</div>	
			    	</div>
		    </div>	
		    <div class="box-footer">
		    	<button type="submit" class="btn btn-success">Simpan</button>		    	
		    	</form>
		    </div>  
		</div>
    </section>
    <!-- /.content -->
@endsection