@extends('layouts.frontApp')
@section('content')
    <section class="chartSection bgWhite" style="padding-top: 120px;">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h1 class="dataGrafikTitle" style="margin-bottom:100px;">{{$dataCabor->nama_cabor}}</h1>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="#divAtlet" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-running"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Jumlah Atlet</h6>
                            <h5>{{$dataAtlet}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="#divPelatih" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-user-tie"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Jumlah Pelatih</h6>
                            <h5>{{$dataPelatih}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="#divWasit" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-flag-checkered"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Jumlah Wasit</h6>
                            <h5>{{$dataWasit}}</h5>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="#divNP" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-code-branch"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Jumlah Nomor Pertandingan</h6>
                            <h5>{{$dataNP}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="divAtlet">
                    <div class="tableWrapper tableDetailAtlet">
                        <h2 class="dataGrafikTitle" style="text-align: center;">Daftar Atlet</h2>
                        <table id="table-atlet" class="table">
                            <thead>
                                <tr>
                                    <th>Kartu Tanda Anggota</th>
                                    <th>Nama Atlet</th>
                                    <th>Umur</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>  
                <!--Pelatih  -->
                 <div class="col-md-12" id="divPelatih" style="margin-top: 50px;">
                    <div class="tableWrapper tableDetailAtlet">
                        <h2 class="dataGrafikTitle" style="text-align: center;">Daftar Pelatih</h2>
                        <table id="table-pelatih" class="table">
                            <thead>
                                <tr>
                                    <th>Kartu Tanda Anggota</th>
                                    <th>Nama Pelatih</th>
                                    <th>Umur</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> 
                <!-- Wasit -->
                <div class="col-md-12" id="divWasit" style="margin-top: 50px;">
                    <div class="tableWrapper tableDetailAtlet">
                        <h2 class="dataGrafikTitle" style="text-align: center;">Daftar Wasit</h2>
                        <table id="table-wasit" class="table">
                            <thead>
                                <tr>
                                    <th>Kartu Tanda Anggota</th>
                                    <th>Nama Wasit</th>
                                    <th>Umur</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> 
                <!-- Nomor Pertandingan -->
                <div class="col-md-12" id="divNP" style="margin-top: 50px;">
                    <div class="tableWrapper tableDetailAtlet">
                        <h2 class="dataGrafikTitle" style="text-align: center;">Daftar Nomor Pertandingan</h2>
                        <table id="table-np" class="table">
                            <thead>
                                <tr>
                                    <th>Nama </th>
                                    <th>Prestasi</th>
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
        var oTable = $('#table-atlet').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("data-atlet-di-cabor"."/".$dataCabor->id_cabor) }}'
            },
            columns: [
            {data: 'no_kartu_tanda_anggota', name: 'no_kartu_tanda_anggota'},
            {data: 'nama_atlet', name: 'nama_atlet'},
            {data: 'age', name: 'age'},
        ],
        });


        var oTable = $('#table-pelatih').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("data-pelatih-di-cabor"."/".$dataCabor->id_cabor) }}'
            },
            columns: [
            {data: 'no_kartu_tanda_anggota', name: 'no_kartu_tanda_anggota'},
            {data: 'nama_kontingen', name: 'nama_kontingen'},
            {data: 'age', name: 'age'},
        ],
        });

        var oTable = $('#table-wasit').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("data-wasit-di-cabor"."/".$dataCabor->id_cabor) }}'
            },
            columns: [
            {data: 'no_kartu_anggota', name: 'no_kartu_anggota'},
            {data: 'nama_wasit', name: 'nama_wasit'},
            {data: 'age', name: 'age'},
        ],
        });

        var oTable = $('#table-np').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("data-np-di-cabor"."/".$dataCabor->id_cabor) }}'
            },
            columns: [
            {data: 'ket_np', name: 'ket_np'},
            {data: 'jml_prestasi', name: 'jml_prestasi'},
        ],
        });
    });
</script>

@endsection