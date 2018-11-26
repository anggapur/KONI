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

		             <div class="form-group">
		                <label>Event</label>
		                <div class="input-group date">
		                  <div class="input-group-addon">
		                    <i class="fa fa-code-branch"></i>
		                  </div>
		                  <select class="form-control" name="event">
		                  	<option disabled selected hidden >Pilih event</option>
		                  	@foreach($event as $event):
		                  		<option value="{{$event->id_event}}">{{$event->nama_event}}</option>
		                  	@endforeach
		                  </select>
		                </div>		                
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
	            	
	            	var text = "<option disabled selected hidden >Pilih nomor pertandingan</option>";
	            	for(var i=0;i<data.length;i++){
	            		text += "<option value='"+data[i].id_np+"'> "+data[i].ket_np+" </option>";
	            	}
	            	$("#np").html(text);
	            	$('#atlet').html("<option disabled selected hidden >Pilih Atlet</option>");
	            	
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
	            	var text = "<option disabled selected hidden >Pilih Atlet</option>";
	            	for(var i=0;i<data.length;i++){
	            		text += "<option value='"+data[i].id_atlet+"'> "+data[i].nama_atlet+" </option>";
	            	}
	            	$("#atlet").html(text);
	            	
				}
			});    		
    	}
    </script>

@endsection