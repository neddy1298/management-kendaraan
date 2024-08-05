@extends('layouts.app', ['page' => 'Maintenance', 'page2' => '', 'page3' => ''])

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bs5.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bs5-custom.css') }}" />
@endsection

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="row">
            <div class="col-xxl-4 col-sm-6 col-12">
                <div class="stats-tile">
                    <div class="sale-icon shade-green">
                        <h4 class="text-white">Rp</h4>
                    </div>
                    <div class="sale-details">
                        <h3 class="text-green">
                            {{ number_format($belanja_bulan_ini, 0, ',', '.') }}.00
                        </h3>
                        <p>Total Belanja {{ $months[$selectedMonth] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-6 col-12">
                <div class="stats-tile">
                    <div class="sale-icon shade-red">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="sale-details">
                        <h3 class="text-red">
                            {{ $isExpire }}/{{ $maintenances->count() }}
                        </h3>
                        <p>Kadaluarsa Pajak</p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-6 col-12">
                <div class="stats-tile">
                    <div class="sale-icon shade-blue">
                        <h4 class="text-white">Rp</h4>
                    </div>
                    <div class="sale-details">
                        <h3 class="text-blue">{{ number_format($belanja_tahun_ini, 0, ',', '.') }}.00</h3>
                        {{-- <p>Total Belanja Tahun {{ \Carbon\Carbon::now()->translatedFormat('Y') }}</p> --}}
                        <p>Total Belanja Tahun {{ $selectedYear }}</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <!-- Card start -->
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('maintenance.index') }}" method="GET"
                    class="row row-cols-lg-auto g-3 align-items-center">
                                            <div class="col-12">
                            <label class="visually-hidden">Username</label>
                            <div class="input-group">
                                {{-- <div class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </div> --}}
                                <select name="year" class="form-select">
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                            {{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="visually-hidden">Password</label>
                            <div class="input-group">
                                {{-- <div class="input-group-text">
                                    <i class="bi bi-eye-slash"></i>
                                </div> --}}
                                <select name="month" class="form-select">
                                    @foreach ($months as $key => $month)
                                        <option value="{{ $key }}"
                                            {{ $selectedMonth == $key ? 'selected' : '' }}>
                                            {{ $month }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a class="btn btn-dark btn-icon btn-sm"
                                href="{{ route('maintenance.index') }}"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Reset">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                            <a href="{{ route('maintenance') }}" class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i> Export to Excel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card end -->
        </div>
        <div class="col-sm-12 col-12">
            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Kendaraan</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="highlightRowColumn" class="table custom-table text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Registrasi</th>
                                    <th>Unit Kerja</th>
                                    <th>Total Belanja</th>
                                    <th>Kadaluarsa Pajak</th>
                                    <th>Bulan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintenances as $index => $maintenance)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $maintenance->kendaraan->nomor_registrasi }}</td>
                                        <td>{{ $maintenance->kendaraan->unitKerja->nama_unit_kerja }}</td>
                                        <td>Rp.
                                            {{ number_format($maintenance->totalSemuaBelanja() ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span hidden>
                                                {{ date('Y/m/d', strtotime($maintenance->berlaku_sampai)) }}
                                            </span>
                                            <span
                                                class="badge {{ strtotime($maintenance->berlaku_sampai) < time() ? 'shade-red' : 'shade-green' }} min-90">
                                                {{ \Carbon\Carbon::parse($maintenance->berlaku_sampai)->translatedFormat('d F Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($maintenance->tanggal_maintenance)->translatedFormat('F Y') }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-icon show-details"
                                                data-bs-toggle="modal" data-bs-target="#scrollable"
                                                data-id="{{ $maintenance->id }}"
                                                data-nomor-registrasi="{{ $maintenance->kendaraan->nomor_registrasi }}"
                                                data-bahan-bakar-minyak="{{ $maintenance->totalBelanjaBahanBakarMinyak() }}"
                                                data-pelumas-mesin="{{ $maintenance->totalBelanjaPelumasMesin() }}"
                                                data-suku-cadang="{{ $maintenance->totalBelanjaSukuCadang() }}"
                                                data-total-belanja="{{ $maintenance->totalSemuaBelanja() }}"
                                                data-tanggal-belanja="{{ \Carbon\Carbon::parse($maintenance->tanggal_maintenance)->translatedFormat('F') }}"
                                                data-keterangan="{{ $maintenance->keterangan }}"
                                                data-kadaluarsa-pajak="{{ \Carbon\Carbon::parse($maintenance->berlaku_sampai)->translatedFormat('d F Y') }}"
                                                data-unit-kerja="{{ $maintenance->kendaraan->unitKerja->nama_unit_kerja }}">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Card end -->
        </div>
        {{-- Modal Maintenance --}}
        <div class="modal fade" id="scrollable" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollableLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableLabel">Data Maintenance - <span
                                id="modalTanggalBelanja"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nomor Registrasi:</strong> <span id="modalNomorRegistrasi"></span></p>
                                <p><strong>Kadaluarsa Pajak:</strong> <span id="modalKadaluarsaPajak"></span></p>
                                <p><strong>Unit Kerja:</strong> <span id="modalUnitKerja"></span></p>
                                <p><strong>Keterangan:</strong> <span id="modalKeterangan"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Belanja BBM:</strong> Rp. <span id="modalBahanBakarMinyak"></span></p>
                                <p><strong>Belanja Pelumas:</strong> Rp. <span id="modalPelumasMesin"></span></p>
                                <p><strong>Belanja Suku Cadang:</strong> Rp. <span id="modalSukuCadang"></span></p>
                                <p><strong>Total Belanja:</strong> Rp. <span id="modalTotalBelanja"></span></p>
                            </div>
                            <div class="col-md-12 mt-5">
                                <table id="highlightRowColumn" class="table custom-table text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Belanja BBM</th>
                                            <th>Belanja Pelumas</th>
                                            <th>Belanja Suku Cadang</th>
                                            <th>Tanggal Belanja</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalTableBody">
                                        <!-- Data will be populated here dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
@endsection

@section('script')
    {{-- Custom --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailButtons = document.querySelectorAll('.show-details');
            const modal = document.getElementById('scrollable');

            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const nomorRegistrasi = this.getAttribute('data-nomor-registrasi');
                    const bahanBakarMinyak = parseInt(this.getAttribute(
                        'data-bahan-bakar-minyak') || 0);
                    const pelumasMesin = parseInt(this.getAttribute('data-pelumas-mesin') || 0);
                    const sukuCadang = parseInt(this.getAttribute('data-suku-cadang') || 0);
                    const totalBelanja = parseInt(this.getAttribute('data-total-belanja') || 0);
                    const tanggalBelanja = this.getAttribute('data-tanggal-belanja');
                    const kadaluarsaPajak = this.getAttribute('data-kadaluarsa-pajak');
                    const keterangan = this.getAttribute('data-keterangan');
                    const unitKerja = this.getAttribute('data-unit-kerja');

                    document.getElementById('modalNomorRegistrasi').textContent = nomorRegistrasi;
                    document.getElementById('modalBahanBakarMinyak').textContent = bahanBakarMinyak
                        .toLocaleString('id-ID');
                    document.getElementById('modalPelumasMesin').textContent = pelumasMesin
                        .toLocaleString('id-ID');
                    document.getElementById('modalSukuCadang').textContent = sukuCadang
                        .toLocaleString('id-ID');
                    document.getElementById('modalTotalBelanja').textContent = totalBelanja
                        .toLocaleString('id-ID');
                    document.getElementById('modalTanggalBelanja').textContent = tanggalBelanja;
                    document.getElementById('modalKadaluarsaPajak').textContent = kadaluarsaPajak;
                    document.getElementById('modalKeterangan').textContent = keterangan;
                    document.getElementById('modalUnitKerja').textContent = unitKerja;

                    // Fetch detailed belanja data
                    $.ajax({
                        url: `maintenance/get-belanja-details/${id}`,
                        method: 'GET',
                        success: function(data) {
                            // Sort data by tanggal_belanja in descending order
                            data.sort((a, b) => {
                                const dateA = a.tanggal_belanja.split('-')
                                    .reverse().join('-');
                                const dateB = b.tanggal_belanja.split('-')
                                    .reverse().join('-');
                                return new Date(dateB) - new Date(dateA);
                            });

                            const tableBody = document.getElementById('modalTableBody');
                            tableBody.innerHTML = ''; // Clear existing content
                            let no = 1;
                            data.forEach(item => {
                                const row = `
                                    <tr>
                                        <td>${no++}</td>
                                        <td>Rp. ${(item.belanja_bahan_bakar_minyak || 0).toLocaleString('id-ID')}</td>
                                        <td>Rp. ${(item.belanja_pelumas_mesin || 0).toLocaleString('id-ID')}</td>
                                        <td>Rp. ${(item.belanja_suku_cadang || 0).toLocaleString('id-ID')}</td>
                                        <td>${item.tanggal_belanja}</td>
                                        <td>${item.keterangan || ''}</td>
                                    </tr>
                                `;
                                tableBody.innerHTML += row;
                            });
                        },
                        error: function(error) {
                            console.error('Error fetching belanja details:', error);
                            document.getElementById('modalTableBody').innerHTML =
                                '<tr><td colspan="6">Error loading data</td></tr>';
                        }
                    });
                });
            });           
        });       
    </script>
    <!-- Data Tables -->
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap.min.js') }}"></script>

    <!-- Custom Data tables -->
    <script src="{{ asset('vendor/datatables/custom/custom-datatables.js') }}"></script>
@endsection
