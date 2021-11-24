@extends ('layouts.admin')
@section ('title', 'Admins Management')

@section ('content')
<div class="py-3">
    <h5>Admins Management</h5>

    @include ('shared.message')

    <div class="py-2">
        <a class="btn btn-primary btn-sm" href="{{ route('admin_accounts_add_get') }}">
            Tambah Admin
        </a>
    </div>
    <table class="table table-hover">
        <thead>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Dibuat Tanggal</th>
            <th scope="col">#</th>
        </thead>
        
        @foreach ($admins as $a)
        <tr>
            <td class="fw-light">{{ $a->name }}</td>
            <td class="fw-light">{{ $a->email }}</td>
            <td class="fw-light">{{ $a->created_at }}</td>
            <td>
                <a class="btn btn-warning" href="{{ route('admin_accounts_edit_get', [ 'id' => $a->id ]) }}">
                    Edit
                </a>
                <span class="px-2"></span>
                <a
                    class="btn btn-danger"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#remove-admin-modal"
                    data-admin-name="{{ $a->name }}"
                    data-remove-admin-link="{{ route('admin_accounts_delete_get', ['id' => $a->id]) }}"
                    onclick="getAdmin(this)"
                >
                    Remove
                </a>
            </td>
        </tr>
        @endforeach
    </table>

    {{-- Modal --}}
    <div id="remove-admin-modal" class="modal fade fw-light" tabindex="-1" aria-labelledby="remove-admin-modal-label">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="remove-admin-modal-label" class="modal-title">Hapus Admins</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus admin <span id="admin-name" class="fw-bold"></span>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                    <a id="remove-admin-button" class="btn btn-danger" href="">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}

    {{-- Modal Script --}}
    <script>
        function getAdmin(el) {
            let adminName = el.dataset.adminName,
                removeAdminLink = el.dataset.removeAdminLink,
                showAdminName = document.querySelector('#admin-name'),
                removeAdminButton = document.querySelector('#remove-admin-button');

            showAdminName.innerHTML = adminName;
            removeAdminButton.setAttribute('href', removeAdminLink);
        }
    </script>
    {{-- Modal Script --}}
</div>
@endsection
