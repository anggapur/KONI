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
		    	<h3 class="box-title">Import Data</h3>
		    </div>		
		    <div class="box-body">
          <div class="row">
            <form method="POST" enctype="multipart/form-data" action="{{route('importData.store')}}">
              {{csrf_field()}}
              <div class="col-md-3">
                <div class="form-group">
                  <label>Pilih Jenis Data</label>
                  <select class="form-control" name="jenis_data">
                    <option value="atlet">Atlet</option>
                    <option value="pelatih">Pelatih</option>
                    <option value="wasit">Wasit</option>
                  </select>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Import Data Excel</label>
                  <input type="file" name="file_data" class="form-control" required="required">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group" style="padding-top: 24px;">
                  <input type="submit" name="submit" class="btn btn-success" value="Import">
                  <input type="reset" name="cancel" class="btn btn-default" value="Cancel">
                </div>
              </div>
            </form>
          </div>
		    </div>  
		</div>
    </section>
    
@endsection