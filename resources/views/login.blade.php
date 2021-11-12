@extends ('layouts.client')
@section ('title', 'Masuk ke aplikasi untuk melanjutkan pesananmu')

@section ('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="py-4"></div>
            <div class="py-3">
                <h1 class="text-secondary">Login</h1>
                <span class="text-secondary">Masuk dulu ke aplikasi untuk melanjutkan pesananmu</span>
            </div>
            <div class="py-3"></div>

            <form action="{{ route('client_login_post') }}" method="post">
                 @csrf
                <div class="mb-3">
                    <label class="form-label" for="client-email">Email</label>
                    <input name="email" id="client-email" class="form-control" type="email" placeholder="client@minuman.com" required>
                    @error ('email')
                    <div>
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="client-password">Password</label>
                    <input name="password" id="client-password" class="form-control" type="password" placeholder="Masukan password kamu" required>
                    @error ('password')
                    <div>
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                </div>

               <div class="mb-3">
                    <input id="client-login-submit" class="form-control btn btn-primary" type="submit" value="Lanjut">
               </div>

                <div class="py-3">
                    Belum memiliki akun? <a href="{{ route('client_register_get') }}">Daftar sekarang!</a>
                </div>
          </form>
    </div>
@endsection
