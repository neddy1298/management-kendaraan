@extends('layouts.app', ['page' => 'Master Data', 'page2' => 'Kepala Keluarga', 'page3' => 'Semua'])

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bs5.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bs5-custom.css') }}" />
@endsection

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-body">
                    <div class="custom-btn-group">
                        <a href="{{ route('kepala_keluarga.create') }}" class="btn btn-warning"><i
                                class="bi bi-pencil-square"></i> Tambah Baru</a>
                        <a href="{{ route('kepala_keluarga.printAll') }}" class="btn btn-primary" target="_blank"><i class="bi bi-printer"></i>
                            Cetak</a>
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
                    <div class="card-title">Data Pemohon</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>NKK</th>
                                    <th>Nama Kepala Keluarga</th>
                                    <th>RT/RW</th>
                                    <th>Alamat</th>
                                    <th>Plihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kepala_keluargas as $kepala_keluarga)
                                    <tr>
                                        <td>{{ $kepala_keluarga->nkk }}</td>
                                        <td>{{ $kepala_keluarga->nama_kepala_keluarga }}</td>
                                        <td>{{ $kepala_keluarga->rt }} / {{ $kepala_keluarga->rw }}</td>
                                        <td>{{ $kepala_keluarga->alamat }}</td>
                                        <td>
                                            <a href="{{ route('kepala_keluarga.edit', $kepala_keluarga->nkk) }}"
                                                class="btn btn-warning btn-icon" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Ubah"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="{{ route('kepala_keluarga.print', $kepala_keluarga->nkk) }}"
                                                class="btn btn-primary btn-icon" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Cetak" target="_blank"><i
                                                    class="bi bi-printer"></i></a>
                                            <form action="{{ route('kepala_keluarga.delete', $kepala_keluarga->nkk) }}"
                                                method="POST" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-icon"
                                                    onclick="return confirm('Kamu yakin ingin menghapus data: {{ $kepala_keluarga->nama_kepala_keluarga }} ?')"
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
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap.min.js') }}"></script>

    <!-- Custom Data tables -->
    <script src="{{ asset('vendor/datatables/custom/custom-datatables.js') }}"></script>
@endsection
