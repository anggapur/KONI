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
              <h3 class="box-title">Tambah Data Event</h3>           
              <a href="{{ URL('/tambahEvent') }}"><button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data</button></a>
            </div>
              <div class="box-body">

                      <!-- <center><h2>Data Nomor Pertandingan</h2></center> -->
                        <div class="tableWrapper">
                            <table class="table" id="table-np">
                                <thead>
                                    <tr>                      
                                        <th>Nama Event</th>
                                        <th>Tingkat</th>
                                        <th>Lokasi</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>                              
                            </table>
                        </div>

                    
                  </div>
            </div>
          </div>      
    </div>
     
    </section>
    <!-- Modal -->
    <div id="viewModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Data Event</h4>
          </div>
          <div class="modal-body">
            <table class="table">
              <tr>
                <td>Nama Event</td>
                <td> : </td>
                <td id="nama_event"></td>
              </tr>
              <tr>
                <td>Tingkat Event</td>
                <td> : </td>
                <td id="tingkat_event"></td>
              </tr>
              <tr>
                <td>Lokasi</td>
                <td> : </td>
                <td id="lokasi"></td>
              </tr>
              <tr>
                <td>Tanggal Mulai</td>
                <td> : </td>
                <td id="tgl_mulai"></td>
              </tr>
              <tr>
                <td>Tanggal Selesai</td>
                <td> : </td>
                <td id="tgl_selesai"></td>
              </tr>
            </table>

            <table class="table">
              <thead>
                <tr>
                  <td>No</td>
                  <td>Cabang Olahraga</td>
                  <td>Lama Pertandingan</td>
                  <td>Tanggal Pertandingan</td>
                  <td>Tempat Pertandingan</td>
                  <td>Jam/Waktu</td>
                </tr>
              </thead>
              <tbody id='detail-content'>
                
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->    

    <!-- Modal -->
  <div id="delModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Data</h4>
        </div>
        <div id="body-nama-event" class="modal-body">
          
        </div>
        <div id="hapus-button" class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>

    <script type="text/javascript">
      $(function() {
        var oTable = $('#table-np').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("data-eventPertandingan") }}'
            },
            columns: [           
            {data: 'nama_event', name: 'nama_event'},
            {data: 'nama_tingkat', name: 'nama_tingkat'},
            {data: 'lokasi', name: 'lokasi'},
            {data: 'tgl_mulai', name: 'tgl_mulai'},
            {data: 'tgl_selesai', name: 'tgl_selesai'},
            {data: 'aksi', name: 'aksi'},
        ],
        });
    });
  </script>
  <script type="text/javascript">
      function view(id){        
        $.ajax({
              type: "POST",
              url: "{{URL('/get-data-event')}}",
              data: {
                'id' : id,
                '_token' : '{{csrf_token()}}',
              },
              cache: false,
              success: function(data){
                data = JSON.parse(data);
                event = data.event;
                detail = data.detail;
                eksibisi = data.eksebisi;
                $('#nama_event').html(event.nama_event);
                $('#tingkat_event').html(event.nama_tingkat);
                $('#lokasi').html(event.lokasi);
                $('#tgl_mulai').html(event.tgl_mulai);
                $('#tgl_selesai').html(event.tgl_selesai);
                $('#detail-content').html("");
                for(var i=0;i<detail.length;i++){                  
                  $('#detail-content').append("<tr><td>"+(i+1)+"</td><td>"+detail[i].nama_cabor+"</td><td>"+detail[i].lama_pertandingan+" Hari</td><td>"+detail[i].tgl_mulai+" - "+detail[i].tgl_selesai+"</td><td>"+detail[i].tempat_pertandingan+"</td><td>"+detail[i].waktu_mulai+" s/d "+detail[i].waktu_selesai+"</td></tr>");                  
                }

                if(eksibisi.length > 0){
                   $('#detail-content').append("<tr><td style='text-align:center' colspan='6'>Cabang Eksibisi</td></tr>");
                  for(var i=0;i<eksibisi.length;i++){
                    $('#detail-content').append("<tr><td>"+(i+1)+"</td><td>"+eksibisi[i].nama_cabor+"</td><td>"+eksibisi[i].lama_pertandingan+" Hari</td><td>"+eksibisi[i].tgl_mulai+" - "+eksibisi[i].tgl_selesai+"</td><td>"+eksibisi[i].tempat_pertandingan+"</td><td>"+eksibisi[i].waktu_mulai+" s/d "+eksibisi[i].waktu_selesai+"</td></tr>");                  
                  }
                }

                $('#viewModal').modal({backdrop: 'static',keyboard: false});
              }
          });
        }
  </script>

  <script type="text/javascript">
    function del(nama,id){
    var url ="{{('hapusEvent')}}/";
      $('#body-nama-event').html("<p> Yakin menghapus data event "+nama+" ? </p>");
      $('#hapus-button').html("<a href='"+url+id+"'> <button type='button' class='btn btn-danger'>Hapus</button></a>");
      $('#delModal').modal('show');
    }
  </script>
@endsection