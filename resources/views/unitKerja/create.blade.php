@extends('layouts.app', ['page' => 'Master', 'page2' => 'Unit Kerja', 'page3' => 'Tambah'])

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
                                    <select id="group_anggaran_id" class="select-multiple js-states form-control"
                                        multiple="multiple" name="group_anggaran_id[]">
                                        @foreach ($groupAnggarans as $groupAnggaran)
                                            <option value="{{ $groupAnggaran->id }}"
                                                {{ in_array($groupAnggaran->id, old('group_anggaran_id', [])) ? 'selected' : '' }}>
                                                {{ $groupAnggaran->nama_group }} - {{ $groupAnggaran->kode_rekening }}
                                            </option>
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
    <script src="{{ secure_asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/bs-select/bs-select-custom.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
