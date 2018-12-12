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
		    	<h3 class="box-title">Edit Data Juara</h3>
		    </div>	
		    <div class="box-body">
		    	<form method="POST" action="{{route('juara.update',$dataJuara->id_juara)}}">
		    		{{csrf_field()}}
		    		@method('PUT')
			    	<div class="row">
			    		<div class="col-md-4">
			    			<div class="form-group">
				    			<label>Nama Juara</label>
				    			<input type="text" name="ket_juara" class="form-control" placeholder="Nama Juara" value="{{$dataJuara->ket_juara}}">
				    		</div>
			    		</div>
			    		
			    	</div>
		    </div>	
		    <div class="box-footer">
		    	<button type="submit" class="btn btn-success">Update</button>
		    	<button type="cancel" class="btn btn-default">Cancel</button>
		    	</form>
		    </div>  
		</div>
    </section>
    <!-- /.content -->
@endsection