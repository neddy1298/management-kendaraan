@extends('layouts.app', ['page' => 'Anggaran', 'page2' => 'Pertahun', 'page3' => 'Tambah'])

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
                    <div class="card-title">Tambah Rincian Objek</div>
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

                    <form method="POST" action="{{ route('masterAnggaran.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="pagu_anggaran_id" class="form-label">Objek</label>
                                    <select id="pagu_anggaran_id" class="select-single js-states form-control"
                                        title="Select Product Category" data-live-search="true" name="pagu_anggaran_id">
                                        <option hidden value="{{ old('pagu_anggaran_id') }}">
                                        </option>
                                        @php
                                            $groupedPaguAnggarans = $paguAnggarans
                                                ->sortByDesc('tahun')
                                                ->groupBy('tahun');
                                        @endphp
                                        @foreach ($groupedPaguAnggarans as $tahun => $group)
                                            <optgroup label="{{ $tahun }}">
                                                @foreach ($group as $paguAnggaran)
                                                    <option value="{{ $paguAnggaran->id }}">
                                                        {{ $tahun }} -
                                                        {{ $paguAnggaran->kode_rekening }} -
                                                        {{ $paguAnggaran->nama_rekening }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <label for="kode_rekening" class="form-label">Kode Rekening</label>
                                        <input type="text"
                                            class="form-control @error('kode_rekening') is-invalid @enderror"
                                            id="kode_rekening" name="kode_rekening" value="{{ old('kode_rekening') }}">
                                        @error('kode_rekening')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <label for="nama_rekening" class="form-label">Nama Rekening</label>
                                        <input type="text"
                                            class="form-control @error('nama_rekening') is-invalid @enderror"
                                            id="nama_rekening" name="nama_rekening" value="{{ old('nama_rekening') }}">
                                        @error('nama_rekening')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <label for="anggaran" class="form-label">Anggaran</label>
                                        <input type="number" class="form-control @error('anggaran') is-invalid @enderror"
                                            id="anggaran" name="anggaran" value="{{ old('anggaran') }}">
                                        @error('anggaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-section-title">Perencanaan Anggaran Perbulan <br>
                                    <p class="text-dark">Kosongkan jika belum ada</p>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="januari" class="form-label">Januari</label>
                                    <input type="number" class="form-control @error('januari') is-invalid @enderror"
                                        id="januari" name="januari" value="{{ old('januari') }}">
                                    @error('januari')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="februari" class="form-label">Februari</label>
                                    <input type="number" class="form-control @error('februari') is-invalid @enderror"
                                        id="februari" name="februari" value="{{ old('februari') }}">
                                    @error('februari')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="maret" class="form-label">Maret</label>
                                    <input type="number" class="form-control @error('maret') is-invalid @enderror"
                                        id="maret" name="maret" value="{{ old('maret') }}">
                                    @error('maret')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="april" class="form-label">April</label>
                                    <input type="number" class="form-control @error('april') is-invalid @enderror"
                                        id="april" name="april" value="{{ old('april') }}">
                                    @error('april')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="mei" class="form-label">Mei</label>
                                    <input type="number" class="form-control @error('mei') is-invalid @enderror"
                                        id="mei" name="mei" value="{{ old('mei') }}">
                                    @error('mei')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="juni" class="form-label">Juni</label>
                                    <input type="number" class="form-control @error('juni') is-invalid @enderror"
                                        id="juni" name="juni" value="{{ old('juni') }}">
                                    @error('juni')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="juli" class="form-label">Juli</label>
                                    <input type="number" class="form-control @error('juli') is-invalid @enderror"
                                        id="juli" name="juli" value="{{ old('juli') }}">
                                    @error('juli')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="agustus" class="form-label">Agustus</label>
                                    <input type="number" class="form-control @error('agustus') is-invalid @enderror"
                                        id="agustus" name="agustus" value="{{ old('agustus') }}">
                                    @error('agustus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="september" class="form-label">September</label>
                                    <input type="number" class="form-control @error('september') is-invalid @enderror"
                                        id="september" name="september" value="{{ old('september') }}">
                                    @error('september')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="oktober" class="form-label">Oktober</label>
                                    <input type="number" class="form-control @error('oktober') is-invalid @enderror"
                                        id="oktober" name="oktober" value="{{ old('oktober') }}">
                                    @error('oktober')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="november" class="form-label">November</label>
                                    <input type="number" class="form-control @error('november') is-invalid @enderror"
                                        id="november" name="november" value="{{ old('november') }}">
                                    @error('november')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="desember" class="form-label">Desember</label>
                                    <input type="number" class="form-control @error('desember') is-invalid @enderror"
                                        id="desember" name="desember" value="{{ old('desember') }}">
                                    @error('desember')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
