@extends ('layouts.admin')
@section ('title', 'Tambah Menu')

@section ('content')
<div class="py-3">
    <h5>Tambah Menu</h5>

    @include ('shared.message')

    <form action="{{ route('admin_menu_add_post') }}" method="post">
        @csrf
        <a class="btn btn-danger" href="{{ route('admin_menu_get') }}">Kembali</a>
    </form>
</div>
@endsection

