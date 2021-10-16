<!DOCTYPE html>
@section('formDataActive', 'active')
@extends('master')
@section('content')
    <div class="container">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row row-cols-3 row-cols-lg-3 g-2 g-lg-3">
                        <div class="col">
                            <div class="text-center float-start">
                                <a href="{{ route('main/index') }}" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                        <div class="col">
                            <h4 class="text-center fw-bold">Form Pengisian Data Provider</h4>
                        </div>
                        <div class="col">
                            <h3 class="float-end me-3">
                                /Data-Provider
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('errors'))
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
            <form action="{{ route('data-provider/create') }}" method="POST">
                @csrf

                <div class="row container">
                    <div class="col-6">
                        <label for="formFile" class="form-label">Pilih Provider</label>
                        <select name="provider" class="form-select w-50">
                            <option value=""> Select Provider </option>
                            @foreach ($providers as $id => $name)
                                <option value="{{ $name }}">{{ $id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row container mt-3">
                    <div class="col-lg-4">
                        <label for="formFile" class="form-label">Nama Paket</label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-box"></i></span>
                                <input type="text" name="nama_paket" class="form-control" autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="formFile" class="form-label">Kecepatan</label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tachometer-alt"></i></span>
                                <input type="number" name="kecepatan" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="formFile" class="form-label">Harga</label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                <input type="text" name="harga" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg mt-4">Kirim</button>
            </form>
        </div>
    </div>
@endsection
