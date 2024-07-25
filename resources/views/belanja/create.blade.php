@extends('layouts.app', ['page' => 'Belanja', 'page2' => 'Tambah', 'page3' => ''])

@section('css')
    <link rel="stylesheet" href="{{ secure_asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Data Belanja</div>

                    <div class="card-options">

                        <span class="text-muted">Tanggal Hari ini: {{ now()->format('d-m-Y') }}</span>
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
                    <form method="POST" action="{{ route('belanja.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Row start -->
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label d-flex">Unit Kerja</label>
                                    <select class="select-single js-states form-control" title="Masukkan Unit Kerja</i>"
                                        data-live-search="true" name="nomor_registrasi">
                                        <option hidden value="{{ old('nomor_registrasi') }}">{{ old('nomor_registrasi') }}
                                        </option>
                                        @foreach ($kendaraans as $kendaraan)
                                            <option value="{{ $kendaraan->nomor_registrasi }}">
                                                {{ $kendaraan->nomor_registrasi }} - {{ $kendaraan->merk_kendaraan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('nomor_registrasi'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nomor_registrasi') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-section-title">Total Belanja</div>
                            </div>
                            <div class="col-xl-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="belanja_bahan_bakar_minyak" class="form-label">Belanja BBM</label>
                                    
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" class="form-control" name="belanja_bahan_bakar_minyak">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="belanja_pelumas_mesin" class="form-label">Belanja Pelumas</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" class="form-control" name="belanja_pelumas_mesin">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="belanja_suku_cadang" class="form-label">Belanja Suku Cadang</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" class="form-control" name="belanja_suku_cadang">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <div class="form-label">Tanggal Belanja</div>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar4"></i>
                                        </span>
                                        <input type="text" class="form-control datepicker" name="tanggal_belanja">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('belanja.index') }}">Batal</a>
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
    <script src="{{ secure_asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/bs-select/bs-select-custom.js') }}"></script>

    <!-- Date Range JS -->
    <script src="{{ secure_asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
