@extends('layouts.app', ['page' => 'Master Data', 'page2' => 'Penduduk', 'page3' => ''])

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
                        <a href="{{ route('penduduk.create') }}" class="btn btn-warning"><i
                                class="bi bi-pencil-square"></i> Tambah Baru</a>
                        <a href="{{ route('penduduk.printAll') }}" class="btn btn-primary" target="_blank"><i class="bi bi-printer"></i>
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
                                    <th>Tempat/Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>RT/RW</th>
                                    <th>Kelurahan / Desa</th>
                                    <th>Kecamatan</th>
                                    <th>Plihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penduduks as $penduduks)
                                    <tr>
                                        <td>{{ $penduduks->nik }}</td>
                                        <td>{{ $penduduks->nkk }}</td>
                                        <td>{{ $penduduks->nama }}</td>
                                        <td>{{ $penduduks->tempat_lahir }}, {{ $penduduks->tanggal_lahir->format('d-m-Y') }}</td>
                                        <td>{{ $penduduks->alamat }}</td>
                                        <td>{{ $penduduks->rt }}/{{ $penduduks->rw }}</td>
                                        <td>{{ $penduduks->kelurahan_desa }}</td>
                                        <td>{{ $penduduks->kecamatan }}</td>
                                        <td>
                                            <a href="{{ route('penduduk.edit', $penduduks->nik) }}"
                                                class="btn btn-warning btn-icon" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Ubah"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="{{ route('penduduk.print', $penduduks->nik) }}"
                                                class="btn btn-primary btn-icon mt-1" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Cetak" target="_blank"><i
                                                    class="bi bi-printer"></i></a>
                                            <form action="{{ route('penduduk.delete', $penduduks->nik) }}"
                                                method="POST" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-icon mt-1"
                                                    onclick="return confirm('Kamu yakin ingin menghapus data: {{ $penduduks->nama }} ?')"
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
