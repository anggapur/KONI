@extends('layouts.app')
@section('content')
<!-- Main content -->
    <section class="content">
		 <div class="box box-primary">
		    <div class="box-header with-border">
		    	<h3 class="box-title">Tambah Data Kontingen</h3>
		    	<a href="{{ URL('/') }}" class="btn btn-success btn-sm"><i class="fa fa-plus" style="font-size: 11px"></i> Tambah Data</a>
		    	<div class="row">
		    		<div class="col-md-12">			    	
		            	<center><h2>Data Kontingen</h2></center>
		                <div class="tableWrapper">
		                    <table class="table" id="table-kontingen">
		                        <thead>
		                            <tr>
		                                <th>Jenis Umur</th>
		                               	<th>Rentang Umur</th>
		                                <th>Aksi</th>
		                            </tr>
		                        </thead>	                            
		                    </table>
		                </div>
		           	</div>
		    	</div>
		    </div>		  
		</div>
    </section>
    <!-- /.content -->
@endsection