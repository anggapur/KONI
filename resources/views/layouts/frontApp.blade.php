<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/front/css/style.css')}}">
    <!-- FonT Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- FOnt -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,900,900i" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

     <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">KONI BADUNG</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('')}}">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('atlet')}}">Atlet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('prestasi-atlet')}}">Prestasi Atlet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('pelatih')}}">Pelatih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('wasit')}}">Wasit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('event')}}">Event</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <!-- Prestasi Atlet -->
    <section id="prestasiTerbaru">
        <div class="container">
            <div class="row">
                <h2 class="titleSection">Prestasi Terbaru</h2>
            </div>
            <div class="row">
                @for($i = 0; $i <= 3; $i ++)
                <div class="col-lg-3 col-md-6">
                    <div class="cardAtlet">
                        <div class="photoAtlet">
                             @php
                                list($width, $height) = getimagesize(url('public/upload/fotoAtlet/atletSilat.jpg'));
                                if($width < $height)
                                   $className = "stretchWidth"; 
                                else
                                    $className = "stretchHeight"; 
                            @endphp 
                            <img src="{{asset('public/upload/fotoAtlet/atletSilat.jpg')}}" class="{{$className}}">
                        </div>
                        <div class="keteranganAtlet">
                            <h5>Taufik Hidayat</h5>
                            <h6>Bulutangkis</h6>
                        </div>
                        <div class="keteranganHidden">
                            <div>
                                <p>Juara 1 POMNAS</p>
                                <h5>Taufik Hidayat</h5>
                                <h6>Bulutangkis</h6>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-lg-3 col-md-6">
                    <div class="cardAtlet">
                        <div class="photoAtlet">
                             @php
                                list($width, $height) = getimagesize(url('public/upload/fotoAtlet/evanDimas.jpg'));
                                if($width < $height)
                                   $className = "stretchWidth"; 
                                else
                                    $className = "stretchHeight"; 
                            @endphp 
                            <img src="{{asset('public/upload/fotoAtlet/evanDimas.jpg')}}" class="{{$className}}">
                        </div>
                        <div class="keteranganAtlet">
                            <h5>Taufik Hidayat</h5>
                            <h6>Bulutangkis</h6>
                        </div>
                        <div class="keteranganHidden">
                            <div>
                                <p>Juara 1 POMNAS</p>
                                <h5>Taufik Hidayat</h5>
                                <h6>Bulutangkis</h6>
                            </div>
                        </div>
                    </div>
                </div> 
                @endfor 
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1>KONI <br><b>BADUNG</b></h1>
                </div>
                <div class="col-md-4">
                    <h4>Page</h4>
                    <ul id="listPage">
                        <li><a href="">Beranda</a></li>
                        <li><a href="">Atlet</a></li>
                        <li><a href="">Wasit</a></li>
                        <li><a href="">Pelatih</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Lokasi</h4>
                    <ul id="location">
                        <li><i class="far fa-building"></i> Jalan Puspem Badung</li>
                        <li><i class="fas fa-phone"></i> 0361 423423</li>
                        <li><i class="far fa-envelope-open"></i> koni_badung@gmail.com</li>
                    </ul>   
                </div>
            </div>  
            <div class="row">

            </div>
        </div>
    </footer>
    <section id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; Koni Badung - 2018
                </div>
            </div>
        </div>
    </section>
    <!-- JS -->
   
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>