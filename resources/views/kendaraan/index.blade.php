@extends('layouts.app', ['page' => 'Kendaraan', 'page2' => '', 'page3' => ''])

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
                        <a href="{{ route('kendaraan.create') }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i>
                            Tambah Baru</a>
                        <a href="{{ route('kendaraan.printAll') }}" class="btn btn-primary" target="_blank"><i
                                class="bi bi-printer"></i>
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
                                    <th>Merk Kendaraan</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>CC Kendaraan</th>
                                    <th>BBM Kendaraan</th>
                                    <th>Roda Kendaraan</th>
                                    <th>Berlaku Sampai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1 @endphp
                                @foreach ($kendaraans as $kendaraan)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $kendaraan->nomor_registrasi }}</td>
                                        <td>{{ $kendaraan->merk_kendaraan }}</td>
                                        <td>{{ $kendaraan->jenis_kendaraan }}</td>
                                        <td>{{ $kendaraan->cc_kendaraan }} CC</td>
                                        <td>{{ $kendaraan->bbm_kendaraan }}</td>
                                        <td>Roda {{ $kendaraan->roda_kendaraan }}</td>
                                        <td>{{ date('d F Y', strtotime($kendaraan->berlaku_sampai)) }}</td>
                                        <td>
                                            <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                                                class="btn btn-warning btn-icon" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('kendaraan.delete', $kendaraan->id) }}" method="POST"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-icon btn-sm mt-2"
                                                    onclick="return confirm('Kamu yakin ingin menghapus data: {{ $kendaraan->nomor_registrasi }} ?')"
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
    </div>
    <!-- Row end -->
@endsection

@section('script')
    <!-- Data Tables -->
    <script src="{{ secure_asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/datatables/dataTables.bootstrap.min.js') }}"></script>

    <!-- Custom Data tables -->
    <script src="{{ secure_asset('vendor/datatables/custom/custom-datatables.js') }}"></script>
@endsection