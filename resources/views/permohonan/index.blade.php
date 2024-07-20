@extends('layouts.app', ['page' => 'Permohonan', 'page2' => 'KTP', 'page3' => ''])

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
                        <a href="{{ route('permohonan.create') }}" class="btn btn-warning"><i
                                class="bi bi-pencil-square"></i> Tambah Baru</a>
                        <a href="{{ route('permohonan.printAll') }}" class="btn btn-primary" target="_blank"><i class="bi bi-printer"></i>
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
                                    <th>NIK</th>
                                    <th>NKK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jenis Permohonan</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Permohonan</th>
                                    <th>Plihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permohonans as $permohonan)
                                    <tr>
                                        <td>{{ $permohonan->nik }}</td>
                                        <td>{{ $permohonan->nkk }}</td>
                                        <td>{{ $permohonan->nama }}</td>
                                        <td>{{ $permohonan->jenis_kelamin }}</td>
                                        <td>{{ $permohonan->keterangan }}</td>
                                        <td>{{ $permohonan->jenis_permohonan }}</td>
                                        <td>{{ $permohonan->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="{{ route('permohonan.edit', $permohonan->id) }}"
                                                class="btn btn-warning btn-icon mt-1" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Ubah"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="{{ route('permohonan.print', $permohonan->id) }}"
                                                class="btn btn-primary btn-icon mt-1" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Cetak" target="_blank"><i
                                                    class="bi bi-printer"></i></a>
                                            <form action="{{ route('permohonan.delete', $permohonan->id) }}"
                                                method="POST" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-icon mt-1"
                                                    onclick="return confirm('Kamu yakin ingin menghapus data: {{ $permohonan->nama }} ?')"
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
