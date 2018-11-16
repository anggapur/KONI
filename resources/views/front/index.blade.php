@extends('layouts.frontApp')
@section('content')
<!-- Slider -->
    <section id="slider">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
@endsection