@extends('layouts.frontApp')
@section('content')
    <section class="chartSection">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                     <div id="piechart_3d" class="chart"></div>
                </div>                
            </div>
        </div>      
    </section>

    <section class="chartSection2">
        <div class="container">
            <div class="row">   
                <div class="col-md-6">

                </div>             
                <div class="col-md-6">
                     <div id="piechart_3d_2" class="chart"></div>
                </div>  
            </div>
        </div>      
    </section>

   

    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          backgroundColor: 'transparent',
          title: '',
          is3D: true,
          // width:400,
          // height:300,
          chartArea: {'width': '100%', 'height': '80%','left':'0'},
               legend: {'position': 'bottom'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }

      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            // title: 'Company Performance',
            // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                backgroundColor: 'transparent',
              title: 'test',
              is3D: true,
          }
        };

        var chart = new google.charts.Bar(document.getElementById('piechart_3d_2'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

    </script>
@endsection