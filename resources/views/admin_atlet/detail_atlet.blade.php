@extends('layouts.app')
@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Data Atlet {{$atlet->nama_atlet}} </h3>
				</div>
				<form role="form" method="POST" action="{{url('update_detail_atlet')}}">                
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$atlet->id_atlet}}">
					<div class="box-body">                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <td colspan="2">
                                        <h4>Event yang pernah di ikuti</h4>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>                                
                                <?php $i=0; ?>
                            @foreach($tingkat as $tevent)
                            <tr>
                                <td colspan="2">
                                <h4>Tingkat {{ $tevent->nama_tingkat }}</h4>
                                </td>
                            </tr>                                
                                @foreach($event[$tevent->id_tingkat] as $detail)
                                @if($detail->nama_event != null)
                                <tr>
                                    <td width="5%">
                                        <input type="hidden" name="id_event[]" value="{{$detail->id_event}}">
                                        <input id="status<?php echo $i; ?>" type="hidden" name="event[]" value="off"
                                        @if($detail['true']) disabled @endif
                                        >
                                        <label class="switch"><input type="checkbox" name="event[]" onchange="disable(this.checked,<?php echo $i; $i++; ?>)" 
                                        @if($detail['true']) checked @endif
                                            ><div class="slider round"></div></label>
                                    </td>
                                    <td>
                                        {{$detail->nama_event}}    
                                    </td>
                                </tr>
                                @endif           
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function disable(val,id){        
        if(val)
            $('#status'+id).prop('disabled',true);
        else
            $('#status'+id).prop('disabled',false);
    }
</script>
@endsection