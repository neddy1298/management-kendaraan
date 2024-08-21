@extends('layouts.app', ['page' => 'User', 'page2' => '', 'page3' => ''])

@section('content')
    <!-- Row start -->
    <div class="row mt-3">
        <div class="offset-1 col-sm-10 col-10">
            @if (session('success'))
                @include('partials.alert', ['type' => 'success', 'message' => session('success')])
            @else
                @include('partials.alert', ['type' => 'danger', 'message' => $errors->all()])
            @endif
            <!-- Card start -->
            <div class="card">
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-section-title">Data Pengguna</div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="mb-3">
                                <img src="{{ secure_asset('images/profile.png') }}" class="img-fluid" alt="Image">
                            </div>
                        </div>

                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                            <!-- Form start -->
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', auth()->user()->name) }}" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="email" class="form-label">Akun (Email)</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', auth()->user()->email) }}" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="phone" class="form-label">Nomor Whatsapp</label>
                                        <input type="number" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone', auth()->user()->phone) }}" required
                                            oninput="validatePhoneNumber(this)" placeholder="Contoh: 82134567891">
                                        <div id="phone-error" class="text-danger" style="display: none;">Nomor tidak boleh
                                            dimulai dengan 0.</div>
                                    </div>

                                    <script>
                                        function validatePhoneNumber(input) {
                                            const phoneError = document.getElementById('phone-error');
                                            if (input.value.startsWith('0')) {
                                                phoneError.style.display = 'block';
                                                input.value = '';
                                            } else {
                                                phoneError.style.display = 'none';
                                            }
                                        }
                                    </script>
                                    <div class="col-12 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                            password</small>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                                        <label for="showPassword">Show Password</label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                    <div class="text-center mt-5">
                                        <label for="whatsapp">Nomor Whatsapp baru?</label>
                                        <div class="col-12 mb-2">
                                            <span for="">gunakan WhatsApp dan kirim pesan dari device kamu ke
                                                <br><i class="bi bi-whatsapp primary"></i> <strong> +14155238886</strong>
                                                <br>dengan pesan: <strong>join both-break</strong>
                                                <br>Atau klik tombol:
                                            </span>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <a href="https://wa.me/+14155238886?text=join%20both-break"
                                                class="btn btn-icon btn-success" target="_blank"><i
                                                    class="bi bi-whatsapp"></i>
                                                Aktivasi nomor
                                                whatsapp</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Form end -->
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
            </div>
            <!-- Card end -->
        </div>
    </div>
    <!-- Row end -->

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
@endsection
