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
                  <input type="text" class="form-control pull-right" name="tanggal_mulai" id="datepicker_mulai" autocomplete="off">
                </div>
                <!-- /.input group -->
              </div>
     <div class="form-group">
                <label>Tanggal Selesai</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="tanggal_selesai" id="datepicker_selesai" autocomplete="off">
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
                  <?php $i=0; ?>
                  @foreach($cabor as $cabor)
                  <tr style="text-align: center;">  
                    <input type="hidden" name="id_cabor[]" value="{{$cabor->id_cabor}}">
                    <input id="cabor<?php  echo $i; ?>" type="hidden" name="cabor[]" value="off" disabled>
                    <td><label class="switch"><input type="checkbox" name="cabor[]" onchange="disable(this,<?php  echo $i; ?>)" checked><div class="slider round"></div></label></td>
                    <td style="min-width: 100px">{{$cabor->nama_cabor}}</td>
                    <td style="min-width: 150px">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      <input class="form-control datepicker" type="text" name="tgl_mulai[]>"></div>
                    </td>
                    <td style="min-width: 150px">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      <input class="form-control datepicker" type="text" name="tgl_selesai[]"></div>
                    </td>
                    <td style="min-width: 150px">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-home"></i>
                        </div>
                      <input class="form-control" type="text" name="tempat[]"></div>
                    </td>
                    <td style="min-width: 150px">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-clock"></i>
                        </div>
                      <input class="form-control timepicker" type="text" name="wkt_mulai[]"></div>
                    </td>
                    <td style="min-width: 150px">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-clock"></i>
                        </div>
                      <input class="form-control timepicker" type="text" name="wkt_selesai[]"></div>
                    </td>
                    <input id="eksebisi<?php  echo $i; ?>" type="hidden" name="eksebisi[]" value="off">
                    <td><label class="switch"><input type="checkbox" name="eksebisi[]" onchange="eksebisi(this,<?php echo $i; ?>)"><div class="slider round"></div></label></td>
                  </tr>
                  <?php  $i++; ?>    
                  @endforeach
                </table>                
              </div>
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
      </form>      
    </section>
    
    <script>
      function disable(input,i){        
        form = document.getElementById('cabor'+i);
        if(input.checked)
            form.disabled = true;
        else
            form.disabled = false;
      }

      function eksebisi(input,i){        
        form = document.getElementById('eksebisi'+i);
        if(input.checked)
            form.disabled = true;
        else
            form.disabled = false;
      }
    </script>
    <!-- /.content -->
@endsection