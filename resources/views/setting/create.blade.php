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
		    	<h3 class="box-title">Tambah Data Setting</h3>
		    </div>	
		    <div class="box-body">
		    	<form method="POST" action="{{route('setting.store')}}" enctype="multipart/form-data">
		    		{{csrf_field()}}
			    	<div class="row">
			    		<div class="col-md-12">
			    			<div class="form-group">
				    			<label>Attr</label>
				    			<input type="text" name="attr" class="form-control" placeholder="Nama Attribute">
				    		</div>
			    		</div>

			    		<div class="col-md-12">
			    			<div class="form-group">
				    			<label>Deskripsi</label>
				    			<textarea type="text" name="deskripsi" class="form-control" placeholder="Deskripsi Attribute"></textarea>
				    		</div>
			    		</div>			    		

			    		<div class="col-md-12">
			    			<div class="form-group">
				    			<label>Tipe Setting</label>
				    			<select class="form-control" name="type" onchange="change(this.value)">
				    				<option value="text">Text</option>
				    				<option value="image">Image</option>
				    			</select>
				    		</div>
			    		</div>

			    		<div class="col-md-12">
			    			<div class="form-group">
				    			<label>Status</label>
				    			<select class="form-control" name="status">
				    				<option value="1">Aktif</option>
				    				<option value="0">Tidak Aktif</option>
				    			</select>
				    		</div>
			    		</div>

			    		<div class="col-md-12">
			    			<div class="form-group">
				    			<label>Value</label>
				    			<textarea id="text" class="form-control value" name="value"></textarea>
				    			<input id="image" type="file" name="value" class="form-control value" style="display: none;">
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

    <script type="text/javascript">
    	function change(value){
    		$('.value').hide();
    		$('#'+value).fadeIn();
    	}
    </script>
@endsection