@extends('master')
@section('content')
	
	<!-- {{ dump($dataproviders) }} -->
	<div class="container my-4">
			<a class="btn btn-primary btn-lg float-start" href="{{ route('main/index') }}">Kembali</a>
			<h1 class="text-center">Detail Provider <b>{{ $provider->nama_provider }}</b></h1>
			<hr>
		    @if (session()->has('pesan'))
		        <div class="alert alert-success text-center">
		            {{ session()->get('pesan') }}
		            <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
		        </div>
		    @endif
		    <!-- Content here -->
		        	
		        		<div class="col-md-12 text-center mb-4">
		        			<img src="{{ asset('storage/'.$provider->file) }}" class="img-fluid" alt="{{ $provider->nama_provider }}" style="height: 400px;">
		        		</div>
		        	<div class="row">
		        		@php
		        			$nomor=1;
		        		@endphp
		        		@forelse ($dataproviders as $dataprovider)
		        		<div class="col-lg-4 col-md-6 col-s-12 mb-4">
		        			<div class="card p-2 mx-4">
		        			  <div class="card-header">
		        			    <div class="float-start fs-5">Jenis Paket Provider | &nbsp;</div>
		        			    <div class="float-start fw-bold fs-5">{{ $dataprovider->nama_paket }}</div>
		        			  </div>
		        			  <div class="card-body">
		        			    <h5 class="card-title text-center bg-primary py-3 rounded">Paket {{ $nomor++ }}</h5>
		        			    <p class="card-text">
		        			    	<dl>
		        			    	  <dt>Harga Paket</dt>
		        			    	  <dd>{{ $dataprovider->harga }}</dd>
		        			    	  <dt>Kecepatan Provider Paket</dt>
		        			    	  <dd>{{ $dataprovider->kecepatan }} Mbps</dd>
		        			    	</dl>
		        			    </p>
		        			  </div>
		        			  <div class="card-footer text-center text-muted">
		        			  		<div class="row">
		        			  	    <div class="col">
		        			  	      <a class="btn btn-success btn-lg" href="{{ route('edit/data_provider', ['dataprovider' => $dataprovider->nama_paket, 'provider' => $provider->id]) }}">Ubah</a>
		        			  	    </div>
		        			  	  </div>
		        			  </div>
		        			</div>
		        		</div>
		        		@empty
		        		    <div class="alert alert-dark d-inline-block">Tidak ada data provider...</div>
		        		@endforelse 
		        	</div>
		</div>

@endsection