@extends('layouts.app', ['page' => 'Belanja', 'page2' => '', 'page3' => ''])

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ secure_asset('vendor/datatables/dataTables.bs5.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('vendor/datatables/dataTables.bs5-custom.css') }}" />


    <!-- Date Range CSS -->
    <link rel="stylesheet" href="{{ secure_asset('vendor/daterange/daterange.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-green">
                    <h4 class="text-white">Rp</h4>
                </div>
                <div class="sale-details">
                    <h3 class="text-green">
                        {{ number_format($belanja_periode, 0, ',', '.') }}.00
                    </h3>
                    <p>Total Belanja
                        @if (isset($dateRange))
                            {{ \Carbon\Carbon::createFromFormat('d/m/Y', trim(explode(' - ', $dateRange)[0]))->format('d M Y') }}
                            -
                            {{ \Carbon\Carbon::createFromFormat('d/m/Y', trim(explode(' - ', $dateRange)[1]))->format('d M Y') }}
                        @else
                            Semua Periode
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Row start -->
        <div class="col-xxl-4 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-yellow">
                    <h4 class="text-white">Rp</h4>
                </div>
                <div class="sale-details">
                    <h3 class="text-yellow">
                        {{ number_format($belanja_bbm_periode, 0, ',', '.') }}
                    </h3>
                    <p>Total Belanja Bahan Bakar</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6 col-12">
            <a href="{{ route('masterAnggaran.index') }}">
                <div class="stats-tile">
                    <div class="sale-icon shade-blue">
                        <h4 class="text-white">Rp</h4>
                    </div>
                    <div class="sale-details">
                        <h3 class="text-blue">
                            {{ number_format($belanja_pelumas_periode, 0, ',', '.') }}
                        </h3>
                        <p>Total Belanja Pelumas</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-4 col-sm-6 col-12">
            <a href="{{ route('masterAnggaran.index') }}">
                <div class="stats-tile">
                    <div class="sale-icon shade-red">
                        <h4 class="text-white">Rp</h4>
                    </div>
                    <div class="sale-details">
                        <h3 class="text-danger">
                            {{ number_format($belanja_suku_cadang_periode, 0, ',', '.') }}
                        </h3>
                        <p>Total Belanja Suku Cadang</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('belanja.index') }}" method="GET" class="row align-items-center">
                        <div class="col-sm-12 col-lg-4 col-xxl-4">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar2"></i>
                                </span>
                                <input type="text" class="form-control datepicker-range" name="date-range">
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3 col-xxl-3">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a class="btn btn-dark btn-icon btn-sm" href="{{ route('belanja.index') }}"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Reset">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        </div>
                        <div class="col-sm-12 col-lg-5 col-xxl-5 custom-btn-group justify-content-end">
                            <a href="{{ route('belanja.create') }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i> Tambah Baru
                            </a>
                            <a href="{{ route('belanja.printAll') }}" class="btn btn-primary" target="_blank">
                                <i class="bi bi-printer"></i> Cetak
                            </a>
                            @php
                                $message =
                                    "Contoh message yang akan dikirim ke WA\n-1. lorem ipsum dolor sit amet consectetur adipiscing elit\n2. lorem ipsum dolor sit amet consectetur adipiscing elit\n3. lorem ipsum dolor sit amet consectetur adipiscing elit\n4. lorem ipsum dolor sit amet consectetur adipiscing elit\n5. lorem ipsum dolor sit amet consectetur adipiscing elit";
                            @endphp
                            <a href="{{ route('send-wa', ['message' => $message]) }}" class="btn btn-success"
                                target="_blank">
                                <i class="bi bi-whatsapp"></i> Kirim WA
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-12">
            @if (session('success'))
                @include('partials.alert', ['type' => 'success', 'message' => session('success')])
            @elseif (session('error'))
                @include('partials.alert', ['type' => 'danger', 'message' => session('error')])
            @endif

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
                                    <th>Nomor Registrasi</th>
                                    <th>Total Belanja</th>
                                    <th>Tanggal Belanja</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($belanjas as $index => $belanja)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $belanja->kendaraan->nomor_registrasi }}</td>
                                        <td>Rp.
                                            {{ number_format($belanja->belanja_bahan_bakar_minyak + $belanja->belanja_pelumas_mesin + $belanja->belanja_suku_cadang, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($belanja->tanggal_belanja)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ $belanja->keterangan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-icon show-details"
                                                data-bs-toggle="modal" data-bs-target="#detailModal"
                                                data-nomor-registrasi="{{ $belanja->kendaraan->nomor_registrasi }}"
                                                data-bahan-bakar-minyak="{{ $belanja->belanja_bahan_bakar_minyak }}"
                                                data-pelumas-mesin="{{ $belanja->belanja_pelumas_mesin }}"
                                                data-suku-cadang="{{ $belanja->belanja_suku_cadang }}"
                                                data-total-belanja="{{ $belanja->total_belanja }}"
                                                data-tanggal-belanja="{{ \Carbon\Carbon::parse($belanja->tanggal_belanja)->translatedFormat('d F Y') }}"
                                                data-keterangan="{{ $belanja->keterangan }}"
                                                data-id="{{ $belanja->id }}">
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
        </div>
    </div>
    <!-- ModalBelanja  -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Belanja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nomor Registrasi:</strong> <span id="modalNomorRegistrasi"></span></p>
                    <p><strong>Tanggal Belanja:</strong> <span id="modalTanggalBelanja"></span></p>
                    <p><strong>Belanja BBM:</strong> Rp. <span id="modalBahanBakarMinyak"></span>.00</p>
                    <p><strong>Belanja Pelumas:</strong> Rp. <span id="modalPelumasMesin"></span>.00</p>
                    <p><strong>Belanja Suku Cadang:</strong> Rp. <span id="modalSukuCadang"></span>.00</p>
                    <p><strong>Total Belanja:</strong> Rp. <span id="modalTotalBelanja"></span>.00</p>
                    <p><strong>Keterangan:</strong> <span id="modalKeterangan"></span></p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" style="display: inline-block" id="modalDeleteBelanja">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-icon btn-sm"
                            onclick="return confirm('Kamu yakin ingin menghapus data belanja?')" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.show-details').forEach(button => {
                button.addEventListener('click', function() {
                    const modal = document.getElementById('detailModal');
                    modal.querySelector('#modalNomorRegistrasi').textContent = this.getAttribute(
                        'data-nomor-registrasi');
                    modal.querySelector('#modalTanggalBelanja').textContent = this.getAttribute(
                        'data-tanggal-belanja');
                    modal.querySelector('#modalBahanBakarMinyak').textContent = parseInt(this
                        .getAttribute('data-bahan-bakar-minyak') || 0).toLocaleString('id-ID');
                    modal.querySelector('#modalPelumasMesin').textContent = parseInt(this
                        .getAttribute('data-pelumas-mesin') || 0).toLocaleString('id-ID');
                    modal.querySelector('#modalSukuCadang').textContent = parseInt(this
                        .getAttribute('data-suku-cadang') || 0).toLocaleString('id-ID');
                    modal.querySelector('#modalTotalBelanja').textContent = parseInt(this
                        .getAttribute('data-total-belanja') || 0).toLocaleString('id-ID');
                    modal.querySelector('#modalKeterangan').textContent = this.getAttribute(
                        'data-keterangan');
                    document.getElementById('modalDeleteBelanja').action =
                        "{{ route('belanja.delete', 'id') }}".replace('id', this.getAttribute(
                            'data-id'));
                });
            });
        });
    </script>

    <!-- Data Tables -->
    <script src="{{ secure_asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/datatables/custom/custom-datatables.js') }}"></script>


    <!-- Date Range JS -->
    <script src="{{ secure_asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
