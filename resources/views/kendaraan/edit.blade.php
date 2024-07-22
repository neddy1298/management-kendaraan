@extends('layouts.app', ['page' => 'Permohonan', 'page2' => 'KTP', 'page3' => 'edit'])

@section('css')
    <link rel="stylesheet" href="{{ secure_asset('vendor/daterange/daterange.css') }}">
@endsectionsecure_asset('

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Permohonan Baru</div>

                    <div class="card-options">

                        <span class="text-muted">Tanggal Permohonan: {{ now()->format('d-m-Y') }}</span>
                    </div>
                </div>
                <div class="card-body">


                    <form method="POST" action="{{ route('permohonan.update', $permohonan->id) }}"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Row start -->
                        <div class="row">
                            <div class="mt-3 col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Permohonan</label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_permohonan"
                                                id="Baru" value="Baru"
                                                {{ $permohonan->jenis_permohonan == 'Baru' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="Baru">Baru</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_permohonan"
                                                id="Perpanjang" value="Perpanjang"
                                                {{ $permohonan->jenis_permohonan == 'Perpanjang' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="Perpanjang">Perpanjang</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_permohonan"
                                                id="Pergantian" value="Pergantian"
                                                {{ $permohonan->jenis_permohonan == 'Pergantian' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="Pergantian">Pergantian</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputNik" class="form-label">NIK</label>
                                    <input type="number" class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}"
                                        id="nik" value="{{ $permohonan->nik }}" name="nik" disabled>
                                    @if ($errors->has('nik'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nik') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputNkk" class="form-label">NKK</label>
                                    <input type="number" class="form-control {{ $errors->has('nkk') ? 'is-invalid' : '' }}"
                                        id="nkk" value="{{ $permohonan->nkk }}" name="nkk">
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
                                        value="{{ $permohonan->nama }}" name="nama">
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
                                        id="inputJenisKelamin" value="{{ $permohonan->jenis_kelamin }}"
                                        name="jenis_kelamin">
                                        <option hidden>{{ $permohonan->jenis_kelamin }}</option>
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
                                        id="tempat_lahir" value="{{ $permohonan->tempat_lahir }}" name="tempat_lahir">
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
                                            class="form-control {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}"
                                            id="tanggal_lahir" value="{{ $permohonan->tanggal_lahir }}"
                                            name="tanggal_lahir">
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
                                        id="alamat" value="{{ $permohonan->alamat }}" name="alamat">
                                    @if ($errors->has('alamat'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('alamat') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputKelurahan" class="form-label">Kelurahan/Desa</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kelurahan') ? 'is-invalid' : '' }}"
                    secure_asset('             id="kelurahan" value="{{ $permohonan->kelurahan_desa }}" name="kelurahan_desa">
                    secure_asset('         @if ($errors->has('kelurahan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kelurahan') }}
                    secure_asset('             </div>
                    secure_asset('         @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="inputKecamatan" class="form-label">Kecamatan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}"
                                        id="kecamatan" value="{{ $permohonan->kecamatan }}" name="kecamatan">
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
                                        id="kabupaten" value="{{ $permohonan->kabupaten }}" name="kabupaten">
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
                                        id="provinsi" value="{{ $permohonan->provinsi }}" name="provinsi">
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
                                        id="agama" value="{{ $permohonan->agama }}" name="agama">
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
                                        id="status" value="{{ $permohonan->status }}" name="status">
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
                                        id="pekerjaan" value="{{ $permohonan->pekerjaan }}" name="pekerjaan">
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
                                        id="kewarganegaraan" value="{{ $permohonan->kewarganegaraan }}"
                                        name="kewarganegaraan">
                                    @if ($errors->has('kewarganegaraan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kewarganegaraan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputketerangan" class="form-label">keterangan</label>
                                    <textarea class="form-control" id="inputketerangan" rows="3" name="keterangan">{{ $permohonan->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->
                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('permohonan.index') }}">Batal</a>
                            <button type="submit" class="btn btn-warning">Edit</button>
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
    <script src="{{ secure_asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
