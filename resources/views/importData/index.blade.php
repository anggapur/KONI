@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
      
     @if(session('status'))
      @if(session('countInsert') != 0)
    	<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('countInsert')}} Data Berhasil di Insert
      </div>
      @endif
      @if(session('countUpdate') != 0)
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('countUpdate')}} Data Berhasil di Update
      </div>
      @endif
      @if(session('message') != "")
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {!!session('message')!!} 
      </div>
      @endif
     @endif
     
		 <div class="box box-primary">
		    <div class="box-header with-border">
		    	<h3 class="box-title">Import Data</h3>
		    </div>		
		    <div class="box-body">
          <div class="row">
            <form method="POST" enctype="multipart/form-data" action="{{route('importData.store')}}">
              {{csrf_field()}}
              <div class="col-md-3">
                <div class="form-group">
                  <label>Pilih Jenis Data</label>
                  <select class="form-control" name="jenis_data">
                    <option value="atlet">Atlet</option>
                    <option value="pelatih">Pelatih</option>
                    <option value="wasit">Wasit</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Import Data Excel</label>
                  <input type="file" name="file_data" class="form-control" required="required">
                </div>
              </div>
               <div class="col-md-3">
                <div class="form-group">
                  <label>Baris Awal</label>
                  <input type="number" name="baris_awal" min="0" class="form-control"  value="-">
                </div>
              </div>
               <div class="col-md-3">
                <div class="form-group">
                  <label>Baris Akhir</label>
                  <input type="number" name="baris_akhir" min="0" class="form-control"  value="-">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group" style="padding-top: 24px;">
                  <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Import</button>
                  <button type="reset" class="btn btn-default"> <i class="fa fa-ban"></i> Cancel</button>
                </div>
              </div>
              <div class="col-md-12">
                <a id="link" href="{{asset('public/excel/impor_atlet.xlsx')}}" target="_blank" style="cursor: pointer;"><i class="fa fa-download"></i> Download Format File Import <b style="text-transform: capitalize;">Atlet</b> </a>
              </div>
            </form>
          </div>
		    </div>  
		</div>
    </section>
    <script type="text/javascript">
      $(document).ready(function(){
        $('select[name="jenis_data"]').change(function(){
          nama = $(this).val();
          $('#link b').html(nama);
          link = "{{asset('public/excel')}}";
          $('#link').attr('href',link+'/impor_'+nama+'.xlsx');
        });
      });
    </script>
@endsection