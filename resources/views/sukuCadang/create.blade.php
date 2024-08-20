@extends('layouts.app', ['page' => 'Suku Cadang', 'page2' => 'Tambah', 'page3' => ''])

@section('css')
    <link rel="stylesheet" href="{{ secure_asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Suku Cadang Baru</div>
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

                    <form method="POST" action="{{ route('sukuCadang.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="nama_suku_cadang" class="form-label">Nama Suku Cadang</label>
                                    <input type="text"
                                        class="form-control @error('nama_suku_cadang') is-invalid @enderror"
                                        id="nama_suku_cadang" name="nama_suku_cadang" value="{{ old('nama_suku_cadang') }}">
                                    @error('nama_suku_cadang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="group_anggaran_id" class="form-label">Roda</label>
                                    <select id="group_anggaran_id" class="select-single js-states form-control"
                                        title="Select Sub Rincian Objek" data-live-search="true" name="group_anggaran_id">
                                        <option hidden value="{{ old('group_anggaran_id') }}"></option>
                                        @php
                                            $groupedgroupAnggaran = $groupAnggarans
                                                ->sortByDesc('masterAnggaran.paguAnggaran.tahun')
                                                ->groupBy('masterAnggaran.paguAnggaran.tahun');
                                        @endphp
                                        @foreach ($groupedgroupAnggaran as $tahun => $group)
                                            <optgroup label="{{ $tahun }}">
                                                @foreach ($group as $groupAnggaran)
                                                    <option value="{{ $groupAnggaran->id }}">
                                                        {{ $groupAnggaran->nama_group }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <label for="stok_awal" class="form-label">Stok Awal</label>
                                        <input type="number" class="form-control @error('stok_awal') is-invalid @enderror"
                                            id="stok_awal" name="stok_awal" value="{{ old('stok_awal') }}">
                                        @error('stok_awal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga Satuan</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                            id="harga" name="harga" value="{{ old('harga') }}">
                                        @error('harga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Form actions footer start -->
                            <div class="form-actions-footer">
                                <a class="btn btn-light" href="{{ route('sukuCadang.index') }}">Batal</a>
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
@endsection
