@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
      <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Kejuaraan</h3>
            </div>
            <form method="POST" action="{{url('updateEvent')}}">
            <input type="hidden" name="id_event" value="{{ $data_event->id_event }}">
            {{csrf_field()}}
    <div class="form-group">
                  <label>Nama Kejuaraan</label>
                  <input type="text" class="form-control" name="nama_event" placeholder="Enter ..." value="{{$data_event->nama_event}}">
                </div>
                <div class="form-group">
                  <label>Tingkat Event</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-star"></i>
                  </div>
                  <select class="form-control" name="tingkat_event">
                      <option hidden selected required>Pilih Tingkat Event</option>
                      @foreach($tingkat as $tingkat)
                        <option value="{{$tingkat->id_tingkat}}" 
                          @if($tingkat->id_tingkat == $data_event->tingkat_id) {{ "selected" }} @endif
                          >{{$tingkat->nama_tingkat}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
    <div class="form-group">
                  <label>Lokasi</label>
                  <input type="text" class="form-control" name="lokasi" placeholder="Enter ..." value="{{$data_event->lokasi}}">
                </div>
     <div class="form-group">
                <label>Tanggal Mulai</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="tgl_mulai" id="datepicker" value="{{$data_event->tgl_mulai}}">
                </div>
                <!-- /.input group -->
              </div>
     <div class="form-group">
                <label>Tanggal Selesai</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="tgl_selesai" id="datepicker" value="{{$data_event->tgl_selesai}}">
                </div>
                <!-- /.input group -->
              </div>
     
              <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </section>
    <!-- /.content -->
@endsection