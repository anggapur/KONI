@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Kejuaraan</h3>
            </div>
            <form method="POST" action="{{url('simpanEvent')}}">
            {{csrf_field()}}
    <div class="form-group">
                  <label>Nama Kejuaraan</label>
                  <input type="text" class="form-control" name="nama_event" placeholder="Enter ...">
                </div>
    <div class="form-group">
                  <label>Lokasi</label>
                  <input type="text" class="form-control" name="lokasi" placeholder="Enter ...">
                </div>
     <div class="form-group">
                <label>Tanggal Mulai</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="tgl_mulai" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
     <div class="form-group">
                <label>Tanggal Selesai</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="tgl_selesai" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
     
              <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </section>
    <!-- /.content -->
@endsection