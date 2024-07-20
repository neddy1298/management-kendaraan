@extends('layouts.app', ['page' => 'Kendaraan', 'page2' => '', 'page3' => ''])

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
                    <a href="{{ route('kendaraan.create') }}" class="btn btn-warning"><i
                            class="bi bi-pencil-square"></i> Tambah Baru</a>
                    <a href="{{ route('kendaraan.printAll') }}" class="btn btn-primary" target="_blank"><i class="bi bi-printer"></i>
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
                    <div class="card-title">Highlight Row Column</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="highlightRowColumn" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Plat Nomor</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Keterangan</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1 @endphp
                                @foreach ($kendaraans as $kendaraan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $kendaraan->plat_nomor }}</td>
                                    <td>{{ $kendaraan->jumlah_roda }}</td>
                                    <td>{{ $kendaraan->keterangan }}</td>
                                    <td>{{ $kendaraan->created_at }}</td>
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
