@extends('layouts.app', ['page' => 'Master Data', 'page2' => 'Kepala Keluarga', 'page3' => 'create'])

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/daterange/daterange.css') }}">
@endsection

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah KK Baru</div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kepala_keluarga.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Row start -->
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputnkk" class="form-label">Nomor Kartu Keluarga (NKK)</label>
                                    <input type="number" class="form-control {{ $errors->has('nkk') ? 'is-invalid' : '' }}"
                                        id="nkk" value="{{ old('nkk') }}" name="nkk">
                                    @if ($errors->has('nkk'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nkk') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputnama_kepala_keluarga" class="form-label">Nama Kepala Keluarga</label>
                                    <input type="text" class="form-control {{ $errors->has('nama_kepala_keluarga') ? 'is-invalid' : '' }}"
                                        id="nama_kepala_keluarga" value="{{ old('nama_kepala_keluarga') }}" name="nama_kepala_keluarga">
                                    @if ($errors->has('nama_kepala_keluarga'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nama_kepala_keluarga') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputrt" class="form-label">RT</label>
                                    <input type="number" class="form-control {{ $errors->has('rt') ? 'is-invalid' : '' }}"
                                        id="rt" value="{{ old('rt') }}" name="rt">
                                    @if ($errors->has('rt'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('rt') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputrw" class="form-label">RW</label>
                                    <input type="number" class="form-control {{ $errors->has('rw') ? 'is-invalid' : '' }}"
                                        id="rw" value="{{ old('rw') }}" name="rw">
                                    @if ($errors->has('rw'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('rw') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputalamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="inputalamat" rows="3" value="{{ old('alamat') }}" name="alamat"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('kepala_keluarga.index') }}">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        <!-- Form actions footer end -->
                    </form>

                </div>
            </div>
            <!-- Card end -->

        </div>
    </div>
    <!-- Row end -->
@endsection

@section('script')
    <!-- Date Range JS -->
    <script src="{{ asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
