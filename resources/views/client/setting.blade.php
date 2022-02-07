@extends ('layouts.client')
@section ('title', 'Pengaturan Pengguna')

@section ('content')

<div class="py-1">
    <h3>Pengaturan Alamat</h3>

    @include ('shared.message')

    <form action="{{ route('client_setting_post', [ 'id' => $client->id ]) }}" method="post">
        @csrf
        <div class="mb-3 col-md-4">
            <label class="form-label" for="phone_number">Nomor Telepon</label>
            <input class="form-control" name="phone_number" type="text" value="{{ $client->phone_number }}" required>
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="phone_number">Alamat</label>
            <textarea class="form-control" name="address" id="" cols="30" rows="10" required>{{ $client->address }}</textarea>
        </div>
        <div class="mb-3 col-md-4">
            <a class="btn btn-danger btn-sm" href="{{ route('client_home') }}">Kembali</a>
            <input class="btn btn-success btn-sm" type="submit" value="Simpan">
        </div>
    </form>
</div>

@endsection
