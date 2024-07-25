@extends('layouts.app', ['page' => 'Belanja', 'page2' => '', 'page3' => ''])

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ secure_asset('vendor/datatables/dataTables.bs5.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('vendor/datatables/dataTables.bs5-custom.css') }}" />
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
                        <a href="{{ route('belanja.create') }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i>
                            Tambah Baru</a>
                        <a href="" class="btn btn-primary" target="_blank"><i class="bi bi-printer"></i>
                            Cetak</a>
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
                                @php $no = 1 @endphp
                                @foreach ($belanjas as $belanja)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $belanja->nomor_registrasi }}</td>
                                        <td>Rp.
                                            {{ $belanja->belanja_bahan_bakar_minyak + $belanja->belanja_pelumas_mesin + $belanja->belanja_suku_cadang }}
                                        </td>
                                        <td>{{ date('d F Y', strtotime($belanja->tanggal_belanja)) }}</td>
                                        <td>{{ $belanja->keterangan }}</td>
                                        <td>
                                            {{-- <a href="{{ route('belanja.edit', $belanja->id) }}"
                                                class="btn btn-primary btn-icon" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Details">
                                                <i class="bi bi-search"></i>
                                            </a> --}}
                                            <button type="button" class="btn btn-primary btn-icon show-details"
                                                data-bs-toggle="modal" data-bs-target="#detailModal"
                                                data-nomor-registrasi="{{ $belanja->nomor_registrasi }}"
                                                data-bahan-bakar-minyak="{{ $belanja->belanja_bahan_bakar_minyak }}"
                                                data-pelumas-mesin="{{ $belanja->belanja_pelumas_mesin }}"
                                                data-suku-cadang="{{ $belanja->belanja_suku_cadangtanggal_belanja }}"
                                                data-total-belanja="{{ $belanja->belanja_bahan_bakar_minyak + $belanja->belanja_pelumas_mesin + $belanja->belanja_suku_cadangtanggal_belanja }}"
                                                data-tanggal-belanja="{{ date('d F Y', strtotime($belanja->tanggal_belanja)) }}"
                                                data-keterangan="{{ $belanja->keterangan }}">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
@endsection

@section('script')
    {{-- Custome Scripts --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailButtons = document.querySelectorAll('.show-details');
            const modal = document.getElementById('detailModal');
        
            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const nomorRegistrasi = this.getAttribute('data-nomor-registrasi');
                    const bahanBakarMinyak = parseInt(this.getAttribute('data-bahan-bakar-minyak') || 0);
                    const pelumasMesin = parseInt(this.getAttribute('data-pelumas-mesin') || 0);
                    const sukuCadang = parseInt(this.getAttribute('data-suku-cadang') || 0);
                    const totalBelanja = parseInt(this.getAttribute('data-total-belanja') || 0);
                    const tanggalBelanja = this.getAttribute('data-tanggal-belanja');
                    const keterangan = this.getAttribute('data-keterangan');
        
                    document.getElementById('modalNomorRegistrasi').textContent = nomorRegistrasi;
                    document.getElementById('modalBahanBakarMinyak').textContent = bahanBakarMinyak.toLocaleString('id-ID');
                    document.getElementById('modalPelumasMesin').textContent = pelumasMesin.toLocaleString('id-ID');
                    document.getElementById('modalSukuCadang').textContent = sukuCadang.toLocaleString('id-ID');
                    document.getElementById('modalTotalBelanja').textContent = totalBelanja.toLocaleString('id-ID');
                    document.getElementById('modalTanggalBelanja').textContent = tanggalBelanja;
                    document.getElementById('modalKeterangan').textContent = keterangan;
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
