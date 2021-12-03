@extends ('layouts.auth')
@section ('title', 'Daftar akun Minuman Tile')

@section ('content')
<div class="row">
    <div class="col-md-4 offset-md-4">
        <div class="py-4"></div>
        <div class="py-3">
            <h1 class="text-secondary">Register</h1>
            <span class="text-secondary">Daftar akun baru di aplikasi Minuman Tile</span>
        </div>
        <div class="py-3"></div>

        <div class="border py-5 px-3 rounded">
            <div class="d-flex justify-content-center">
                <a class="btn text-primary" href="{{ route('client_home') }}">
                    <h3>
                        <i class="fas fa-prescription-bottle"></i> Minuman Tile
                    </h3>
                </a>
            </div>
            <div class="py-3"></div>

            <form action="{{ route('client_register_post') }}" method="post">
                @csrf
                <div class="mb-3">
                    <input
                        class="form-control"
                        id="client-name"
                        type="text"
                        name="name"
                        placeholder="Nama"
                        value="{{ old('name') }}"
                        required
                    >
                    @error ('name')
                    <div>
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input
                        class="form-control"
                        type="email"
                        name="email"
                        id="client-email"
                        placeholder="Alamat Email"
                        value="{{ old('email') }}"
                        required
                    >
                    @error ('email')
                    <div>
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input id="client-password" class="form-control" type="password" name="password" placeholder="Password" required>
                    @error ('password')
                    <div>
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input id="client-password-confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Re-type Password" required>
                    @error ('password_confirmation')
                    <div>
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input class="form-control btn btn-primary" type="submit" value="Daftar">
                </div>
                <div class="py-3">
                    Sudah memiliki akun? <a href="{{ route('client_login_get') }}">Masuk sekarang juga!</a>
                </div>
            </form>
        </div>

        <div class="py-4"></div>
        <div class="py-2"></div>
    </div>
</div>
@endsection
