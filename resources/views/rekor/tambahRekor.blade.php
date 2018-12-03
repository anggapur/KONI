@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
    	<div class="box box-primary">
		    <div class="box-header with-border">		    	
		    	<h3 class="box-title">Tambah Data Rekor</h3></div>
		    	<div class="box-body">
		    	<form method="post" action="{{URL('/addRekor')}}">
		    		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		    		<div class="form-group">
		                <label>Keterangan Rekor</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-trophy"></i>
		                  </div>
		                  <input class="form-control" type="text" name="ket_rekor" required>
		                </div>		                
		             </div>
						
					<div class="form-group">
		                <label>Cabang Olahraga</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-code-branch"></i>
		                  </div>
		                  <select class="form-control" onchange="update_np(this.value)" name="cabor">
		                  	<option disabled selected hidden >Pilih cabang olahraga</option>
		                  	@foreach($cabor as $cabor):
		                  		<option value="{{$cabor->id_cabor}}">{{$cabor->nama_cabor}}</option>
		                  	@endforeach
		                  </select>
		                </div>		                
		             </div>

		             <div class="form-group">
		                <label>Nomor Pertandingan</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-cogs"></i>
		                  </div>
		                  <select id="np" class="form-control" onchange="update_atlet(this.value)" name="np">
		                  	<option disabled selected hidden >Pilih nomor pertandingan</option>
		                  	
		                  </select>
		                </div>		                
		             </div>

		             <div id="tambah-np" style="display: none;" class="form-group">
		             	<a target="_blank" href="{{url('/nomorPertandingan')}}"><button type="button" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah data nomor pertandingan </button></a>
		             </div>

		             <div class="form-group">
		                <label>Atlet</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-user"></i>
		                  </div>
		                  <select id="atlet" class="form-control" name="atlet">
		                  	<option disabled selected hidden >Pilih Atlet</option>
		                  </select>
		                </div>		                
		             </div>

		             <div id="tambah-atlet" style="display: none;" class="form-group">
		             	<a target="_blank" href=""></a><button type="button" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah data atlet </button>
		             </div>

		             <div class="form-group">
		                <label>Tingkat Event</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-code-branch"></i>
		                  </div>
		                  <select class="form-control" name="tingkat" onchange="update_event(this.value)">
		                  	<option disabled selected hidden >Pilih tingkat event</option>
		                  	@foreach($tingkat_event as $tevent):
		                  		<option value="{{$tevent->id_tingkat}}">{{$tevent->nama_tingkat}}</option>
		                  	@endforeach
		                  </select>
		                </div>		                
		             </div>

		             <div class="form-group">
		                <label>Event</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-code-branch"></i>
		                  </div>
		                  <select class="form-control" name="event" id="event">
		                  	<option disabled selected hidden >Pilih event</option>		                  	
		                  </select>
		                </div>		                
		             </div>

		             <div id="tambah-event" style="display: none;" class="form-group">
		             	<a target="_blank" href="{{url('tambahEvent')}}"><button type="button" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah data event </button></a>
		             </div>

		             <div class="form-group">
		                <label>Waktu</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-clock"></i>
		                  </div>
		                  <input type="text" class="form-control pull-right" id="datepicker" name="waktu">
		                </div>		                
		             </div>
		             

					<input id="submit" class="btn btn-primary" type="submit" name="submit" value="Simpan">	
					<input class="btn btn-warning" type="reset" name="reset" value="Reset">
		    	</form>
		    </div>
		</div>
    </section>

    <script>
    	function update_np(id){
    		$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

	      var dataString = "id="+id;

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
		            	var text = "<option disabled selected hidden >Pilih nomor pertandingan</option>";
		            	for(var i=0;i<data.length;i++){
		            		text += "<option value='"+data[i].id_np+"'> "+data[i].ket_np+" </option>";
		            		$('#tambah-np').hide();
		            	}
		            }else{
		            	text += "<option value='' hidden selected disabled> Tidak ada data Nomor Pertandingan pada Cabang Olahraga ini </option>";
		            	$('#tambah-np').show();
		            }
	            	$("#np").html(text);
	            	$('#atlet').html("<option disabled selected hidden >Pilih Atlet</option>");
	            	$('#tambah-atlet').hide();

				}
			});    		
    	}

    	function update_atlet(id){
    		$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

	      var dataString = "id="+id;

	      $.ajax({
	            type: "POST",
	            url: "{{URL('/getAtlet')}}",
	            data: {
	            	'id' : id,
	            	'_token' : '{{csrf_token()}}',
	            },
	            cache: false,
	            success: function(data){
	            	data = JSON.parse(data);
	            	console.log(data);
	            	if(data.length > 0){	            	
		            	var text = "<option disabled selected hidden >Pilih Atlet</option>";
		            	for(var i=0;i<data.length;i++){
		            		text += "<option value='"+data[i].id_atlet+"'> "+data[i].nama_atlet+" </option>";
		            		$('#tambah-atlet').hide();
		            	}
		            }else{
		            	text += "<option> Tidak ada atlet pada cabang olahraga dan nomor pertandingan ini</option>";
		            	$('#tambah-atlet').show();
		            }
	            	$("#atlet").html(text);
	            	
				}
			});    		
    	}

    	function update_event(id){
    		$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

	      var dataString = "id="+id;

	      $.ajax({
	            type: "POST",
	            url: "{{URL('/getEvent')}}",
	            data: {
	            	'id' : id,
	            	'_token' : '{{csrf_token()}}',
	            },
	            cache: false,
	            success: function(data){
	            	data = JSON.parse(data);
	            	console.log(data);
	            	if(data.length > 0){	            		
		            	var text = "<option disabled selected hidden >Pilih Event</option>";
		            	for(var i=0;i<data.length;i++){
		            		text += "<option value='"+data[i].id_event+"'> "+data[i].nama_event+" </option>";
		            		$('#tambah-event').hide();
		            	}
		            }
		            else{
		            	text += "<option value='' disabled selected hidden> Tidak ada data Event pada tingkat event ini</option>";
		            	$('#tambah-event').show();
		            }
	            	$("#event").html(text);
	            	
				}
			});	
    	}
    </script>

@endsection