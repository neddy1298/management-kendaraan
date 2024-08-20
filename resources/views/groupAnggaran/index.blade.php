@extends('layouts.app', ['page' => 'Anggaran', 'page2' => 'Group', 'page3' => ''])

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ secure_asset('vendor/datatables/dataTables.bs5.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/datatables/dataTables.bs5-custom.css') }}">
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
                        <a href="{{ route('groupAnggaran.create') }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Tambah Baru
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
                    <div class="card-title">Sub Rincian Objek</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="highlightRowColumn" class="table custom-table text-center v-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Rekening</th>
                                    <th>Nama Rekening</th>
                                    <th>Kebutuhan Belanja</th>
                                    <th>Total</th>
                                    <th>Tahun</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupAnggarans as $index => $groupAnggaran)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a href="{{ route('groupAnggaran.edit', $groupAnggaran->id) }}"
                                                class="text-primary">
                                                {{ $groupAnggaran->kode_rekening }}
                                            </a>
                                        </td>
                                        <td class="text-start">{{ $groupAnggaran->nama_group }}</td>
                                        <td>{{ $groupAnggaran->tipe_belanja }}</td>
                                        <td>Rp {{ number_format($groupAnggaran->total_anggaran ?? 0, 0, ',', '.') }}</td>
                                        <td>{{ $groupAnggaran->masterAnggaran->paguAnggaran->tahun }}</td>
                                        <td>
                                            <div class="custom-btn-group">
                                                <a href="{{ route('groupAnggaran.edit', $groupAnggaran->id) }}"
                                                    class="btn btn-warning btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('groupAnggaran.delete', $groupAnggaran->id) }}"
                                                    method="POST" style="display: inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-icon btn-sm"
                                                        onclick="return confirm('Kamu yakin ingin menghapus data: {{ $groupAnggaran->nama_group }} ?')"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
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
