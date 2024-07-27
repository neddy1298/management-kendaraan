@extends('layouts.app', ['page' => 'Kendaraan', 'page2' => '', 'page3' => ''])

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
                        <a href="{{ route('kendaraan.create') }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Tambah Baru
                        </a>
                        <a href="{{ route('kendaraan.printAll') }}" class="btn btn-primary" target="_blank">
                            <i class="bi bi-printer"></i> Cetak
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

            <div class="card">
                <div class="card-body">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs" id="customTab3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-oneAA" data-bs-toggle="tab" href="#oneAA" role="tab"
                                    aria-controls="oneAA" aria-selected="true"><i class="bi bi-truck"></i>Data Kendaraan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-twoAA" data-bs-toggle="tab" href="#twoAA" role="tab"
                                    aria-controls="twoAA" aria-selected="false"><i class="bi bi-pie-chart"></i>Tab Two</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-threeAA" data-bs-toggle="tab" href="#threeAA" role="tab"
                                    aria-controls="threeAA" aria-selected="false"><i class="bi bi-printer"></i>Tab Three</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent3">
                            <div class="tab-pane fade show active" id="oneAA" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="highlightRowColumn" class="table custom-table text-center v-middle">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor Registrasi</th>
                                                <th>Merk Kendaraan</th>
                                                <th>Jenis Kendaraan</th>
                                                <th>CC Kendaraan</th>
                                                <th>BBM Kendaraan</th>
                                                <th>Roda Kendaraan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kendaraans as $index => $kendaraan)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $kendaraan->nomor_registrasi }}</td>
                                                    <td>{{ $kendaraan->merk_kendaraan }}</td>
                                                    <td>{{ $kendaraan->jenis_kendaraan }}</td>
                                                    <td>{{ $kendaraan->cc_kendaraan }} CC</td>
                                                    <td>{{ $kendaraan->bbm_kendaraan }}</td>
                                                    <td>Roda {{ $kendaraan->roda_kendaraan }}</td>
                                                    <td>
                                                        <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                                                            class="btn btn-warning btn-icon" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('kendaraan.delete', $kendaraan->id) }}"
                                                            method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-icon btn-sm"
                                                                onclick="return confirm('Kamu yakin ingin menghapus data: {{ $kendaraan->nomor_registrasi }} ?')"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Hapus">
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
                            <div class="tab-pane fade" id="twoAA" role="tabpanel">
                                <p>Tab Content B</p>
                            </div>
                            <div class="tab-pane fade" id="threeAA" role="tabpanel">
                                <p>Tab Content C</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
@endsection

@section('script')
    <!-- Data Tables -->
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap.min.js') }}"></script>

    <!-- Custom Data tables -->
    <script src="{{ asset('vendor/datatables/custom/custom-datatables.js') }}"></script>
@endsection
