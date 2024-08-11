@extends('layouts.app', ['page' => 'Belanja', 'page2' => 'Tambah', 'page3' => ''])

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Data Belanja</div>
                    <div class="card-options">
                        <span class="text-muted">Tanggal Hari ini: {{ now()->format('d-m-Y') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle alert-icon"></i>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('belanja.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Group Anggaran</label>
                                    <select class="form-select" id="group_anggaran_id" name="group_anggaran_id">
                                        <option value="" hidden>Pilih Group Anggaran</option>
                                        @foreach ($groupAnggarans as $groupAnggaran)
                                            <option value="{{ $groupAnggaran->id }}">{{ $groupAnggaran->nama_group }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-12 d-none" id="kendaraan_container">
                                <div class="mb-3">
                                    <label class="form-label">Kendaraan</label>
                                    <select class="form-select" id="kendaraan_id" name="kendaraan_id">
                                        <option value="" hidden>Pilih Kendaraan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-section-title">Total Belanja</div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Belanja</label>
                                    <select class="form-select" id="jenis_belanja" name="jenis_belanja">
                                        <option value="" hidden>Pilih Jenis Belanja</option>
                                        <option value="bbm">BBM</option>
                                        <option value="pelumas">Pelumas</option>
                                        <option value="suku_cadang">Suku Cadang</option>
                                    </select>
                                </div>
                            </div>
                            <div id="form_bbm" class="col-xl-12 col-sm-12 col-12 d-none">
                                <div class="mb-3">
                                    <label class="form-label">Belanja BBM</label>
                                    <input type="number" class="form-control" name="belanja_bahan_bakar_minyak">
                                </div>
                            </div>
                            <div id="form_pelumas" class="col-xl-12 col-sm-12 col-12 d-none">
                                <div class="mb-3">
                                    <label class="form-label">Belanja Pelumas</label>
                                    <input type="number" class="form-control" name="belanja_pelumas_mesin">
                                </div>
                            </div>
                            <div id="form_suku_cadang" class="col-12 d-none">
                                <div id="sukuCadangContainer">
                                    <div class="row suku-cadang-item mb-3">
                                        <div class="col-xl-4 col-sm-12 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Suku Cadang</label>
                                                <select class="form-control stok-suku-cadang" name="nama_suku_cadang[]">
                                                    <option value="" hidden>Pilih Suku Cadang</option>
                                                    @foreach ($stokSukuCadangs as $stokSukuCadang)
                                                        <option value="{{ $stokSukuCadang->id }}"
                                                            data-stok="{{ $stokSukuCadang->stok }}"
                                                            data-harga="{{ $stokSukuCadang->harga }}">
                                                            {{ $stokSukuCadang->nama_suku_cadang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-12 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control jumlah-suku-cadang"
                                                        name="jumlah_suku_cadang[]" min="1">
                                                    <span class="input-group-text stok-suku-cadang">stok</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-12 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Harga Satuan</label>
                                                <div class="input-group">
                                                    <input type="hidden" class="harga-suku-cadang"
                                                        name="harga_suku_cadang[]" readonly>
                                                    <input class="form-control harga-display">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-sm-12 col-12 d-flex align-items-end">
                                            <div class="mb-3">
                                                <button type="button"
                                                    class="btn btn-danger btn-icon btn-sm remove-suku-cadang">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="tambahSukuCadang" class="btn btn-primary mb-3">Tambah Suku
                                    Cadang</button>
                            </div>

                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <div class="form-label">Tanggal Belanja</div>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" name="tanggal_belanja">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('belanja.index') }}">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ asset('vendor/bs-select/bs-select-custom.js') }}"></script>
    <script src="{{ asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ asset('vendor/daterange/custom-daterange.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kendaraanSelect = document.getElementById('kendaraan_id');
            const groupAnggaranSelect = document.getElementById('group_anggaran_id');
            const kendaraanContainer = document.getElementById('kendaraan_container');

            groupAnggaranSelect.addEventListener('change', function() {
                const groupAnggaranId = this.value;

                // Clear existing options
                kendaraanSelect.innerHTML = '';

                if (groupAnggaranId) {
                    kendaraanContainer.classList.remove('d-none');
                    fetch(`/get-kendaraan/${groupAnggaranId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(kendaraan => {
                                const option = document.createElement('option');
                                option.value = kendaraan.id;
                                option.textContent = kendaraan.nomor_registrasi + ' - ' +
                                    kendaraan.merk_kendaraan;
                                kendaraanSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching kendaraan:', error));
                } else {
                    kendaraanContainer.classList.add('d-none');
                }
            });

            // Trigger change event to populate initial options
            groupAnggaranSelect.dispatchEvent(new Event('change'));
        });



        document.addEventListener('DOMContentLoaded', function() {
            const jenisBelanja = document.getElementById('jenis_belanja');
            const formBBM = document.getElementById('form_bbm');
            const formPelumas = document.getElementById('form_pelumas');
            const formSukuCadang = document.getElementById('form_suku_cadang');
            const container = document.getElementById('sukuCadangContainer');
            const addButton = document.getElementById('tambahSukuCadang');

            jenisBelanja.addEventListener('change', function() {
                formBBM.classList.add('d-none');
                formPelumas.classList.add('d-none');
                formSukuCadang.classList.add('d-none');

                if (this.value === 'bbm') {
                    formBBM.classList.remove('d-none');
                } else if (this.value === 'pelumas') {
                    formPelumas.classList.remove('d-none');
                } else if (this.value === 'suku_cadang') {
                    formSukuCadang.classList.remove('d-none');
                }
            });

            function createSukuCadangItem() {
                const item = document.createElement('div');
                item.className = 'row suku-cadang-item mb-3';
                item.innerHTML = `
                    <div class="col-xl-4 col-sm-12 col-12">
                        <div class="mb-3">
                            <label class="form-label">Nama Suku Cadang</label>
                            <select class="form-control stok-suku-cadang" name="nama_suku_cadang[]">
                                <option value="">Pilih Suku Cadang</option>
                                @foreach ($stokSukuCadangs as $stokSukuCadang)
                                    <option value="{{ $stokSukuCadang->id }}" data-stok="{{ $stokSukuCadang->stok }}" data-harga="{{ $stokSukuCadang->harga }}">{{ $stokSukuCadang->nama_suku_cadang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-12 col-12">
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <div class="input-group">
                                <input type="number" class="form-control jumlah-suku-cadang" name="jumlah_suku_cadang[]" min="1">
                                <span class="input-group-text stok-suku-cadang">stok</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-12 col-12">
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="hidden" class="form-control harga-suku-cadang" name="harga_suku_cadang[]" readonly>
                            <input type="text" class="form-control harga-display" readonly>
                        </div>
                    </div>
                    <div class="col-xl-1 col-sm-12 col-12 d-flex align-items-end">
                        <div class="mb-3">
                            <button type="button" class="btn btn-danger btn-icon btn-sm remove-suku-cadang">Hapus</button>
                        </div>
                    </div>
                `;
                return item;
            }

            addButton.addEventListener('click', function() {
                container.appendChild(createSukuCadangItem());
            });

            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-suku-cadang')) {
                    e.target.closest('.suku-cadang-item').remove();
                }
            });

            container.addEventListener('change', function(e) {
                if (e.target.classList.contains('stok-suku-cadang')) {
                    const selectedOption = e.target.options[e.target.selectedIndex];
                    const stok = selectedOption.getAttribute('data-stok');
                    const harga = selectedOption.getAttribute('data-harga');
                    const jumlahInput = e.target.closest('.suku-cadang-item').querySelector(
                        '.jumlah-suku-cadang');
                    const hargaInput = e.target.closest('.suku-cadang-item').querySelector(
                        '.harga-suku-cadang');
                    const hargaDisplay = e.target.closest('.suku-cadang-item').querySelector(
                        '.harga-display');
                    const stokSpan = e.target.closest('.suku-cadang-item').querySelector(

                        '.input-group-text.stok-suku-cadang');
                    jumlahInput.max = stok;
                    hargaInput.value = harga;
                    hargaDisplay.value = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(Number(harga));
                    stokSpan.textContent = `Stok: ${stok}`;
                }
            });
        });
    </script>
@endsection
