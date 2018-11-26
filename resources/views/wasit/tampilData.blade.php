@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
      		
      		@if(session('status'))
      		<div class="alert alert-{{session('status')}}">
      			{{session('message')}}
      		</div>
      		@endif


            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
              <td>
              	<a href="{{url('manajemenWasit')}}" class="btn btn-success btn-xs">
              		<i class=" fa fa-plus"></i> Tambah
              	</a>
              </td>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama Wasit</th>
                  <th>No Kartu Anggota</th>
                  <th>Cabang Olahraga</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Wasit as $val)
                <tr>
                  <td>{{ $val->nama_wasit}}</td>
                  <td>{{$val->no_kartu_anggota}}</td>
                  <td>{{$val->nama_cabor}}</td>
                  <td> 
                  	<button class="btn btn-warning btn-xs "> 
                  		<i class=" fa fa-eye"></i>view </button>
                  	<a href="{{url('wasit/'.$val->id_wasit.'/edit')}}" class="btn btn-primary btn-xs">
                  		<i class="fa fa-edit"> </i> edit </a>
                  	<button class="btn btn-danger btn-xs"> 
                  		<i class="fa fa-trash"></i>delete </button>
                  </td>
                </tr>
                @endforeach
                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection