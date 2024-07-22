@extends('layouts.app', ['page' => 'User', 'page2' => 'Detail', 'page3' => ''])

@section('content')
    <!-- Row start -->
    <div class="row mt-3">
        <div class="offset-1 col-sm-10 col-10">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle alert-icon"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br />
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle alert-icon"></i>
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Card start -->
            <div class="card">
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-section-title">Data Pengguna</div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="mb-3">
                                <img src="{{ secure_asset('asset('images/profile.png') }}" class="img-fluid" alt="Image">
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
            </div>
            <!-- Card end -->

        </div>

    </div>
    <!-- Row end -->
@endsection
