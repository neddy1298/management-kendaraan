@extends('layouts.app', ['page' => 'Kendaraan', 'page2' => 'Edit', 'page3' => ''])

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <!-- Row start -->
        <div class="row">
        <div class="col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Kendaraan</div>

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
                    <form method="POST" action="{{ route('kendaraan.update', $kendaraan->id) }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Row start -->
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="nomor_registrasi" class="form-label">Nomor Registrasi <i>( plat nomor )</i></label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('nomor_registrasi') ? 'is-invalid' : '' }}" id="nomor_registrasi"
                                        value="{{ $kendaraan->nomor_registrasi }}" name="nomor_registrasi">
                                    @if ($errors->has('nomor_registrasi'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nomor_registrasi') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="merk_kendaraan" class="form-label">Merk Kendaraan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('merk_kendaraan') ? 'is-invalid' : '' }}" id="merk_kendaraan"
                                        value="{{ $kendaraan->merk_kendaraan }}" name="merk_kendaraan">
                                    @if ($errors->has('merk_kendaraan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('merk_kendaraan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="cc_kendaraan" class="form-label">CC Kendaraan</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('cc_kendaraan') ? 'is-invalid' : '' }}" id="cc_kendaraan"
                                        value="{{ $kendaraan->cc_kendaraan }}" name="cc_kendaraan">
                                    @if ($errors->has('cc_kendaraan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('cc_kendaraan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label d-flex">Jenis Kendaraan</label>
                                    <select class="form-select" title="Masukkan Jenis Kendaraan"
                                        data-live-search="true" onchange="fillForm(this.value)" name="jenis_kendaraan">
                                        <option hidden value="{{ $kendaraan->jenis_kendaraan }}">{{ $kendaraan->jenis_kendaraan }}</option>
                                        <option value="Sepeda Motor">Sepeda Motor</option>
                                        <option value="Mobil Penumpang">Mobil Penumpang</option>
                                        <option value="Mobil Mikrobus">Mobil Mikrobus</option>
                                        <option value="Mobil Barang">Mobil Barang</option>
                                    </select>
                                    @if ($errors->has('jenis_kendaraan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('jenis_kendaraan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label d-flex">BBM Kendaraan</label>
                                    <select class="form-select" title="Masukkan Jenis Kendaraan"
                                        data-live-search="true" onchange="fillForm(this.value)" name="bbm_kendaraan">
                                        <option hidden value="{{ $kendaraan->bbm_kendaraan }}">{{ $kendaraan->bbm_kendaraan }}</option>
                                        <option value="Bensin">Bensin</option>
                                        <option value="Solar">Solar</option>
                                    </select>
                                    @if ($errors->has('bbm_kendaraan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('bbm_kendaraan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="roda_kendaraan" class="form-label">Jumlah Roda</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('roda_kendaraan') ? 'is-invalid' : '' }}" id="roda_kendaraan"
                                        value="{{ $kendaraan->roda_kendaraan }}" name="roda_kendaraan">
                                    @if ($errors->has('roda_kendaraan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('roda_kendaraan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <div class="form-label">Tanggal Kadaluarsa STNK</div>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar4"></i>
                                        </span>
                                        <input type="text" class="form-control datepicker" name="berlaku_sampai" value="{{ date('d/m/Y', strtotime($kendaraan->berlaku_sampai)) }}">
                                    </div>
                                </div>
							</div>
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label d-flex">Unit Kerja</label>
                                    <select class="select-single js-states form-control" title="Masukkan Unit Kerja</i>"
                                        data-live-search="true" name="mt_group">
                                        <option hidden value="{{ $maintenance->id }}">{{ $maintenance->nama_group }}</option>
                                        @foreach ($mt_groups as $mt_group)
                                            <option value="{{ $mt_group->id }}">{{ $mt_group->nama_group }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('mt_group'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('mt_group') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('kendaraan.index') }}">Batal</a>
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
    <script src="{{ asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ asset('vendor/bs-select/bs-select-custom.js') }}"></script>

    <!-- Date Range JS -->
    <script src="{{ asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
