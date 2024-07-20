@extends('layouts.app', ['page' => 'Master Data', 'page2' => 'Desa', 'page3' => 'edit'])


@section('content')
    <!-- Row start -->
    <div class="row mt-3">
        <div class="col-sm-12 col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle alert-icon"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-x-circle alert-icon"></i>
                        {{ $error }}<br />
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            <!-- Card start -->
            <div class="card">
                <div class="card-body">
                    <!-- Row start -->
                    <form class="row" action="{{ route('desa.update', $desa->kode_desa) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12 mb-3">
                            <div class="form-section-title">Data Desa</div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="mb-3">
                                <img src="{{ asset('images/profile.png') }}" class="img-fluid" alt="Image">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputkode_desa" class="form-label">Kode Desa</label>
                                    <input type="number" class="form-control" id="inputkode_desa" name="kode_desa"
                                        value="{{ $desa->kode_desa }}" disabled>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputnama_desa" class="form-label">Nama Desa</label>
                                    <input type="text" class="form-control" id="inputnama_desa" name="nama_desa"
                                        value="{{ $desa->nama_desa }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputkode_kecamatan" class="form-label">kode kecamatan</label>
                                    <input type="number" class="form-control" id="inputkode_kecamatan"
                                        name="kode_kecamatan" value="{{ $desa->kode_kecamatan }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputnama_kecamatan" class="form-label">Nama Kecamatan</label>
                                    <input type="text" class="form-control" id="inputnama_kecamatan"
                                        name="nama_kecamatan" value="{{ $desa->nama_kecamatan }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputkode_kabupaten" class="form-label">Kode Kabupaten</label>
                                    <input type="number" class="form-control" id="inputkode_kabupaten"
                                        name="kode_kabupaten" value="{{ $desa->kode_kabupaten }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputnama_kabupaten" class="form-label">Nama Kabupaten</label>
                                    <input type="text" class="form-control" id="inputnama_kabupaten"
                                        name="nama_kabupaten" value="{{ $desa->nama_kabupaten }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputkode_provinsi" class="form-label">Kode Provinsi</label>
                                    <input type="number" class="form-control" id="inputkode_provinsi"
                                        name="kode_provinsi" value="{{ $desa->kode_provinsi }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputnama_provinsi" class="form-label">Nama Provinsi</label>
                                    <input type="text" class="form-control" id="inputnama_provinsi"
                                        name="nama_provinsi" value="{{ $desa->nama_provinsi }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputalamat_kantor" class="form-label">Alamat Kantor</label>
                                    <textarea class="form-control" id="inputalamat_kantor" name="alamat_kantor" rows="3">{{ $desa->alamat_kantor }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputtelepon" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="inputtelepon" name="telepon"
                                        value="{{ $desa->telepon }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputemail" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="inputemail" name="email"
                                        value="{{ $desa->email }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputkode_pos" class="form-label">Kode Pos</label>
                                    <input type="number" class="form-control" id="inputkode_pos" name="kode_pos"
                                        value="{{ $desa->kode_pos }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputnama_kepala_desa" class="form-label">Nama Kepala Desa</label>
                                    <input type="text" class="form-control" id="inputnama_kepala_desa"
                                        name="nama_kepala_desa" value="{{ $desa->nama_kepala_desa }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputnip_kepala_desa" class="form-label">Nip Kepala Desa</label>
                                    <input type="number" class="form-control" id="inputnip_kepala_desa"
                                        name="nip_kepala_desa" value="{{ $desa->nip_kepala_desa }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputnama_sekretaris_desa" class="form-label">Nama Sekretaris
                                        Desa</label>
                                    <input type="text" class="form-control"
                                        id="inputnama_sekretaris_desa" name="nama_sekretaris_desa"
                                        value="{{ $desa->nama_sekretaris_desa }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputnip_sekretaris_desa" class="form-label">Nip Sekretaris
                                        Desa</label>
                                    <input type="number" class="form-control" id="inputnip_sekretaris_desa"
                                        name="nip_sekretaris_desa" value="{{ $desa->nip_sekretaris_desa }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputnama_bendahara_desa" class="form-label">Nama Bendahara
                                        Desa</label>
                                    <input type="text" class="form-control" id="inputnama_bendahara_desa"
                                        name="nama_bendahara_desa" value="{{ $desa->nama_bendahara_desa }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-actions-footer">
                            <a href="{{ route('desa.index') }}" class="btn btn-light">Batal</a>
                            <button class="btn btn-warning">Ubah</button>
                        </div>
                    </form>
                    <!-- Row end -->

                    <!-- Form actions footer start -->
                    <div class="col-sm-12 col-12">
                    </div>
                    <!-- Form actions footer end -->

                </div>
            </div>
            <!-- Card end -->

        </div>

    </div>
    <!-- Row end -->
@endsection
