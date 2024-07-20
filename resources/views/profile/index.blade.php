@extends('layouts.app', ['page' => 'Pengguna', 'page2' => 'Detail', 'page3' => ''])

@section('content')
    <!-- Row start -->
    <div class="row mt-3">
        <div class="offset-1 col-sm-10 col-10">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle alert-icon"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br />
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle alert-icon"></i>
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
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
                                <img src="{{ asset('images/profile.png') }}" class="img-fluid" alt="Image">
                            </div>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}"
                            class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                            @csrf
                            @method('patch')
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputId" class="form-label">Id</label>
                                    <input type="Id" class="form-control" id="inputId" disabled
                                        value="{{ $user->id }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputNama" class="form-label">Nama</label>
                                    <input type="Nama" class="form-control" id="inputNama" name="name" disabled
                                        value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input type="Email" class="form-control" id="inputEmail" name="email" disabled
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputPassword" class="form-label">Password</label>
                                    <input type="Password" class="form-control" id="inputPassword" name="password" disabled
                                        value="{{ substr($user->password, 0, 8) }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <button type="button" id="editDataButton" class="btn btn-info col-12 mb-3">Edit
                                        Data</button>
                                    <button type="submit" id="editButton" class="btn btn-info col-12 mb-3 btn-danger"
                                        hidden>Simpan Perubahan</button>
                                    <a id="batalButton" href="{{ route('profile.edit') }}" class="btn btn-secondary col-12"
                                        hidden>Batal</a>
                                </div>
                            </div>
                        </form>

                        <script>
                            document.getElementById('editDataButton').addEventListener('click', function() {
                                document.querySelectorAll('#inputNama, #inputEmail, #inputPassword').forEach(function(input) {
                                    input.removeAttribute('disabled');
                                });
                                document.getElementById('editButton').hidden = false;
                                document.getElementById('batalButton').hidden = false;
                                this.hidden = true;
                            });
                        </script>
                    </div>
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
