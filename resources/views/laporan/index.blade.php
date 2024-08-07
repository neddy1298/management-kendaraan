@extends('layouts.app', ['page' => 'Laporan', 'page2' => '', 'page3' => ''])

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
                            <form method="GET" action="{{ route('laporan.export') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="name" class="form-label">Tahun</label>
                                        <div class="input-group">
                                            <select name="tahun" class="form-select">
                                                <option value="all">Semua Tahun</option>
                                                @foreach ($paguAnggarans as $paguAnggaran)
                                                    @php
                                                        $currentYear = date('Y');
                                                        $selectedYear = $paguAnggaran->tahun;
                                                    @endphp
                                                    <option value="{{ $selectedYear }}"
                                                        {{ $selectedYear == $currentYear ? 'selected' : '' }}>
                                                        {{ $selectedYear }}
                                                    </option>
                                                    @for ($i = $currentYear - 1; $i <= $currentYear + 1; $i++)
                                                        @if ($i != $selectedYear)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endif
                                                    @endfor
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
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
                                    <div class="col-12 mb-3">
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
                                        <button type="submit" class="btn btn-success">Buat Laporan</button>
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
