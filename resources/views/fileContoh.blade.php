@extends('layouts.app')
@section('content')
<!-- Main content -->
<style type="text/css">
	.form-group{
		width: 900px;
	}
</style>
    <section class="content">
            <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Nomor Pertandingan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                <div class="form-group">
                  <label>Cabang Olahraga</label>
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <input type="text" class="form-control" placeholder="Enter ...">
                </div>
            

    </section>
    <!-- /.content -->
@endsection