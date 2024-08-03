@extends('layouts.app', ['page' => 'Master', 'page2' => 'Unit Kerja', 'page3' => ''])

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bs5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bs5-custom.css') }}">
@endsection

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-12">
            @php
                $message =
                    "Contoh message yang akan dikirim ke WA\n-1. lorem ipsum dolor sit amet consectetur adipiscing elit\n2. lorem ipsum dolor sit amet consectetur adipiscing elit\n3. lorem ipsum dolor sit amet consectetur adipiscing elit\n4. lorem ipsum dolor sit amet consectetur adipiscing elit\n5. lorem ipsum dolor sit amet consectetur adipiscing elit";
            @endphp
            <!-- Card start -->
            <div class="card">
                <div class="card-body">
                    <div class="custom-btn-group">
                        <a href="{{ route('unitKerja.create') }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Tambah Baru
                        </a>
                        <a href="{{ route('send-wa', ['message' => urlencode($message)]) }}" class="btn btn-success"
                            target="_blank">
                            <i class="bi bi-whatsapp"></i> Kirim WA
                        </a>
                    </div>
                </div>
            </div>
            <!-- Card end -->
        </div>

        <div class="col-sm-12 col-12">
            @if (session('success'))
                @include('partials.alert', ['type' => 'success', 'message' => session('success')])
            @elseif (session('error'))
                @include('partials.alert', ['type' => 'danger', 'message' => session('error')])
            @endif

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Kendaraan</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="highlightRowColumn" class="table custom-table text-center v-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Unit Kerja</th>
                                    <th>Nama Group</th>
                                    <th>Budget Total</th>
                                    <th>Jumlah Kendaraan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unitKerjas as $index => $unitKerja)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $unitKerja->nama_unit_kerja }}</td>
                                        <td>{{ $unitKerja->groupAnggaran->nama_group }}</td>
                                        <td>Rp. {{ number_format($unitKerja->groupAnggaran->anggaran_total, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $unitKerja->kendaraans_count }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-icon show-details"
                                                data-bs-toggle="modal" data-bs-target="#scrollable"
                                                data-unit-kerja-id="{{ $unitKerja->id }}"
                                                data-nama-unit-kerja="{{ $unitKerja->nama_unit_kerja }}"
                                                data-anggaran-total="{{ $unitKerja->groupAnggaran->anggaran_total }}"
                                                data-nama-group="{{ $unitKerja->groupAnggaran->nama_group }}"
                                                data-jumlah-kendaraan="{{ $unitKerja->kendaraans_count }}">
                                                <i class="bi bi-search"></i>
                                            </button>
                                            <a href="{{ route('unitKerja.edit', $unitKerja->id) }}"
                                                class="btn btn-warning btn-icon" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('unitKerja.delete', $unitKerja->id) }}" method="POST"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-icon btn-sm"
                                                    onclick="return confirm('Kamu yakin ingin menghapus data: {{ $unitKerja->nomor_registrasi }} ?')"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
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

        <div class="modal fade" id="scrollable" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollableLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableLabel">Data Unit Kerja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Nama Unit Kerja:</strong> <span id="modalNamaUnitKerja"></span></p>
                                <p><strong>Nama Group:</strong> <span id="modalNamaGroup"></span></p>
                                <p><strong>Anggaran Total:</strong> Rp <span id="modalAnggaranTotal"></span></p>
                                <p><strong>Jumlah Kendaraan:</strong> <span id="modalJumlahKendaraan"></span></p>
                            </div>
                            <div class="col-md-12 mt-5">
                                <table id="highlightRowColumn" class="table custom-table text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Registrasi</th>
                                            <th>Merk</th>
                                            <th>Jenis</th>
                                            <th>BBM</th>
                                            <th>Roda</th>
                                            <th>CC</th>
                                            <th>Pajak</th>
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
                    const id = this.getAttribute('data-unit-kerja-id');
                    const namaUnitKerja = this.getAttribute('data-nama-unit-kerja');
                    const namaGroup = this.getAttribute('data-nama-group');
                    const anggaranTotal = parseInt(this.getAttribute(
                        'data-anggaran-total') || 0).toLocaleString('id-ID');
                    const jumlahKendaraan = parseInt(this.getAttribute('data-jumlah-kendaraan') ||
                        0);

                    document.getElementById('modalNamaUnitKerja').textContent = namaUnitKerja;
                    document.getElementById('modalNamaGroup').textContent = namaGroup;
                    document.getElementById('modalAnggaranTotal').textContent =
                        anggaranTotal;
                    document.getElementById('modalJumlahKendaraan').textContent = jumlahKendaraan;

                    // Fetch kendaraan data
                    $.ajax({
                        url: `unitKerja/get-unitkerja-details/${id}`,
                        method: 'GET',
                        success: function(data) {
                            const tableBody = document.getElementById('modalTableBody');
                            tableBody.innerHTML = ''; // Clear existing content
                            let no = 1;

                            // Iterate over kendaraans
                            data.kendaraans.forEach(item => {
                                const row = `
                                    <tr>
                                        <td>${no++}</td>
                                        <td>${item.nomor_registrasi}</td>
                                        <td>${(item.merk_kendaraan || '-')}</td>
                                        <td>${(item.jenis_kendaraan || '-')}</td>
                                        <td>${(item.bbm_kendaraan || '-')}</td>
                                        <td>${(item.roda_kendaraan || '-')}</td>
                                        <td>${(item.cc_kendaraan || 0).toLocaleString('id-ID')} CC</td>
                                        <td>${(item.isExpire)}</td>
                                    </tr>
                                `;
                                tableBody.innerHTML += row;
                            });
                        },
                        error: function(error) {
                            console.error('Error fetching unit kerja details:', error);
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
