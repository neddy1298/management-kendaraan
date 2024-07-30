@extends('layouts.app', ['page' => 'Unit Kerja', 'page2' => 'Edit', 'page3' => ''])

@section('css')
    <link rel="stylesheet" href="{{ secure_asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Unit Kerja</div>
                    <div class="card-options">
                        <span class="text-muted">Tanggal Hari ini: {{ now()->format('d F Y') }}</span>
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

                    <form method="POST" action="{{ route('unitKerja.update', $unitKerja->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="nama_unit_kerja" class="form-label">Nama Unit Kerja</label>
                                    <input type="text" id="nama_unit_kerja" name="nama_unit_kerja"
                                        class="form-control @error('nama_unit_kerja') is-invalid @enderror"
                                        value="{{ old('nama_unit_kerja', $unitKerja->nama_unit_kerja) }}">
                                    @error('nama_unit_kerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="budget_bahan_bakar_minyak" class="form-label">Budget BBM</label>
                                    <input type="number" id="budget_bahan_bakar_minyak" name="budget_bahan_bakar_minyak"
                                        class="form-control @error('budget_bahan_bakar_minyak') is-invalid @enderror"
                                        value="{{ old('budget_bahan_bakar_minyak', $unitKerja->budget_bahan_bakar_minyak) }}">
                                    @error('budget_bahan_bakar_minyak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="budget_pelumas_mesin" class="form-label">Budget Pelumas</label>
                                    <input type="number" id="budget_pelumas_mesin" name="budget_pelumas_mesin"
                                        class="form-control @error('budget_pelumas_mesin') is-invalid @enderror"
                                        value="{{ old('budget_pelumas_mesin', $unitKerja->budget_pelumas_mesin) }}">
                                    @error('budget_pelumas_mesin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="budget_suku_cadang" class="form-label">Budget Suku Cadang</label>
                                    <input type="number" id="budget_suku_cadang" name="budget_suku_cadang"
                                        class="form-control @error('budget_suku_cadang') is-invalid @enderror"
                                        value="{{ old('budget_suku_cadang', $unitKerja->budget_suku_cadang) }}">
                                    @error('budget_suku_cadang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="budget_total" class="form-label">Total Budget</label>
                                    <input type="number" id="budget_total" name="budget_total"
                                        class="form-control @error('budget_total') is-invalid @enderror"
                                        value="{{ old('budget_total', $unitKerja->budget_total) }}">
                                    @error('budget_total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('unitKerja.index') }}">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card end -->

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ secure_asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/bs-select/bs-select-custom.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
