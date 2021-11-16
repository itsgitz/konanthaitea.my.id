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

        <form action="{{ route('client_register_post') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="client-name">Name</label>
                <input
                    class="form-control"
                    id="client-name"
                    type="text"
                    name="name"
                    placeholder="Masukan nama anda"
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
                <label for="client-email" class="form-label">Email</label>
                <input
                    class="form-control" 
                    type="email" 
                    name="email" 
                    id="client-email" 
                    placeholder="Alamat email anda (contoh: aku@gmail.com)" 
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
                <label class="form-label" for="client-password">Password</label>
                <input id="client-password" class="form-control" type="password" name="password" placeholder="Masukan password anda" required>
                @error ('password')
                <div>
                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="client-password-confirmation">Confirm Password</label>
                <input id="client-password-confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Konfirmasi password anda" required>
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
</div>
@endsection
