@extends('layouts.frontApp')
@section('content')
    <section class="chartSection bgWhite" style="padding-top: 120px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="dataGrafikTitle" style="margin-bottom:100px;">{{$dataEvent->nama_event}}</h1>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="#divPelatih" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-trophy"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Jumlah Prestasi</h6>
                            <h5>{{$jumlahPrestasi}}</h5>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8 col-sm-12 col-lg-9" id="divAtlet">
                    <div class="tableWrapper tableDetailAtlet" style="margin-top: -30px;">
                        <h2 class="dataGrafikTitle" style="text-align: center;">Daftar Prestasi Atlet</h2>
                        <table id="table-prestasi" class="table">
                            <thead>
                                <tr>
                                    <th>Nama Prestasi</th>
                                    <th>Nama Atlet</th>
                                    <th>Cabang Olahraga</th>
                                    <th>Nomor Pertandingan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>  
                
            </div>
        </div>      
    </section>
    <script type="text/javascript">
        $(function() {
        var oTable = $('#table-prestasi').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("data-prestasi-di-event"."/".$dataEvent->id_event) }}'
            },
            columns: [
            {data: 'nama_prestasi', name: 'nama_prestasi'},
            {data: 'nama_atlet', name: 'nama_atlet'},
            {data: 'nama_cabor', name: 'nama_cabor'},
            {data: 'ket_np', name: 'ket_np'},
        ],
        });


    });
</script>

@endsection