@extends ('layouts.admin')
@section ('title', 'Tambah Unit Stock')

@section ('content')
<div class="py-3">
    <h4>Unit yang tersedia:</h4> 
    
    <table class="table">
        <th>ID</th>
        <th>Nama</th>
        <th>Ditambahkan Tanggal</th>
        
        @foreach ($stockUnits as $su)
        <tr>
            <td>{{ $su->id }}</td>
            <td>{{ $su->name }}</td>
            <td>{{ $su->created_at }}</td>
        </tr>
        @endforeach
    </table>

    <h4>Tambah Unit</h4>
    <form action="{{ route('admin_stock_units_post') }}" method="post">
        @csrf
        <div class="mb-3">
            <input class="form-control w-25" type="tex" name="name" placeholder="Nama Unit" required>
        </div>
        <input class="btn btn-success" type="submit" value="Simpan">
    </form>
</div>
@endsection