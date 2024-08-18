@extends('layouts.app', ['page' => 'Kendaraan', 'page2' => '', 'page3' => ''])

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ secure_asset('vendor/datatables/dataTables.bs5.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/datatables/dataTables.bs5-custom.css') }}">
@endsection

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-xxl-4 col-sm-6 col-12">
            <a href="#">
                <div class="stats-tile">
                    <div class="sale-icon shade-red">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="sale-details">
                        <h3 class="text-red">{{ $isExpire }}/{{ $kendaraans->count() }}</h3>
                        <p>Kadaluarsa Pajak</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12">
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
                        <a href="{{ route('send-wa') }}" class="btn btn-success" target="_blank">
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
                                    <th>Nomor Registrasi</th>
                                    <th>Merk Kendaraan</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>CC Kendaraan</th>
                                    <th>BBM Kendaraan</th>
                                    <th>Roda Kendaraan</th>
                                    <th>Kadaluarsa Pajak</th>
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
                                        <td>{{ $kendaraan->cc_kendaraan }}</td>
                                        <td>{{ $kendaraan->bbm_kendaraan }}</td>
                                        <td>Roda {{ $kendaraan->roda_kendaraan }}</td>
                                        <td>
                                            <span hidden> {{ $kendaraan->berlaku_sampai }}
                                            </span>
                                            @if ($kendaraan->berlaku_sampai->ispast())
                                                <span class="badge shade-red">
                                                    {{ $kendaraan->berlaku_sampai->translatedformat('d F Y') }}
                                                </span>
                                            @else
                                                {{ $kendaraan->berlaku_sampai->translatedformat('d F Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="custom-btn-group">
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
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                            </div>
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
