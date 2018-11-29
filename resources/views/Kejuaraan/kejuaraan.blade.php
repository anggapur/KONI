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
              <label>Tingkat Event</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-star"></i>
                </div>
              <select class="form-control" name="tingkat_event">
                <option hidden selected required>Pilih Tingkat Event</option>
                @foreach($tingkat as $tingkat)
                  <option value="{{$tingkat->id_tingkat}}">{{$tingkat->nama_tingkat}}</option>
                @endforeach
              </select>      
              </div>
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
                  <input type="text" class="form-control pull-right" name="tgl_mulai" id="datepicker_mulai" autocomplete="off">
                </div>
                <!-- /.input group -->
              </div>
     <div class="form-group">
                <label>Tanggal Selesai</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="tgl_selesai" id="datepicker_selesai" autocomplete="off">
                </div>                
                <!-- /.input group -->
              </div>
              <div class="form-group">      
                <label>Detail Event</label>
                <div  style="overflow-x: auto;">
                <table class="table">
                  <tr style="text-align: center;">
                    <td>Status</td>
                    <td>Cabang Olahraga</td>
                    <td>Tanggal Mulai</td>
                    <td>Tanggal Selesai</td>
                    <td>Tempat</td>
                    <td>Waktu Mulai</td>
                    <td>Waktu Selesai</td>
                    <td>Eksebisi</td>
                  </tr>
                  @foreach($cabor as $cabor)
                  <tr style="text-align: center;">
                    <td><input type="checkbox" name="cabor" checked></td>
                    <td style="min-width: 100px">{{$cabor->nama_cabor}}</td>
                    <td style="min-width: 150px">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      <input class="form-control" type="text" name=""></div>
                    </td>
                    <td style="min-width: 150px">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      <input class="form-control" type="text" name=""></div>
                    </td>
                    <td style="min-width: 150px">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-home"></i>
                        </div>
                      <input class="form-control" type="text" name=""></div>
                    </td>
                    <td style="min-width: 150px">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-clock"></i>
                        </div>
                      <input class="form-control" type="text" name=""></div>
                    </td>
                    <td style="min-width: 150px">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-clock"></i>
                        </div>
                      <input class="form-control" type="text" name=""></div>
                    </td>
                    <td><input class="" type="checkbox" name=""></td>
                  </tr>
                  @endforeach
                </table>                
              </div>
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </section>
    <!-- /.content -->
@endsection