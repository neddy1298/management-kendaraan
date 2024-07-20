@extends('layouts.app', ['page' => 'Home', 'page2' => '', 'page3' => ''])

@section('content')
    <!-- Row start -->
    <div class="row mt-5">
        <div class="col-lg-6 col-sm-12 col-12">
            <div class="card text-center">
                <div class="card-header">
                    <div class="card-title m-auto">PENGGUNA</div>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        <i class="bi bi-person-circle display-1"></i>
                    </p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-info">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-12">
            <div class="card text-center">
                <div class="card-header">
                    <div class="card-title m-auto">PERMOHONAN KTP</div>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        <i class="bi bi-file-earmark display-1"></i>
                    </p>
                    <a href="{{ route('permohonan.index') }}" class="btn btn-info">Lihat</a>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4 col-sm-12 col-12">
            <div class="card text-center">
                <div class="card-header">
                    <div class="card-title m-auto">LAPORAN</div>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        <i class="bi bi-clipboard display-1"></i>
                    </p>
                    <a href="#" class="btn btn-info">Lihat</a>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- Row end -->
@endsection
