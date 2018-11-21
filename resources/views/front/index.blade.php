@extends('layouts.frontApp')
@section('content')
<!-- Slider -->
    <section id="slider">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="greetings">
                        <h1>Selamat Datang di Website Koni Badung</h1>
                        <p>Dapatkan Informasi Seputar Atlet Kabupaten Badung</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="sliderImage">
                        <img src="{{asset('public/upload/slider/slider1-img.png')}}" class="sliderImages">
                        <img src="{{asset('public/upload/slider/slider2-img.png')}}" class="sliderImages firstNone">
                        <img src="{{asset('public/upload/slider/slider3-img.png')}}" class="sliderImages firstNone">
                        <img src="{{asset('public/upload/slider/slider4-img.png')}}" class="sliderImages firstNone">
                        <img src="{{asset('public/upload/slider/slider5-img.png')}}" class="sliderImages firstNone">
                        <img src="{{asset('public/upload/slider/slider0-img.png')}}" class="sliderImages firstNone">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Summary Jumlah -->
    <section id="summary">
        <div class="container">
            <div class="row">
                <!-- Atlet -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="{{url('atlet')}}" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-running"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Atlet</h6>
                            <h5>{{GH::getCountData()['jml_atlet']}}</h5>
                        </div>
                    </div>
                </div>
                <!-- Wasit -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="{{url('wasit')}}" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-flag-checkered"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Wasit</h6>
                            <h5>{{GH::getCountData()['jml_wasit']}}</h5>
                        </div>
                    </div>
                </div>
               <!-- Pelatih -->
               <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="{{url('pelatih')}}" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-user-tie"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Pelatih</h6>
                            <h5>{{GH::getCountData()['jml_pelatih']}}</h5>
                        </div>
                    </div>
                </div>
                <!-- Jumlah Semua -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <div class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="separateRight">
                            <h6> Atlet, Wasit & Pelatih</h6>
                            <h5>{{GH::getCountData()['jml_atlet']+GH::getCountData()['jml_wasit']+GH::getCountData()['jml_pelatih']}}</h5>
                        </div>
                    </div>
                </div>
                <!-- Jumlah Cabang Olahraga -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="{{url('cabor')}}" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-code-branch"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Jumlah Cabang Olahraga</h6>
                            <h5>{{GH::getCountCabor()['jml_cabor']}}</h5>
                        </div>
                    </div>
                </div>
                <!-- Jumlah Event -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="{{url('event')}}" class="miniBoxForNumber wow fadeInUp">
                                <i class="far fa-calendar-alt"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Jumlah Event</h6>
                            <h5>{{GH::getCountEvent()['jml_event']}}</h5>
                        </div>
                    </div>
                </div>
               <!-- Jumlah Prestasi -->
               <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="{{url('prestasi-atlet')}}" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-trophy"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6>Prestasi</h6>
                            <h5>{{GH::getCountPrestasi()['jml_prestasi']}}</h5>
                        </div>
                    </div>
                </div>
                <!-- Rekor -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <a href="url('rekor')" class="miniBoxForNumber wow fadeInUp">
                                <i class="fas fa-medal"></i>
                            </a>
                        </div>
                        <div class="separateRight">
                            <h6> Rekor</h6>
                            <h5>{{GH::getCountRekor()['jml_rekor']}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MAPS -->
    <section id="maps">
        <div class="container">
            <div class="row">
                <h2 class="titleSection" style="padding-top: 50px;">Sebaran Atlet Berdasarkan Cabang Olahraga</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="piechart_3d_2" class="chart"></div>
                </div>
            </div>
        </div> 
    </section>

    <script type="text/javascript">
        iterationSlider = 1;
        $(document).ready(function(){
            $('.sliderImages').hide();
            $('.sliderImages:nth-child('+iterationSlider+')').fadeIn();
            setInterval(function(){ 

                iterationSlider = ((iterationSlider)%6)+1;
                console.log(iterationSlider);
                $('.sliderImages').fadeOut();
                $('.sliderImages:nth-child('+iterationSlider+')').fadeIn();
            }, 3000);
        });


        //caret ke 2
      var dataAjax;
      $.ajax({
        method : 'POST',
        data : {
          'name' :'getAtletByCabor',
          '_token' : '{{csrf_token()}}'
        },
        url : '{{url("getApiData")}}',
        success : function(data)
        { 
          dataAjax = data.data;
          dataAjax.unshift(['Cabang Olahraga',data.countAtlet+' atlet']);
        }

      })
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {
        var data = google.visualization.arrayToDataTable(dataAjax);

        var optionss = {
          chart: {
            // title: 'Company Performance',
            // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                backgroundColor: 'transparent',
              title: '',
              is3D: true,

          }
        };

        var chart = new google.charts.Bar(document.getElementById('piechart_3d_2'));

        chart.draw(data, google.charts.Bar.convertOptions(optionss));
      }
    </script>
@endsection