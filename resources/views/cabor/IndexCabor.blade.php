@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
      @if(session('status'))        
          <div class="alert alert-{{session('status')}} alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {!! session('message') !!}
          </div>
      @endif
      <div class="row">
          <div class="col-xs-12">       
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Cabang Olahraga</h3>            
              <a href="{{ URL('/tambahCabor') }}"><button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</button></a>
            </div>
              <div class="box-body">

                      <!-- <center><h2>Data Kontingen</h2></center> -->
                        <div class="tableWrapper">
                            <table class="table" id="table-cabor">
                                <thead>
                                    <tr>
                                        <th>Nama Cabang Olahraga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>                              
                            </table>
                        </div>
                  </div>
            </div>
          </div>      
    </div>

    <!-- Modal -->
    <div id="delModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Hapus Data</h4>
          </div>
          <div id="body-nama-cabor" class="modal-body">
            
          </div>
          <div id="hapus-button" class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>
    </section>

        <script type="text/javascript">
      $(function() {
        var oTable = $('#table-cabor').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("/data-cabor") }}'
            },
            columns: [
            {data: 'nama_cabor', name: 'nama_cabor'},
            {data: 'aksi', name: 'aksi'},
        ],
        });
    });
  </script>
    <script type="text/javascript">
    function hapus(nama_cabor,id_cabor){
      var url = "{{url('delete-data-cabor')}}/";
      $('#body-nama-cabor').html("<p> Yakin menghapus data "+nama_cabor+" ? </p>");
      $('#hapus-button').html("<a href='"+url+id_cabor+"'><button type='button' class='btn btn-danger' onclick='del("+id_cabor+")'>Hapus</button></a>");
      $('#delModal').modal('show');
    }
  </script>    
    <!-- /.content -->
@endsection