@extends('layouts.app', ['page' => 'Anggaran', 'page2' => 'Group', 'page3' => 'Tambah'])

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
                    <div class="card-title">Group Baru</div>
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

                    <form method="POST" action="{{ route('groupAnggaran.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="master_anggaran_id" class="form-label">Master Anggaran</label>
                                    <select id="master_anggaran_id" class="form-select" name="master_anggaran_id">
                                        <option hidden value="{{ old('master_anggaran_id') }}">{{ old('master_anggaran_id') }}</option>
                                        @foreach ($masterAnggarans as $masterAnggaran)
                                        <option value="{{ $masterAnggaran->id }}">{{ $masterAnggaran->nama_rekening }} - {{ $masterAnggaran->kode_rekening }}</option>
                                        @endforeach
                                    </select>
                                    @error('master_anggaran_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="kode_rekening" class="form-label">Kode Rekening</label>
                                    <input type="text" class="form-control @error('kode_rekening') is-invalid @enderror"
                                        id="kode_rekening" name="kode_rekening" value="{{ old('kode_rekening') }}">
                                    @error('kode_rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="nama_group" class="form-label">Nama Group</label>
                                    <input type="text" class="form-control @error('nama_group') is-invalid @enderror"
                                        id="nama_group" name="nama_group" value="{{ old('nama_group') }}">
                                    @error('nama_group')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="anggaran_bahan_bakar_minyak" class="form-label">Anggaran BBM</label>
                                    <input type="number" class="form-control @error('anggaran_bahan_bakar_minyak') is-invalid @enderror"
                                        id="anggaran_bahan_bakar_minyak" name="anggaran_bahan_bakar_minyak" value="{{ old('anggaran_bahan_bakar_minyak') }}">
                                    @error('anggaran_bahan_bakar_minyak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="anggaran_pelumas_mesin" class="form-label">Anggaran Pelumas</label>
                                    <input type="number" class="form-control @error('anggaran_pelumas_mesin') is-invalid @enderror"
                                        id="anggaran_pelumas_mesin" name="anggaran_pelumas_mesin" value="{{ old('anggaran_pelumas_mesin') }}">
                                    @error('anggaran_pelumas_mesin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="anggaran_suku_cadang" class="form-label">Anggaran Suku Cadang</label>
                                    <input type="number" class="form-control @error('anggaran_suku_cadang') is-invalid @enderror"
                                        id="anggaran_suku_cadang" name="anggaran_suku_cadang" value="{{ old('anggaran_suku_cadang') }}">
                                    @error('anggaran_suku_cadang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('groupAnggaran.index') }}">Batal</a>
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
    <script src="{{ secure_asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/bs-select/bs-select-custom.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
