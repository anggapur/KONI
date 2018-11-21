@extends('layouts.frontApp')
@section('content')
    <section class="chartSection bgWhite" style="padding-top: 120px;">
        <div class="container">
           <!--  <div class="row">
                <div class="col-md-12">
                    <h1 class="dataGrafikTitle">Detail Atlet</h1>
                </div>
            </div> -->
            <div class="row ">
                
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="cardAtlet cardDetailAtlet">
                        <div class="photoAtlet">
                             @php
                                $namaFoto = GH::getImages(asset('public/upload/fotoAtlet'),$dataAtlet->nama_foto);
                                list($width, $height) = getimagesize($namaFoto);
                                if($width < $height)
                                   $className = "stretchWidth"; 
                                else
                                    $className = "stretchHeight"; 
                            @endphp 
                            <img src="{{asset('public/upload/fotoAtlet/'.$dataAtlet->nama_foto)}}" class="{{$className}}  detailAtlet" title="Foto Atlet {{$dataAtlet->nama_atlet}}">
                        </div>
                    </div>
                    <h1 class="titleDetailAtlet">{{$dataAtlet->nama_atlet}}</h1>
                    <h2 class="titleDetailAtlet">{{$dataAtlet->no_kartu_tanda_anggota}}</h2>
                    <h2 class="titleDetailAtlet">{{$dataAtlet->nama_cabor}}</h2>
                </div>         
                <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12">
                    <h1 class="titleDetailAtlet titleDaftarPrestasi">Daftar Prestasi</h1>
                     <div class="tableWrapper tableDetailAtlet">
                        <table class="table" id="table-atlet">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Prestasi</th>
                                    <th>Nomor Pertandingan</th>
                                    <th>Event</th>
                                    <th>Lokasi Event</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataAtlet->getPrestasi as $key => $val)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$val->nama_prestasi}}</td>
                                    <td>{{$val->ket_np}}</td>
                                    <td>{{$val->nama_event}}</td>
                                    <td>{{$val->lokasi}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>       
            </div>
        </div>      
    </section>
    <script type="text/javascript">
    $(function() {
        var oTable = $('#table-atlet').DataTable({
             "bLengthChange": false,
        });
    });
</script>

@endsection