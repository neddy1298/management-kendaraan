@extends('layouts.app', ['page' => 'Laporan', 'page2' => '', 'page3' => ''])


@section('css')
    <link rel="stylesheet" href="{{ secure_asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <!-- Row start -->
    <div class="row mt-3">
        <div class="offset-1 col-sm-10 col-10">
            @if (session('success'))
                @include('partials.alert', ['type' => 'success', 'message' => session('success')])
            @elseif (session('error'))
                @include('partials.alert', ['type' => 'danger', 'message' => session('error')])
            @endif
            <!-- Card start -->
            <div class="card">
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-section-title">Laporan</div>
                        </div>

                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- Form start -->
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-x-circle alert-icon"></i>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form method="GET" action="{{ route('laporan.print') }}" target="_blank">
                                @csrf

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="jenis_laporan" class="form-label">Jenis Laporan</label>
                                        <div class="input-group">
                                            <select name="jenis_laporan" class="select-single js-states form-control"
                                                onchange="">
                                                <option value="" hidden></option>
                                                <option value="1">Kartu Kendali Kegiatan</option>
                                                <option value="2">RKA BBM dan Pemeliharaan </option>
                                                <option value="3">Realisasi dan Estimasi Kendaraan</option>
                                                <option value="4">Realisasi Suku Cadang Kendaraan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="name" class="form-label">Tahun</label>
                                        <div class="input-group">
                                            <select name="tahun" class="select-single js-states form-control">
                                                <option value="{{ date('Y') }}" hidden>{{ date('Y') }}</option>
                                                @for ($i = 2022; $i <= date('Y') + 1; $i++)
                                                    <option value="{{ $i }}">
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3" hidden id="bulan-form1">
                                        <label for="name" class="form-label">Dari Bulan</label>
                                        <div class="input-group">
                                            <select name="bulan_start" class="form-select">
                                                <option value="1" hidden>Januari</option>
                                                @foreach ($months as $key => $month)
                                                    <option value="{{ $key }}">
                                                        {{ $month }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3" hidden id="bulan-form2">
                                        <label for="name" class="form-label">Sampai Bulan</label>
                                        <div class="input-group">
                                            <select name="bulan_end" class="form-select">
                                                <option value="12" hidden>Desember</option>
                                                @foreach ($months as $key => $month)
                                                    <option value="{{ $key }}">
                                                        {{ $month }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <a href="{{ route('laporan.exportExcel') }}" class="btn btn-primary">Export to
                                            Excel</a>
                                        <button type="submit" class="btn btn-success">Lihat Laporan</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Form end -->
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
            </div>
            <!-- Card end -->
        </div>
    </div>
    <!-- Row end -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('select[name="jenis_laporan"]').change(function() {
                if ($(this).val() == 1) {
                    $('#bulan-form1').removeAttr('hidden');
                    $('#bulan-form2').removeAttr('hidden');
                } else {
                    $('#bulan-form1').attr('hidden', 'hidden');
                    $('#bulan-form2').attr('hidden', 'hidden');
                }
            });
        });
    </script>


    <script src="{{ secure_asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/bs-select/bs-select-custom.js') }}"></script>
@endsection
