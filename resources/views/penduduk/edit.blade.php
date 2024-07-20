@extends('layouts.app', ['page' => 'Master Data', 'page2' => 'Penduduk', 'page3' => 'edit'])

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Data Penduduk Baru</div>
                </div>
                <div class="card-body">


                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle alert-icon"></i>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('penduduk.update', $penduduk->nik) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Row start -->
                        <div class="row">
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputNik" class="form-label">NIK</label>
                                    <input type="number" class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}"
                                        id="nik" value="{{ $penduduk->nik }}" name="nik" disabled>
                                    @if ($errors->has('nik'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nik') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label d-flex">NKK</label>
                                    <select class="select-single js-states form-control" title="Masukkan nkk"
                                        data-live-search="true" name="nkk">
                                        <option hidden value="{{ $penduduk->nkk }}">{{ $penduduk->nkk }}</option>
                                        @foreach ($kepala_keluargas as $kepala_keluarga)
                                            <option value="{{ $kepala_keluarga->nkk }}">{{ $kepala_keluarga->nkk }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('nkk'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nkk') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputNama" class="form-label">Nama</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" id="nama"
                                        value="{{ $penduduk->nama }}" name="nama">
                                    @if ($errors->has('nama'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nama') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputJenisKelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}"
                                        id="inputJenisKelamin" value="{{ $penduduk->jenis_kelamin }}" name="jenis_kelamin">
                                        <option hidden value="{{ $penduduk->jenis_kelamin }}">{{ $penduduk->jenis_kelamin }}</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @if ($errors->has('jenis_kelamin'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('jenis_kelamin') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputTempatLahir" class="form-label">Tempat Lahir</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}"
                                        id="tempat_lahir" value="{{ $penduduk->tempat_lahir }}" name="tempat_lahir">
                                    @if ($errors->has('tempat_lahir'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('tempat_lahir') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <div for="inputTanggalLahir" class="form-label">Tanggal Lahir</div>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar4"></i>
                                        </span>
                                        <input type="text"
                                            class="form-control datepicker {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}"
                                            id="tanggal_lahir" value="{{ $penduduk->tanggal_lahir->format('d/m/y') }}" name="tanggal_lahir">
                                        @if ($errors->has('tanggal_lahir'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('tanggal_lahir') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputAlamat" class="form-label">Alamat</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}"
                                        id="alamat" value="{{ $penduduk->alamat }}" name="alamat">
                                    @if ($errors->has('alamat'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('alamat') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputrt" class="form-label">RT</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('rt') ? 'is-invalid' : '' }}" id="rt"
                                        value="{{ $penduduk->rt }}" name="rt">
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
                                    <input type="text"
                                        class="form-control {{ $errors->has('rw') ? 'is-invalid' : '' }}" id="rw"
                                        value="{{ $penduduk->rw }}" name="rw">
                                    @if ($errors->has('rw'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('rw') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputKelurahan" class="form-label">Kelurahan/Desa</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kelurahan') ? 'is-invalid' : '' }}"
                                        id="kelurahan" value="{{ $penduduk->kelurahan_desa }}" name="kelurahan_desa">
                                    @if ($errors->has('kelurahan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kelurahan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputKecamatan" class="form-label">Kecamatan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}"
                                        id="kecamatan" value="{{ $penduduk->kecamatan }}" name="kecamatan">
                                    @if ($errors->has('kecamatan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kecamatan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputKabupaten" class="form-label">Kabupaten</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kabupaten') ? 'is-invalid' : '' }}"
                                        id="kabupaten" value="{{ $penduduk->kabupaten }}" name="kabupaten">
                                    @if ($errors->has('kabupaten'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kabupaten') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputProvinsi" class="form-label">Provinsi</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('provinsi') ? 'is-invalid' : '' }}"
                                        id="provinsi" value="{{ $penduduk->provinsi }}" name="provinsi">
                                    @if ($errors->has('provinsi'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('provinsi') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputAgama" class="form-label">Agama</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('agama') ? 'is-invalid' : '' }}"
                                        id="agama" value="{{ $penduduk->agama }}" name="agama">
                                    @if ($errors->has('agama'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('agama') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputStatus" class="form-label">Status</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                        id="status" value="{{ $penduduk->status }}" name="status">
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputPekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('pekerjaan') ? 'is-invalid' : '' }}"
                                        id="pekerjaan" value="{{ $penduduk->pekerjaan }}" name="pekerjaan">
                                    @if ($errors->has('pekerjaan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('pekerjaan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputKewarganegaraan" class="form-label">Kewarganegaraan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kewarganegaraan') ? 'is-invalid' : '' }}"
                                        id="kewarganegaraan" value="{{ $penduduk->kewarganegaraan }}"
                                        name="kewarganegaraan">
                                    @if ($errors->has('kewarganegaraan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kewarganegaraan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('penduduk.index') }}">Batal</a>
                            <button type="submit" class="btn btn-warning">Ubah</button>
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
    <!-- Bootstrap Select JS -->
    <script src="{{ asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ asset('vendor/bs-select/bs-select-custom.js') }}"></script>

    <!-- Date Range JS -->
    <script src="{{ asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
