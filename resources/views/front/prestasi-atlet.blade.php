@extends('layouts.frontApp')
@section('content')
    <section class="chartSection">
        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-xl-12">
                  <h1 class="dataGrafikTitle">Prestasi Atlet</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                     <div id="piechart_3d" class="chart"></div>
                </div>         
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                  <h1 class="descRight">
                    <strong>Persentase Prestasi Atlet</strong> <br>Berdasarkan <br>Jenis Kelamin
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
                    <strong>Tingkat Prestasi Atlet</strong> <br>Berdasarkan <br> Cabang Olahraga
                  </h1>
                </div>
                          
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                     <div id="piechart_3d_2" class="chart"></div>
                </div>  
            </div>
             <div class="row">
                <div class="col-md-12">
                    <div class="tableWrapper">
                        <table class="table" id="table-atlet">
                            <thead>
                                <tr>
                                    <th>Prestasi</th>
                                    <th>Nama Atlet</th>
                                    <th>Cabang Olahraga</th>
                                    <th>Event</th>
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
          ['Laki - Laki',    {{GH::getPrestasiByGender()['laki-laki']}}],
          ['Perempuan',      {{GH::getPrestasiByGender()['perempuan']}}]
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
          'name' :'getPrestasiByCabor',
          '_token' : '{{csrf_token()}}'
        },
        url : '{{url("getApiData")}}',
        success : function(data)
        { 
          dataAjax = data.data;
          dataAjax.unshift(['Cabang Olahraga',data.sumAllData+' atlet']);
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
        var oTable = $('#table-atlet').DataTable({
           "ordering": false,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("data-prestasi") }}'
            },
            columns: [
            {data: 'ket_juara_medali', name: 'ket_juara_medali'},
            {data: 'nama_atlet', name: 'nama_atlet'},
            {data: 'nama_cabor', name: 'cabang_olahraga.nama_cabor'},
            {data: 'nama_event', name: 'nama_event'},
        ],
        });
    });
</script>


@endsection