@extends('layouts.app', ['page' => 'Home', 'page2' => 'Tambah', 'page3' => ''])

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
                    <div class="card-title">Ubah Pagu Anggaran</div>
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

                    <form method="POST" action="{{ route('masterAnggaran.update', $masterAnggaran->id ?? 1) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="kode_rekening" class="form-label">Kode Rekening</label>
                                    <input type="text" class="form-control @error('kode_rekening') is-invalid @enderror"
                                        id="kode_rekening" name="kode_rekening" value="{{ $masterAnggaran->kode_rekening ?? "" }}">
                                    @error('kode_rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="nama_rekening" class="form-label">Nama Rekening</label>
                                    <input type="text" class="form-control @error('nama_rekening') is-invalid @enderror"
                                        id="nama_rekening" name="nama_rekening" value="{{ $masterAnggaran->nama_rekening ?? "" }}">
                                    @error('nama_rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="anggaran" class="form-label">Anggaran</label>
                                    <input type="number" class="form-control @error('anggaran') is-invalid @enderror"
                                        id="anggaran" name="anggaran" value="{{ $masterAnggaran->anggaran }}">
                                    @error('anggaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('masterAnggaran.index') }}">Batal</a>
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
