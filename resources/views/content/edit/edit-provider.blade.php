@extends('master')
@section('content')
	<div class="container">
		<div class="col-md-12 mt-3">
		    <div class="card">
		        <div class="card-header">
		        	<div class="row row-cols-3 row-cols-lg-3 g-2 g-lg-3">
		        		<div class="col">
		        			<div class="text-center float-start ms-3 mt-3">
		        			    <a href="{{ route('main/index') }}" class="btn btn-primary">Kembali</a>
		        			</div>
		        		</div>
		        		<div class="col">
		        			<h4 class="text-center">Form Edit Provider <div class="fs-3 fw-bold">{{ $provider->nama_provider }}</div></h4>
		        		</div>
		        		<div class="col">
		        			<h3 class="float-end me-3 mt-3">
		        				/Edit-Provider
		        			</h3>	
		        		</div>
		        	</div>
		        </div>
		        <div class="card-body">
		        	@if(session('errors'))
		        	    <div class="alert alert-danger alert-dismissible fade show" role="alert">
		        	        Sepertinya Ada Yang Salah:
		        	        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
		        	        <ul>
		        	        @foreach ($errors->all() as $error)
		        	            <li>{{ $error }}</li>
		        	        @endforeach
		        	        </ul>
		        	    </div>
		        	@endif
		            @if (Session::has('error'))
		                <div class="alert alert-dismissible alert-danger">
		                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
		                    {{ Session::get('error') }}
		                </div>
		            @endif
		        </div>
		    </div>
		</div>
		<div class="container mt-4">
			<form action="{{ route('edit/provider/proses', ['provider' => $provider->nama_provider]) }}" method="POST" enctype="multipart/form-data">
				@method('PUT')
				@csrf
				<div class="row container">
					<div class="col-lg-4">
						<label for="formFile" class="form-label mt-4">Nama Provider</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-text"><i class="fab fa-elementor"></i></span>
			                    <input type="text" name="nama_provider" class="form-control" value="{{ old('nama_provider') ?? $provider->nama_provider }}" readonly>
	                  		</div>
						</div>
						<label for="formFile" class="form-label mt-1">Jenis Provider</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-text"><i class="fas fa-list"></i></span>
			                    <input type="text" name="jenis_provider" class="form-control" value="{{ old('jenis_provider') ?? $provider->jenis_provider }}" autofocus>
	                  		</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
		                    <label for="formFile" class="form-label mt-4"><i class="fas fa-file-image"></i> Pilih Image | max size 2 MB</label>
		                    <input class="form-control" type="file" name="image" id="imgPrev" accept="image/*">
		                </div>
		                <label for="formFile" class="form-label mt-1">Tanggal Berlanggalan</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
			                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') ?? $provider->tanggal }}">
	                  		</div>
						</div>
					</div>
					<div class="col-lg-4 text-center">
						<img id="blah" src="{{ asset('storage/'.$provider->file) }}" alt="your image" width="200" height="200" />
					</div>
					<div class="container mt-3">
						<button type="submit" class="btn btn-success btn-lg float-start">Kirim</button>
						</form>
						<form action="{{ route('delete/provider', ['provider' => $provider->id]) }}" method="POST">
						    @method('DELETE')
						    @csrf
							<button type="submit" onclick="return confirm('Apakah Provider dan Data Provider {{ $provider->nama_provider }} ingin dihapus ?')" class="btn btn-danger btn-lg me-5 float-end">Hapus</button>
						</form>
					</div>
				</div>
			
		</div>
	</div>
	<script type="text/javascript">
		imgPrev.onchange = evt => {
		    const [file] = imgPrev.files
		    if (file) {
		      blah.src = URL.createObjectURL(file)
		    }
		  }
	</script>
@endsection