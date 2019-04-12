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
		 <div class="box box-primary">
      <div class="box-header with-border">
          <div class="box-title"> Setting</div>
          <a href="{{route('setting.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Data Setting</a>
        </div>
		    <div class="box-body">
            <table class="table" id="table-jenisumur">
                <thead>
                    <tr>
                        <th>Setting</th>
                       	<th>Value</th>
                        <th>Aksi</th>
                    </tr>
                </thead>	                            
            </table>
		    </div>  
		</div>
    </section>        

     <script type="text/javascript">
	    $(function() {
        var oTable = $('#table-jenisumur').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("settingData") }}'
            },
            columns: [
            {data: 'deskripsi', name: 'deskripsi'},
            {data: 'value', name: 'value'},
            {data: 'aksi',},
        ],
        });
    });
	</script>
@endsection