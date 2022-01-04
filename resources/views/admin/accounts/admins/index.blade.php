@extends ('layouts.admin')
@section ('title', 'Manajemen User Admin')

@section ('content')
<div class="py-3">
    <h5>Manajemen User Admin</h5>

    @include ('shared.message')

    <div class="pt-2 pb-3">
        <a class="btn btn-sm btn-primary" href="{{ route('admin_accounts_add_get') }}">
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

        @if ($admins->isNotEmpty())
            @foreach ($admins as $a)
            <tr>
                <td class="fw-light">{{ $a->name }}</td>
                <td class="fw-light">{{ $a->email }}</td>
                <td class="fw-light">{{ date('d M Y H:i:s', strtotime( $a->created_at )) }}</td>
                <td>
                    <a class="btn btn-warning btn-sm" href="{{ route('admin_accounts_edit_get', [ 'id' => $a->id ]) }}">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                </td>
                <td>
                    <button
                        class="btn btn-danger btn-sm"
                        href="#"
                        data-bs-toggle="modal"
                        data-bs-target="#remove-admin-modal"
                        data-admin-name="{{ $a->name }}"
                        data-remove-admin-link="{{ route('admin_accounts_delete_get', ['id' => $a->id]) }}"
                        onclick="getAdmin(this)"
                        @if ($a->id == 1) disabled @endif
                    >
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td class="fw-light text-center" colspan="4">Data admin kosong</td>
            </tr>
        @endif
    </table>

    {{-- Modal --}}
    <div id="remove-admin-modal" class="modal fade fw-light" tabindex="-1" aria-labelledby="remove-admin-modal-label">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="remove-admin-modal-label" class="modal-title">Hapus Admins</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus admin <span id="admin-name" class="fw-bold"></span>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <a id="remove-admin-button" class="btn btn-danger btn-sm" href="">Hapus</a>
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
