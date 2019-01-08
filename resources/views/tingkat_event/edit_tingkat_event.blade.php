@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
      
      <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Edit Tingkat Event</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{url('updatedata_event')}}">
            	{{csrf_field()}}
              <input type="hidden" name="id_tingkat" value="{{$tingkat->id_tingkat}}">
              <div class="box-body">
                <div class="form-group">
                  <label for="InputNama">Nama Tingkat Event</label>
                  <input type="text" class="form-control" id="InputNama" placeholder="Input Tingkat Event" name="nama_tingkat" value="{{$tingkat->nama_tingkat}}">
                </div>                                    
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            </form>            
            </div>          
          <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection