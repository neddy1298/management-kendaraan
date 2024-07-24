@extends('layouts.app', ['page' => 'Maintenance', 'page2' => 'Tambah', 'page3' => 'create'])

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Data Maintenance</div>

                    <div class="card-options">

                        <span class="text-muted">Tanggal: {{ now()->format('d-m-Y') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle alert-icon"></i>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('maintenance.update', $maintenance->id) }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Row start -->
                        <div class="row">   
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="belanja_bahan_bakar_minyak" class="form-label">Nomor Registrasi</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('belanja_bahan_bakar_minyak') ? 'is-invalid' : '' }}" id="belanja_bahan_bakar_minyak"
                                        value="{{ $maintenance->nomor_registrasi }}" readonly>
                                </div>
                            </div>   
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="belanja_bahan_bakar_minyak" class="form-label">Jumlah Roda</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('belanja_bahan_bakar_minyak') ? 'is-invalid' : '' }}" id="belanja_bahan_bakar_minyak"
                                        value="{{ $maintenance->belanja_bahan_bakar_minyak }}" name="belanja_bahan_bakar_minyak">
                                    @if ($errors->has('belanja_bahan_bakar_minyak'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('belanja_bahan_bakar_minyak') }}
                                        </div>
                                    @endif
                                </div>
                            </div>   
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="belanja_bahan_bakar_minyak" class="form-label">Jumlah Roda</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('belanja_bahan_bakar_minyak') ? 'is-invalid' : '' }}" id="belanja_bahan_bakar_minyak"
                                        value="{{ $maintenance->belanja_bahan_bakar_minyak }}" name="belanja_bahan_bakar_minyak">
                                    @if ($errors->has('belanja_bahan_bakar_minyak'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('belanja_bahan_bakar_minyak') }}
                                        </div>
                                    @endif
                                </div>
                            </div>   
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="belanja_bahan_bakar_minyak" class="form-label">Jumlah Roda</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('belanja_bahan_bakar_minyak') ? 'is-invalid' : '' }}" id="belanja_bahan_bakar_minyak"
                                        value="{{ $maintenance->belanja_bahan_bakar_minyak }}" name="belanja_bahan_bakar_minyak">
                                    @if ($errors->has('belanja_bahan_bakar_minyak'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('belanja_bahan_bakar_minyak') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('maintenance.index') }}">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        <!-- Form actions footer end -->
                    </form>

                </div>
            </div>
            <!-- Card end -->

        </div>
    </div>
    <!-- Row end -->
@endsection

@section('script')
    <!-- Bootstrap Select JS -->
    <script src="{{ asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ asset('vendor/bs-select/bs-select-custom.js') }}"></script>

    <!-- Date Range JS -->
    <script src="{{ asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
