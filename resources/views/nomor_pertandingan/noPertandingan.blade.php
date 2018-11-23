@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
            <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Nomor Pertandingan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="POST" action="{{url('saveNomorPertandingan')}}">
              {{csrf_field()}}
                <div class="form-group">
                  <label>Cabang Olahraga</label>
                  <select class="form-control" name="cabor_id">
                  @foreach($listCabangOlahraga as $val)
                    <option value="{{$val->id_cabor}}">{{$val->nama_cabor}}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <input type="text" class="form-control" name="ket_np" placeholder="Enter ...">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </form>

    </section>
    <!-- /.content -->
@endsection