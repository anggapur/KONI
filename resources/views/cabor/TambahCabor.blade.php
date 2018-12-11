@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
     <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cabang Olahraga</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{url('/add-cabor')}}">
            	{{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label>Nama Cabang Olahraga</label>
                  <input name="cabor" type="text" class="form-control" placeholder="Nama Cabang Olahraga">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </section>
    
    <!-- /.content -->
@endsection