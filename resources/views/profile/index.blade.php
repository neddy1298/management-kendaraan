@extends('layouts.app', ['page' => 'User', 'page2' => 'Detail', 'page3' => ''])

@section('content')
    <!-- Row start -->
    <div class="row mt-3">
        <div class="offset-1 col-sm-10 col-10">
            @if (session('success'))
                @include('partials.alert', ['type' => 'success', 'message' => session('success')])
            @elseif (session('error'))
                @include('partials.alert', ['type' => 'danger', 'message' => session('error')])
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
                                <img src="{{ asset('images/profile.png') }}" class="img-fluid" alt="Image">
                            </div>
                        </div>

                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                            <!-- Form start -->
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', auth()->user()->name) }}" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="email" class="form-label">Akun (Email)</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', auth()->user()->email) }}" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                            password</small>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Form end -->
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
