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
                @for($i = 0; $i <= 7; $i ++)
                <div class="col-lg-3 col-md-6">
                    <div class="boxSummary">
                        <div class="separateLeft">
                            <div class="miniBoxForNumber">
                                <i class="fas fa-running"></i>
                            </div>
                        </div>
                        <div class="separateRight">
                            <h6>Atlet</h6>
                            <h5>1.000</h5>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>
    <!-- MAPS -->
    <section id="maps">
        <div class="container">
            <div class="row">
                <h2 class="titleSection">Sebaran Atlet</h2>
            </div>
            <div class="row">
                <div class="col-md-12">

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

                iterationSlider = (iterationSlider+1)%6;
                console.log(iterationSlider);
                $('.sliderImages').fadeOut();
                $('.sliderImages:nth-child('+iterationSlider+')').fadeIn();
            }, 3000);
        });
    </script>
@endsection