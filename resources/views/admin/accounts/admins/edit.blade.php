@extends ('layouts.admin')
@section ('title', 'Edit Admin ' . $admin->name)

@section ('content')
<div class="py-3">
    <h5>Edit Admin - {{ $admin->name }}</h5>

    @include ('shared.message')
    <form action="{{ route('admin_accounts_edit_put', [ 'id' => $admin->id ]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3 col-md-4">
            <input class="form-control" type="text" name="name" value="{{ $admin->name }}" placeholder="Nama" required>
            @error ('name')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <input class="form-control" type="email" name="email" value="{{ $admin->email }}" placeholder="Email" required>
            @error ('email')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <input class="form-control" type="password" name="password" placeholder="Password">
            @error ('password')
            <div>
                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
            </div>
            @enderror
        </div>

        <a class="btn btn-danger btn-sm" href="{{ route('admin_accounts_get') }}">Kembali</a>
        <input class="btn btn-primary btn-sm" type="submit" value="Simpan">
    </form>
</div>
@endsection
