@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
    	@if (session('status'))
              <div class="alert alert-{{session('status')}} alert-dismissible">
              	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {!! session('message') !!}
              </div>
          @endif
          @if ($errors->any())
              <div class="alert alert-danger alert-dismissible">
              	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{!! $error !!}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <!-- Rule -->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ketentuan</h3>
        </div>    
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Pilih Jenis Laporan</label>
                <select class="form-control" id="jenisLaporan">
                  <option value="pilhJenisLaporan">--Pilih Jenis Laporan--</option>
                  <option value="dataListAtlet">List Data Atlet</option>
                  <option value="dataPrestasi">Data Prestasi</option>
                  <option value="dataAtlet">Detail Atlet</option>
                </select>
              </div>
            </div>
          </div>
          <!-- LIST DATA ATLE -->
          <form id="dataListAtlet" style="display: none;">
            {{csrf_field()}}
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Cabang Olahraga</label><br>
                <select class="select2" required="required" name="id_cabor">
                  <option value="">--Pilih Cabor--</option>
                  @foreach($cabor as $val)
                    <option value="{{$val->id_cabor}}">{{$val->nama_cabor}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jenis Kelamin</label><br>
                <select class="select2" name="jenis_kelamin">
                  <option value="S">Semua</option>
                  <option value="L">Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-success"><i class="fa fa-file"></i>  Cetak Laporan</button>
              </div>  
            </div>
          </div>
          </form>
          <!-- END LIST DATA ATLET -->

          <!-- LIST DATA Prestasi -->
          <form id="dataPrestasi" style="display: none;">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Cabang Olahraga</label>
                <select class="select2" required="required">
                  <option value="">--Pilih Cabor--</option>
                  @foreach($cabor as $val)
                    <option value="{{$val->id_cabor}}">{{$val->nama_cabor}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Nomor Pertandingan</label>
                <select class="select2">
                  @foreach($nomorPertandingan as $val)
                    <option value="{{$val->id_np}}" data-cabor="{{$val->cabor_id}}">{{$val->ket_np}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="select2">
                  <option value="S">Semua</option>
                  <option value="L">Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-success"><i class="fa fa-file"></i>  Cetak Laporan</button>
              </div>  
            </div>
          </div>
          </form>
          <!-- END LIST DATA PRESTASI -->

          <!-- Detail Data Atlet -->
          <form id="dataAtlet" style="display: none;">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Cabang Olahraga</label>
                <select class="select2" required="required">
                  <option value="">--Pilih Cabor--</option>
                  @foreach($cabor as $val)
                    <option value="{{$val->id_cabor}}">{{$val->nama_cabor}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Atlet</label>
                <select class="select2">
                  @foreach($atlet as $val)
                    <option value="{{$val->id_atlet}}" data-cabor="{{$val->cabor_id}}">{{$val->nama_atlet}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-success"><i class="fa fa-file"></i>  Cetak Laporan</button>
              </div>  
            </div>
          </div>
          </form>
          <!-- Detail Data Atlet -->
        </div>  
    </div>
    <!-- Hasil -->
		 <div class="box box-primary">
		    <div class="box-header with-border">
		    	<h3 class="box-title">Laporan</h3>
		    </div>		
		    <div class="box-body">
          <table id="tableData" class="table table-bordered">
            <thead>
              <tr>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table> 
		    </div>  
		</div>
    </section>
   
   <script type="text/javascript">
     $(document).ready(function(){
      
      //tombol jenis laporan
      $('#jenisLaporan').change(function(){
        nilai = $(this).val();
        $('form').fadeOut(0);
        $('form#'+nilai).fadeIn("slow");
      });
      //Form dataListAtlet
      $('form#dataListAtlet').submit(function(e){
        e.preventDefault();
        dataForm = $(this).serializeArray();
        console.log(dataForm);
        $.ajax({
          method : 'POST',
          url : '{{route("laporanListDataAtlet")}}',
          data : dataForm,
          success : function(data){
            $('#tableData').DataTable().clear();
            $('#tableData').DataTable().destroy();
            $('#tableData tbody, #tableData thead').empty();
            colom = ["no_kartu_tanda_anggota","nama_atlet","jenis_kelamin",""];
            //head
            thead = "<tr>";
            $.each(colom,function(k,v){
              thead+="<th>"+v+"</th>";
            });
            thead+= "</tr>";
             $('#tableData thead').append(thead);
             //body
             tr="";
            $.each(data,function(k,v){
              tr+= "<tr>"+
                    "<td>"+v.no_kartu_tanda_anggota+"</td>"+
                    "<td>"+v.nama_atlet+"</td>"+
                    "<td>"+v.jenis_kelamin+"</td>"+
                    "<td></td>"+
                    "</tr>";                           
            });
            $('#tableData tbody').append(tr); 
            $('#tableData').DataTable();
          }
        }); 
      });

      
     });
   </script>
@endsection