@extends('layouts.app', ['page' => 'Belanja', 'page2' => 'Tambah', 'page3' => ''])

@section('css')
    <link rel="stylesheet" href="{{ secure_assete_asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ secure_assete_asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-12">
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
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('belanja.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label d-flex">Unit Kerja</label>
                                    <select class="select-single js-states form-control @error('nomor_registrasi') is-invalid @enderror" 
                                        title="Masukkan Unit Kerja" 
                                        data-live-search="true" 
                                        name="nomor_registrasi">
                                        <option value="" hidden></option>
                                        @foreach ($kendaraans as $kendaraan)
                                            <option value="{{ $kendaraan->nomor_registrasi }}">
                                                {{ $kendaraan->nomor_registrasi }} - {{ $kendaraan->merk_kendaraan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nomor_registrasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-section-title">Total Belanja</div>
                            </div>

                            @foreach (['bahan_bakar_minyak' => 'BBM', 'pelumas_mesin' => 'Pelumas', 'suku_cadang' => 'Suku Cadang'] as $field => $label)
                                <div class="col-xl-4 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="belanja_{{ $field }}" class="form-label">Belanja {{ $label }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="number" class="form-control" name="belanja_{{ $field }}" id="belanja_{{ $field }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach

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

                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('belanja.index') }}">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Bootstra{{ secure_asset JS -->
    <script src="{{ secure_assete_asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ secure_assete_asset('vendor/bs-select/bs-select-custom.js') }}"></script>
{{ secure_asset
    <!-- Date Range JS -->
    <script src="{{ secure_asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
