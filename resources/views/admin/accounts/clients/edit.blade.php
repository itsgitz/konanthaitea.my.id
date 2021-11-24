@extends ('layouts.admin')
@section ('title', 'Edit Clients')

@section ('content')
<div class="py-3">
    <h5>Edit Client</h5>

    @include ('shared.message')

    <form action="{{ route('admin_clients_edit_put', [ 'id' => $client->id ]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3 col-md-4">
            <input class="form-control" type="text" name="name" value="{{ $client->name }}" placeholder="Nama">
        </div>
        <div class="mb-3 col-md-4">
            <input class="form-control" type="text" name="email" value="{{ $client->email }}" placeholder="Nama">
        </div>
        <div class="mb-3 col-md-4">
            <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <a class="btn btn-danger" href="{{ route('admin_clients_get') }}">Kembali</a>
        <input class="btn btn-primary" type="submit" value="Simpan">
    </form>
</div>
@endsection
