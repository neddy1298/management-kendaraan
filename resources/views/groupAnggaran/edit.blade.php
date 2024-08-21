@extends('layouts.app', ['page' => 'Anggaran', 'page2' => 'Group', 'page3' => 'Edit'])

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
                    <div class="card-title">Ubah Sub Rincian Objek</div>
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

                    <form method="POST" action="{{ route('groupAnggaran.update', $groupAnggaran->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="master_anggaran_id" class="form-label">Rincian Objek</label>
                                    <select id="master_anggaran_id" class="select-single js-states form-control"
                                        title="Select Rincian Objek" data-live-search="true" name="master_anggaran_id">
                                        <optgroup label="Pilihan Awal">
                                            <option hidden value="{{ $groupAnggaran->master_anggaran_id }}">
                                                {{ $groupAnggaran->masterAnggaran->paguAnggaran->tahun }}
                                                - {{ $groupAnggaran->masterAnggaran->kode_rekening }}
                                                - {{ $groupAnggaran->masterAnggaran->nama_rekening }}</option>
                                        </optgroup>
                                        @php
                                            $groupedmasterAnggarans = $masterAnggarans
                                                ->sortByDesc('paguAnggaran.tahun')
                                                ->groupBy('paguAnggaran.tahun');
                                        @endphp
                                        @foreach ($groupedmasterAnggarans as $tahun => $group)
                                            <optgroup label="{{ $tahun }}">
                                                @foreach ($group as $masterAnggaran)
                                                    <option value="{{ $masterAnggaran->id }}">
                                                        {{ $tahun }} -
                                                        {{ $masterAnggaran->kode_rekening }} -
                                                        {{ $masterAnggaran->nama_rekening }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="kode_rekening" class="form-label">Kode Rekening</label>
                                    <input type="text" class="form-control @error('kode_rekening') is-invalid @enderror"
                                        id="kode_rekening" name="kode_rekening"
                                        value="{{ $groupAnggaran->kode_rekening }}">
                                    @error('kode_rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="nama_group" class="form-label">Nama Group</label>
                                    <input type="text" class="form-control @error('nama_group') is-invalid @enderror"
                                        id="nama_group" name="nama_group" value="{{ $groupAnggaran->nama_group }}">
                                    @error('nama_group')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="anggaran_bahan_bakar_minyak" class="form-label">Anggaran BBM</label>
                                    <input type="number"
                                        class="form-control @error('anggaran_bahan_bakar_minyak') is-invalid @enderror"
                                        id="anggaran_bahan_bakar_minyak" name="anggaran_bahan_bakar_minyak"
                                        value="{{ $groupAnggaran->anggaran_bahan_bakar_minyak }}">
                                    @error('anggaran_bahan_bakar_minyak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="anggaran_pelumas_mesin" class="form-label">Anggaran Pelumas</label>
                                    <input type="number"
                                        class="form-control @error('anggaran_pelumas_mesin') is-invalid @enderror"
                                        id="anggaran_pelumas_mesin" name="anggaran_pelumas_mesin"
                                        value="{{ $groupAnggaran->anggaran_pelumas_mesin }}">
                                    @error('anggaran_pelumas_mesin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="anggaran_suku_cadang" class="form-label">Anggaran Suku Cadang</label>
                                    <input type="number"
                                        class="form-control @error('anggaran_suku_cadang') is-invalid @enderror"
                                        id="anggaran_suku_cadang" name="anggaran_suku_cadang"
                                        value="{{ $groupAnggaran->anggaran_suku_cadang }}">
                                    @error('anggaran_suku_cadang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                        id="januari" name="januari"
                                        value="{{ $groupAnggaran->anggaranPerbulan->januari }}">
                                    @error('januari')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="februari" class="form-label">Februari</label>
                                    <input type="number" class="form-control @error('februari') is-invalid @enderror"
                                        id="februari" name="februari"
                                        value="{{ $groupAnggaran->anggaranPerbulan->februari }}">
                                    @error('februari')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="maret" class="form-label">Maret</label>
                                    <input type="number" class="form-control @error('maret') is-invalid @enderror"
                                        id="maret" name="maret"
                                        value="{{ $groupAnggaran->anggaranPerbulan->maret }}">
                                    @error('maret')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="april" class="form-label">April</label>
                                    <input type="number" class="form-control @error('april') is-invalid @enderror"
                                        id="april" name="april"
                                        value="{{ $groupAnggaran->anggaranPerbulan->april }}">
                                    @error('april')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="mei" class="form-label">Mei</label>
                                    <input type="number" class="form-control @error('mei') is-invalid @enderror"
                                        id="mei" name="mei"
                                        value="{{ $groupAnggaran->anggaranPerbulan->mei }}">
                                    @error('mei')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="juni" class="form-label">Juni</label>
                                    <input type="number" class="form-control @error('juni') is-invalid @enderror"
                                        id="juni" name="juni"
                                        value="{{ $groupAnggaran->anggaranPerbulan->juni }}">
                                    @error('juni')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="juli" class="form-label">Juli</label>
                                    <input type="number" class="form-control @error('juli') is-invalid @enderror"
                                        id="juli" name="juli"
                                        value="{{ $groupAnggaran->anggaranPerbulan->juli }}">
                                    @error('juli')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="agustus" class="form-label">Agustus</label>
                                    <input type="number" class="form-control @error('agustus') is-invalid @enderror"
                                        id="agustus" name="agustus"
                                        value="{{ $groupAnggaran->anggaranPerbulan->agustus }}">
                                    @error('agustus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="september" class="form-label">September</label>
                                    <input type="number" class="form-control @error('september') is-invalid @enderror"
                                        id="september" name="september"
                                        value="{{ $groupAnggaran->anggaranPerbulan->september }}">
                                    @error('september')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="oktober" class="form-label">Oktober</label>
                                    <input type="number" class="form-control @error('oktober') is-invalid @enderror"
                                        id="oktober" name="oktober"
                                        value="{{ $groupAnggaran->anggaranPerbulan->oktober }}">
                                    @error('oktober')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="november" class="form-label">November</label>
                                    <input type="number" class="form-control @error('november') is-invalid @enderror"
                                        id="november" name="november"
                                        value="{{ $groupAnggaran->anggaranPerbulan->november }}">
                                    @error('november')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="desember" class="form-label">Desember</label>
                                    <input type="number" class="form-control @error('desember') is-invalid @enderror"
                                        id="desember" name="desember"
                                        value="{{ $groupAnggaran->anggaranPerbulan->desember }}">
                                    @error('desember')
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
    <script src="{{ asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ asset('vendor/bs-select/bs-select-custom.js') }}"></script>
    <script src="{{ asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
