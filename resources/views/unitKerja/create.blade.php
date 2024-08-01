@extends('layouts.app', ['page' => 'Master', 'page2' => 'Unit Kerja', 'page3' => 'Tambah'])

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Unit Kerja</div>
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

                    <form method="POST" action="{{ route('unitKerja.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="group_anggaran_id" class="form-label">Group Anggaran</label>
                                    <select id="group_anggaran_id" class="form-select" name="group_anggaran_id">
                                        <option hidden value="{{ old('group_anggaran_id') }}">
                                            {{ old('group_anggaran_id') }}</option>
                                        @foreach ($groupAnggarans as $groupAnggaran)
                                            <option value="{{ $groupAnggaran->id }}">{{ $groupAnggaran->nama_group }} -
                                                {{ $groupAnggaran->kode_rekening }}</option>
                                        @endforeach
                                    </select>
                                    @error('group_anggaran_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="nama_unit_kerja" class="form-label">Nama Unit Kerja</label>
                                    <input type="text"
                                        class="form-control @error('nama_unit_kerja') is-invalid @enderror"
                                        id="nama_unit_kerja" name="nama_unit_kerja" value="{{ old('nama_unit_kerja') }}">
                                    @error('nama_unit_kerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="budget_bahan_bakar_minyak" class="form-label">Budget BBM</label>
                                    <input type="number"
                                        class="form-control @error('budget_bahan_bakar_minyak') is-invalid @enderror"
                                        id="budget_bahan_bakar_minyak" name="budget_bahan_bakar_minyak"
                                        value="{{ old('budget_bahan_bakar_minyak') }}">
                                    @error('budget_bahan_bakar_minyak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="budget_pelumas_mesin" class="form-label">Budget Pelumas</label>
                                    <input type="number"
                                        class="form-control @error('budget_pelumas_mesin') is-invalid @enderror"
                                        id="budget_pelumas_mesin" name="budget_pelumas_mesin"
                                        value="{{ old('budget_pelumas_mesin') }}">
                                    @error('budget_pelumas_mesin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="budget_suku_cadang" class="form-label">Budget Suku Cadang</label>
                                    <input type="number"
                                        class="form-control @error('budget_suku_cadang') is-invalid @enderror"
                                        id="budget_suku_cadang" name="budget_suku_cadang"
                                        value="{{ old('budget_suku_cadang') }}">
                                    @error('budget_suku_cadang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('unitKerja.index') }}">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        <!-- Form actions footer end -->
                    </form>
                </div>
            </div>
            <!-- Card end -->

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ asset('vendor/bs-select/bs-select-custom.js') }}"></script>
    <script src="{{ asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
