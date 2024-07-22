@extends('layouts.app', ['page' => 'Permohonan', 'page2' => 'KTP', 'page3' => 'create'])

@section('css')
    <link rel="stylesheet" href="{{ secure_asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/bs-select/bs-select.css') }}">
@endsection

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
                    <form method="POST" action="{{ route('permohonan.store') }}" enctype="multipart/form-data">
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
                                                {{ old('jenis_permohonan') == 'Baru' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="Baru">Baru</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_permohonan"
                                                id="Perpanjang" value="Perpanjang"
                                                {{ old('jenis_permohonan') == 'Perpanjang' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="Perpanjang">Perpanjang</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_permohonan"
                                                id="Pergantian" value="Pergantian"
                                                {{ old('jenis_permohonan') == 'Pergantian' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="Pergantian">Pergantian</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label d-flex">NIK</label>
                                    <select class="select-single js-states form-control" title="Masukkan NIK"
                                        data-live-search="true" onchange="fillForm(this.value)" name="nik">
                                        <option hidden value="{{ old('nik') }}">{{ old('nik') }}</option>
                                        @foreach ($penduduks as $penduduk)
                                            <option value="{{ $penduduk->nik }}">{{ $penduduk->nik }} --- {{ $penduduk->nama }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('nik'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nik') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="nkk" class="form-label">NKK</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('nkk') ? 'is-invalid' : '' }}" id="nkk"
                                        value="{{ old('nkk') }}" name="nkk" readonly>
                                    @if ($errors->has('nkk'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nkk') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" id="nama"
                                        value="{{ old('nama') }}" name="nama" readonly>
                                    @if ($errors->has('nama'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nama') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}" id="jenis_kelamin"
                                        value="{{ old('jenis_kelamin') }}" name="jenis_kelamin" readonly>
                                    @if ($errors->has('jenis_kelamin'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('jenis_kelamin') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="TempatLahir" class="form-label">Tempat Lahir</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}"
                                        id="tempat_lahir" value="{{ old('tempat_lahir') }}" name="tempat_lahir" readonly>
                                    @if ($errors->has('tempat_lahir'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('tempat_lahir') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <div for="TanggalLahir" class="form-label">Tanggal Lahir</div>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar4"></i>
                                        </span>
                                        <input type="text"
                                            class="form-control {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}"
                                            id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" name="tanggal_lahir" readonly>
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
                                    <label for="Alamat" class="form-label">Alamat</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}"
                                        id="alamat" value="{{ old('alamat') }}" name="alamat" readonly>
                                    @if ($errors->has('alamat'))
                    <div class="invalid-feedback">
                    {{ $errors->first('alamat') }}
                                        </div>
                                    @endif
                       </div>
                    </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="Kelurahan" class="form-label">Kelurahan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kelurahan') ? 'is-invalid' : '' }}"
                                        id="kelurahan" value="{{ old('kelurahan') }}" name="kelurahan" readonly>
                                    @if ($errors->has('kelurahan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kelurahan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="Kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}"
                                        id="kecamatan" value="{{ old('kecamatan') }}" name="kecamatan" readonly>
                                    @if ($errors->has('kecamatan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kecamatan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="Kabupaten" class="form-label">Kabupaten</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kabupaten') ? 'is-invalid' : '' }}"
                                        id="kabupaten" value="{{ old('kabupaten') }}" name="kabupaten" readonly>
                                    @if ($errors->has('kabupaten'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kabupaten') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="Provinsi" class="form-label">Provinsi</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('provinsi') ? 'is-invalid' : '' }}"
                                        id="provinsi" value="{{ old('provinsi') }}" name="provinsi" readonly>
                                    @if ($errors->has('provinsi'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('provinsi') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="Agama" class="form-label">Agama</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('agama') ? 'is-invalid' : '' }}"
                                        id="agama" value="{{ old('agama') }}" name="agama" readonly>
                                    @if ($errors->has('agama'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('agama') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="Status" class="form-label">Status</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                        id="status" value="{{ old('status') }}" name="status" readonly>
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="Pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('pekerjaan') ? 'is-invalid' : '' }}"
                                        id="pekerjaan" value="{{ old('status') }}" name="pekerjaan" readonly>
                                    @if ($errors->has('pekerjaan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('pekerjaan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="Kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kewarganegaraan') ? 'is-invalid' : '' }}"
                                        id="kewarganegaraan" value="{{ old('kewarganegaraan') }}"
                                        name="kewarganegaraan" readonly>
                                    @if ($errors->has('kewarganegaraan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kewarganegaraan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" rows="3" name="keterangan">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('permohonan.index') }}">Batal</a>
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
    <script>
        let penduduks = @json($penduduks);

        function fillForm(nik) {
            let penduduk = penduduks.find(p => p.nik == nik);
            console.log("nik:", nik);
            console.log("penduduk:", penduduk);
            if (penduduk) {
                $('#nkk').val(penduduk.nkk);
                $('#nama').val(penduduk.nama);
                $('#jenis_kelamin').val(penduduk.jenis_kelamin);
                $('#tempat_lahir').val(penduduk.tempat_lahir);
                $('#tanggal_lahir').val(moment(penduduk.tanggal_lahir).format('DD/MM/YYYY'));
                $('#alamat').val(penduduk.alamat);
                $('#kelurahan').val(penduduk.kelurahan_desa);
                $('#kecamatan').val(penduduk.kecamatan);
                $('#kabupaten').val(penduduk.kabupaten);
                $('#provinsi').val(penduduk.provinsi);
                $('#agama').val(penduduk.agama);
                $('#status').val(penduduk.status);
                $('#pekerjaan').val(penduduk.pekerjaan);
                $('#kewarganegaraan').val(penduduk.kewarganegaraan);
                $('#keterangan').val(penduduk.keterangan);
            }
        }
    </script>
    <!-- Bootstrap Select JS -->
    <script src="{{ secure_asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/bs-select/bs-select-custom.js') }}"></script>

    <!-- Date Range JS -->
    <script src="{{ secure_asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
