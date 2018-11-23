@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">

      @if(session('status')=='0')
        <div class="alert alert-success">Sudah Benar Mas!</div>
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
        <div class="alert alert-danger alert-dismissible">Ga Ada Koneksi Internet Mas')</div>
      @endif
    
    @if(session('status')=='5')
        <div class="alert alert-success">Berhasil Diedit Mas</div>
      @endif

      @if(session('status')=='6')
        <script>alert('DC Ada Mas')</script>
      @endif  

      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabel" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Aksi</th>
                  <!-- link bisa, url = link ,route = name, asset = file -->
                  <a href="{{route('admin')}}" class="create-modal btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-plus"></i>Tambah Data
                  </a>
                </tr>
                <br>
                <br>
            {{ csrf_field() }}
            <?php $no=1; ?>
            @foreach($tampil as $value)
              <tr class="post{{$value->id}}">
                <td>{{ $no++ }}</td>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->updated_at }}</td>
                <td>
                  <a href="{{url('/admin/'.$value->id)}}" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-title="{{$value->title}}" data-body="{{$value->body}}">
                    <i class="glyphicon glyphicon-pencil"></i>Edit
                  </a>
                  <a href="{{url('/admin/hapus/'.$value->id)}}" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" type="submit">
                    <i class="glyphicon glyphicon-trash"></i>Hapus
                  </a>  
                </td>
              </tr>
            @endforeach
                </thead>
              </table>
            </div>
            <!-- /.box-body --> 
            <script>
             $(document).on('click','.delete-modal',function(e){
              var id = $(this).val();
              if(confirm("Anda Yakin Mau Hapus Mas ?"))
              {
                $.ajax({

                })
              }
              else
              {
                alert('Batal Hapus Mas?');
                return false;
              }
             })
            </script>
    </section>
    <!-- /.content -->
@endsection