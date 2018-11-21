@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
      
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" role="form" action="{{URL::to('admin/update/'.$user->id)}}">
            {{csrf_field()}}
              <div class="box-body">
              	<div class="form-group">
                  <label for="id">ID</label>
                  <input name="id" type="text" class="form-control" id="id" placeholder="Nama" disabled value="{{$user->id}}">
                </div>
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input name="name" type="text" class="form-control" id="name" placeholder="Nama" value="{{$user->name}}">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input name="email" type="email" class="form-control" id="email" placeholder="email@email.com" value="{{$user->email}}">
                </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
     
    </section>
    <!-- /.content -->
@endsection