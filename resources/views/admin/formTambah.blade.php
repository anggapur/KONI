@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
      
	  @if(session('status')=='0')
      	<script>alert('Sudah Benar Mas')</script>
      @endif

      @if(session('status')=='1')
        <div class="alert alert-danger alert-dismissible">Email Udah Ada Mas!</div>
      @endif	
	  
      @if(session('status')=='2')
        <div class="alert alert-danger alert-dismissible">Password Kurang Mas!</div>
	    @endif

    @if(session('status')=='3')
        <div class="alert alert-danger alert-dismissible">Konfirmasi Password Tidak Sama Mas!</div>
      @endif
      
	  @if(session('status')=='4')
      	<script>alert('Ga Ada Koneksi Internet Mas')</script>
      @endif

      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" role="form" action="{{URL::to('/insert')}}">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input name="name" type="text" class="form-control" id="name" placeholder="Nama" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input name="email" type="email" class="form-control" id="email" placeholder="email@email.com" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <label for="cpassword">Konfirmasi Password</label>
                  <input name="cpassword" type="password" class="form-control" id="cpassword" placeholder="Konfirmasi Password" required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
     
    </section>
    <!-- /.content -->
@endsection