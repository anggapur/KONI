@extends('layouts.frontApp')
@section('content')
    <section class="chartSection">
        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-xl-12">
                  <h1 class="dataGrafikTitle">Wasit</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                     <div id="piechart_3d" class="chart"></div>
                     @if(GH::getCountGender('wasit')['laki-laki'] == 0 && GH::getCountGender('wasit')['perempuan'] == 0)
                      <div style="
                        top: 50%;
    position: absolute;
    text-align: center;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
                      " >
                        Data Wasit Masih Kosong
                      </div>
                     @endif
                </div>         
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                  <h1 class="descRight">
                    <strong>Persentase Wasit</strong> <br>Berdasarkan <br>Jenis Kelamin
                  </h1>
                </div>       
            </div>
        </div>      
    </section>

    <section class="chartSection2">
        <div class="container">
            <div class="row justify-content-lg-center">   
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                  <h1 class="descLeft">
                    <strong>Persentase Wasit</strong> <br>Berdasarkan <br>Cabang Olahraga
                  </h1>
                </div>
                          
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                     <div id="piechart_3d_2" class="chart"></div>
                </div>  
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="tableWrapper">
                  <table class="table" id="table-wasit">
                    <thead>
                        <tr>
                            <th>Nama Wasit</th>
                            <th>Cabang Olahraga</th>
                        </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>  
        </div>      
    </section>

   

    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
      });

      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Jenis Kelamin', 'Jumlah'],
          ['Laki - Laki',    {{GH::getCountGender('wasit')['laki-laki']}}],
          ['Perempuan',      {{GH::getCountGender('wasit')['perempuan']}}]
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

      //caret ke 2
      var dataAjax;
      $.ajax({
        method : 'POST',
        data : {
          'name' :'getWasitByCabor',
          '_token' : '{{csrf_token()}}'
        },
        url : '{{url("getApiData")}}',
        success : function(data)
        { 
          dataAjax = data.data;
          dataAjax.unshift(['Cabang Olahraga',data.sumAllData+' wasit']);
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

    <script type="text/javascript">
        $(function() {
            var oTable = $('#table-wasit').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url("data-wasit-luar") }}'
                },
                columns: [
                {data: 'nama_wasit', name: 'nama_wasit'},
                {data: 'nama_cabor', name: 'nama_cabor'},
            ],
            });
        });
    </script>
@endsection