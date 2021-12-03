@extends ('layouts.auth')
@section ('title', 'Login Admin')

@section ('content')
<div class="row">
    <div class="py-4"></div>
    <div class="py-3"></div>
    <div class="col-md-4 offset-md-4">
        <h1 class="text-secondary">Login Admin</h1>
        <span class="text-secondary small">Silahkan masuk ke admin aplikasi sebelum melanjutkan ke admin dashboard</span>
        <div class="py-3"></div>

        <div class="border py-5 px-3 rounded">

            <form action="{{ route('admin_login_post') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text text-secondary bg-white">@</span>
                    <input name="email" id="client-email" class="form-control" type="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                    @error ('email')
                    <div class="input-group">
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text text-secondary bg-white"><i class="fas fa-lock"></i></span>
                    <input name="password" id="client-password" class="form-control" type="password" placeholder="Password" required>
                    @error ('password')
                    <div class="input-group">
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="client-login-submit" class="form-control btn btn-primary" type="submit" value="Masuk">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
