@extends ('layouts.admin')
@section ('title', 'Tambah Admin')

@section ('content')
<div class="py-3">
    <h5>Tambah Admin</h5>

    <form action="{{ route('admin_accounts_add_post') }}" method="post">
        @csrf
        <div class="mb-3 col-md-4">
            <input class="form-control" type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required>
            @error ('name')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error ('email')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <input class="form-control" type="password" name="password" placeholder="Password" required>
            @error ('password')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>

        <a class="btn btn-danger" href="{{ route('admin_accounts_get') }}">Batal</a>
        <input class="btn btn-primary" type="submit" value="Simpan">
    </form>
</div>
@endsection
