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
                <select class="form-control select2" id="jenisLaporan">
                 <option></option>
                  <option value="dataListAtlet">List Data Atlet</option>
                  <option value="rekapJumlahAtlet">Rekap Jumlah Atlet</option>
                  <option value="listDataPrestasi">List Data Prestasi</option>
                  <!-- <option value="dataAtlet">Detail Atlet</option> -->
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
                <select class="select2" required="required" name="id_cabor" onchange="update_np(this.value)">
                  <option value="">--Pilih Cabor--</option>
                    <option value='0'>Semua Cabor</option>
                  @foreach($cabor as $val)
                    <option value="{{$val->id_cabor}}">{{$val->nama_cabor}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Nomor Pertandingan</label>
                <select id="np" class="select2" name="id_np">
                  <option value="" selected>--Pilih Cabor dulu--</option>
                </select>
              </div>
            </div>            
            <div class="col-md-3">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="select2" name="jenis_kelamin">
                  <option value="S">Semua</option>
                  <option value="L">Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 parentCheckbox">
              <label>Pilih Kolom</label>
               <div class="checkbox">
                <label>
                  <input type="checkbox" class="allCheckbox"> <b>Semua Kolom</b>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[no_kartu_tanda_anggota]" value="No Kartu Tanda Anggota"> No Kartu Tanda Anggota
                </label>
              </div>
               <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[nama_atlet]" value="Nama Atlet"> Nama Atlet
                </label>
              </div>
               <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[jenis_kelamin]" value="Jenis Kelamin"> Jenis Kelamin
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[tempat_lahir]" value="Tempat Lahir"> Tempat Lahir
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[tgl_lahir]" value="Tanggal Lahir"> Tanggal Lahir
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[alamat]" value="Alamat"> Alamat
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[tinggi]" value="Tinggi"> Tinggi
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[berat]" value="Berat"> Berat
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[tgl_jadi_atlet]" value="Tanggal Jadi Atlet"> Tanggal Jadi Atlet
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[tgl_pensiun]" value="Tanggal Pensiun"> Tanggal Pensiun
                </label>
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
          <!-- Rekap Jumlah Atlet -->
          <form id="rekapJumlahAtlet" style="display: none;">
            {{csrf_field()}}
          <div class="row">
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
            <div class="col-md-12 parentCheckbox">
              <label>Pilih Cabor</label>
               <div class="checkbox">
                <label>
                  <input type="checkbox" class="allCheckbox"> <b>Semua Cabor</b>
                </label>
              </div>
              @foreach($cabor as $val)
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="colom[{{$val->id_cabor}}]" value="{{$val->nama_cabor}}"> {{$val->nama_cabor}}
                </label>
              </div>
              @endforeach
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-success"><i class="fa fa-file"></i>  Cetak Laporan</button>
              </div>  
            </div>            
          </div>
          </form>
          <!-- ENDRekap Jumlah Atlet -->
          <!-- LIST DATA Prestasi -->
          <form id="listDataPrestasi" style="display: none;">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Event</label>
                <select class="select2" id="selectEvent" name="event_id">
                  <option></option>
                  <option value="0">Semua Event</option>
                  @foreach($event as $val)
                    <option value="{{$val->id_event}}" data-cabor="{{$val->cabor_id}}">{{$val->nama_event}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Cabang Olahraga</label>
                <select class="select2 caborByEvent" name="cabor_id" onchange="update_np(this.value)">
                  <option></option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Nomor Pertandingan</label>
                <select class="select2" name="np_id" id="np2">
                  <option></option>
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
         <!--  <form id="dataAtlet" style="display: none;">
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
          </form> -->
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
              <tr style="display: none">
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
            clearTable();
            colom = ["no_kartu_tanda_anggota","nama_atlet","jenis_kelamin"];
            //head
            thead = "<tr>";
            $.each(data.colomShow,function(k,v){
              thead+="<th>"+v+"</th>";
            });
            thead+= "</tr>";
             $('#tableData thead').append(thead);
             //body
             tr="";
            $.each(data.content,function(k,v){
              tr+= "<tr>";
                $.each(data.colomSelect,function(i,n){
                  tr+="<td>"+((v[n] == null) ? "-" : v[n])+"</td>";
                });
              tr+="</tr>";                           
            });
            $('#tableData tbody').append(tr); 
           initTable();
          }
        }); 
      });
      // End Form dataListAtlet
      // Rekap Data Jumlah Atlet
      $('form#rekapJumlahAtlet').submit(function(e){
        e.preventDefault();
        dataForm = $(this).serializeArray();
        console.log(dataForm);
        $.ajax({
          method : 'POST',
          url : '{{route("laporanRekapJumlahAtlet")}}',
          data : dataForm,
          success : function(data){
            clearTable();
            //head
            thead = "<tr>";
            $.each(data.colomShow,function(k,v){
              thead+="<th>"+v+"</th>";
            });
            thead+= "</tr>";
             $('#tableData thead').append(thead);
             //body
             tr="";
            $.each(data.content,function(k,v){
              tr+= "<tr>";
                $.each(data.colomSelect,function(i,n){
                  tr+="<td>"+v[n]+"</td>";
                });
              tr+="</tr>";                           
            });
            $('#tableData tbody').append(tr); 
            initTable();
          }
        }); 
      });
      // End Rekap Data Jumlah Atlet

      //Start Rekap Data Prestasi
      $('form#listDataPrestasi').submit(function(e){
        e.preventDefault();
        dataForm = $(this).serializeArray();
        console.log(dataForm);
        $.ajax({
          method : 'POST',
          url : '{{route("laporanListDataPrestasi")}}',
          data : dataForm,
          success : function(data){
            clearTable();
            //head
            thead = "<tr>";
            $.each(data.colomShow,function(k,v){
              thead+="<th>"+v+"</th>";
            });
            thead+= "</tr>";
             $('#tableData thead').append(thead);
             //body
             tr="";
            $.each(data.content,function(k,v){
              tr+= "<tr>";
                $.each(data.colomSelect,function(i,n){
                  tr+="<td>"+v[n]+"</td>";
                });
              tr+="</tr>";                           
            });
            $('#tableData tbody').append(tr); 
            initTable();
          }
        }); 
      });


      // Checkbox control
      $('.allCheckbox').click(function(){
        // $('form#rekapJumlahAtlet input[type="checkbox"]').prop('checked', this.checked)
        $(this).parents('.parentCheckbox').find('input[type="checkbox"]').prop('checked', this.checked);;
      });

        
         $('#selectEvent').on('change',function(e){
          id_event = $(this).val();
          $.ajax({
            method : 'POST',
            url :'{{url("administrator/api/tags")}}',
            data : {
              'id_event' : id_event,
              '_token' : '{{csrf_token()}}'
            },
            success : function(datas){
              console.log(datas);
              $('.caborByEvent').empty().trigger('change').select2({                
                data : datas,
               });
            }
          });
         });


     });



  function clearTable()
  {
    $('#tableData').DataTable().clear();
    $('#tableData').DataTable().destroy();
    $('#tableData tbody, #tableData thead').empty();
  }
  function initTable()
  {
    $('#tableData').DataTable();
  }

  function update_np(id){
        $.ajax({
              type: "POST",
              url: "{{URL('/getNP')}}",
              data: {
                'id' : id,
                '_token' : '{{csrf_token()}}',
              },
              cache: false,
              success: function(data){
                data = JSON.parse(data);
                
                if(data.length > 0){
                  var text = "<option value='0'>Semua</option>";
                  for(var i=0;i<data.length;i++){
                    text += "<option value='"+data[i].id_np+"'> "+data[i].ket_np+" </option>";
                    $('#tambah-np').hide();
                  }
                }
                else{
                  text += "<option value='' hidden selected disabled> Tidak ada data Nomor Pertandingan pada Cabang Olahraga ini </option>";
                  $('#tambah-np').show();
                }
                $("#np").html(text);
                $("#np2").html(text);
                
        }
      });       
      }
  </script>
  
@endsection