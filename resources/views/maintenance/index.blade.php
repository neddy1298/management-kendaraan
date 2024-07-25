@extends('layouts.app', ['page' => 'Maintenance', 'page2' => 'Master', 'page3' => ''])

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ secure_asset('vendor/datatables/dataTables.bs5.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('vendor/datatables/dataTables.bs5-custom.css') }}" />
@endsection

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-12">
            <!-- Card start -->
            <div class="card">
                <div class="card-body">
                    <div class="custom-btn-group">
                        @php
                            $message = "Contoh message yang akan dikirim ke WA\n-1. lorem ipsum dolor sit amet consectetur adipiscing elit\n2. lorem ipsum dolor sit amet consectetur adipiscing elit\n3. lorem ipsum dolor sit amet consectetur adipiscing elit\n4. lorem ipsum dolor sit amet consectetur adipiscing elit\n5. lorem ipsum dolor sit amet consectetur adipiscing elit";
                        @endphp
                        <a href="{{ route('send-wa', $message) }}" class="btn btn-success" target="_blank"><i
                                class="bi bi-whatsapp"></i>
                            Kirim WA</a>
                    </div>
                </div>
            </div>
            <!-- Card end -->
        </div>
        <div class="col-sm-12 col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle alert-icon"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle alert-icon"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
                                        <th>Belanja BBM</th>
                                        <th>Belanja Pelumas</th>
                                        <th>Belanja Suku Cadang</th>
                                        <th>Unit Kerja</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1 @endphp
                                    @foreach ($maintenances as $maintenance)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $maintenance->nomor_registrasi }}</td>
                                            <td>Rp. {{ $maintenance->belanja_bahan_bakar_minyak ?? 0 }}</td>
                                            <td>Rp. {{ $maintenance->belanja_pelumas_mesin ?? 0 }}</td>
                                            <td>Rp. {{ $maintenance->belanja_suku_cadang ?? 0 }}</td>
                                            <td>{{ $maintenance->nama_group }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-icon show-details"
                                                    data-bs-toggle="modal" data-bs-target="#scrollable"
                                                    data-nomor-registrasi="{{ $maintenance->nomor_registrasi }}"
                                                    data-bahan-bakar-minyak="{{ $maintenance->belanja_bahan_bakar_minyak }}"
                                                    data-pelumas-mesin="{{ $maintenance->belanja_pelumas_mesin }}"
                                                    data-suku-cadang="{{ $maintenance->belanja_suku_cadang }}"
                                                    data-total-belanja="{{ $maintenance->belanja_bahan_bakar_minyak + $maintenance->belanja_pelumas_mesin + $maintenance->belanja_suku_cadang }}"
                                                    data-tanggal-belanja="{{ date('F', strtotime($maintenance->tanggal_belanja)) }}"
                                                    data-keterangan="{{ $maintenance->keterangan }}"
                                                    data-unit-kerja="{{ $maintenance->nama_group }}">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                                <a href="{{ route('maintenance.edit', $maintenance->id) }}"
                                                    class="btn btn-warning btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
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
                        <h5 class="modal-title" id="scrollableLabel">Data Maintenance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nomor Registrasi:</strong> <span id="modalNomorRegistrasi"></span></p>
                                <p><strong>Belanja Bulan:</strong> <span id="modalTanggalBelanja"></span></p>
                                <p><strong>Unit Kerja:</strong> <span id="modalUnitKerja"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Belanja BBM:</strong> Rp. <span id="modalBahanBakarMinyak"></span></p>
                                <p><strong>Belanja Pelumas:</strong> Rp. <span id="modalPelumasMesin"></span></p>
                                <p><strong>Belanja Suku Cadang:</strong> Rp. <span id="modalSukuCadang"></span></p>
                                <p><strong>Total Belanja:</strong> Rp. <span id="modalTotalBelanja"></span></p>
                            </div>
                            <div class="col-md-12"> 
                                <p><strong>Keterangan:</strong> <span id="modalKeterangan"></span></p>
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
    {{-- Custome --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailButtons = document.querySelectorAll('.show-details');
            const modal = document.getElementById('scrollable');

            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const nomorRegistrasi = this.getAttribute('data-nomor-registrasi');
                    const bahanBakarMinyak = parseInt(this.getAttribute(
                        'data-bahan-bakar-minyak') || 0);
                    const pelumasMesin = parseInt(this.getAttribute('data-pelumas-mesin') || 0);
                    const sukuCadang = parseInt(this.getAttribute('data-suku-cadang') || 0);
                    const totalBelanja = parseInt(this.getAttribute('data-total-belanja') || 0);
                    const tanggalBelanja = this.getAttribute('data-tanggal-belanja');
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
                    document.getElementById('modalKeterangan').textContent = keterangan;
                    document.getElementById('modalUnitKerja').textContent = unitKerja;

                    // Fetch detailed belanja data
                    $.ajax({
                        url: `maintenance/get-belanja-details/${nomorRegistrasi}`,
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
                                        <td>${(item.tanggal_belanja)}</td>
                                        <td>${item.keterangan || ''}</td>
                                    </tr>
                                `;
                                tableBody.innerHTML += row;
                            });
                        },
                        error: function(error) {
                            console.error('Error fetching belanja details:', error);
                            document.getElementById('modalTableBody').innerHTML =
                                '<tr><td colspan="4">Error loading data</td></tr>';
                        }
                    });
                });
            });
        });
    </script>
    <!-- Data Tables -->
    <script src="{{ secure_asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/datatables/dataTables.bootstrap.min.js') }}"></script>

    <!-- Custom Data tables -->
    <script src="{{ secure_asset('vendor/datatables/custom/custom-datatables.js') }}"></script>
@endsection
