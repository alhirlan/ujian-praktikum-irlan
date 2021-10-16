<!DOCTYPE html>
@section('formHomeActive', 'active')
@extends('master')
@section('content')
<link rel="stylesheet" type="text/css" href="css/style.css">
	<div class="container mb-4">
	    <div class="col-md-12 mt-3">
	        <div class="card">
	            <div class="card-header">
	                <h3 class="float-end me-3">
	                	/Index
	                </h3>
	            </div>
	            <div class="card-body">
	                    <div class="row justify-content-around mb-3">
	                    	<div class="col-4 text-center">
	                    	    <a href="{{ route('main/provider') }}" class="btn btn-primary">Buat Provider</a>
	                    	</div>
	                    	<div class="col-4 text-center">
	                    		<h5>Selamat datang di halaman Index</h5>
	                    	</div>
	                    	<div class="col-4 text-center">
	                    	    <a href="{{ route('main/data-provider') }}" class="btn btn-primary">Isi Data Provider</a>
	                    	</div>
	                	</div>
	                	@if (Session::has('success'))
	                	    <div class="alert text-center alert-success">
	                	        {{ Session::get('success') }}
	                	        <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
	                	    </div>
	                	@endif
	            </div>
	        </div>
	    </div>


	        @php
	            $nomor=1;
	        @endphp
	            <div class="row mt-3">
	                @forelse ($providers as $provider)
	                    <div class="col-md-6 col-lg-3 col-sm-6 my-1 d-flex justify-content-center">
	                        <div class="card bg-light" style="width: 18rem;">
	                            <div class="card-header">
	                              <h4 class="float-start fw-bold fs-3">{{ $provider->nama_provider }}</h4>
	                              <div class="float-end border border-1 border-dark rounded-circle" style="width: 25px; text-align: center;">
	                                  {{ $nomor++ }}
	                              </div>
	                            </div>

	                            <div class="hover hover-1">
		                        	<img src="{{ asset('../storage/'.$provider->file) }}" alt="{{ $provider->nama_provider }}" style="height: 260px;">
			                        <div class="hover-overlay"></div>
	                                  <div class="hover-1-content">
	                                    <p class="hover-1-description mx-2">
	                                    	<a href="{{ route('edit/provider', ['provider' => $provider->nama_provider]) }}" class="btn btn-danger mx-5">Edit Provider</a>
	                                    </p>
	                                  </div>
                                </div>

	                            <div class="card-footer">
		                            <ul class="list-group list-group-flush">
		                                <a href="{{ route('main/show', ['provider' => $provider->nama_provider]) }}" class="btn btn-outline-danger float-end ">Lihat Detail</a>
		                            </ul>
	                        	</div>
	                    	</div>
	    				</div>
	    			@empty
	    			    <div class="alert alert-dark d-inline-block">Tidak ada data...</div>
	    			@endforelse 
				</div>
	</div>
@endsection