@extends ('layouts.admin')
@section ('title', 'Admins')

@section ('content')
<div class="py-3">
    <h5>Clients</h5>

    @include ('shared.message')

    <table class="table table-hover">
        <thead>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Dibuat Tanggal</th>
            <th scope="col">#</th>
        </thead>
        
        @foreach ($clients as $c)
        <tr>
            <td class="fw-light">{{ $c->name }}</td>
            <td class="fw-light">{{ $c->email }}</td>
            <td class="fw-light">{{ $c->created_at }}</td>
            <td>
                <a class="btn btn-warning" href="{{ route('admin_clients_edit_get', [ 'id' => $c->id ]) }}">
                    Edit
                </a>
                <span class="px-2"></span>
                <a
                    class="btn btn-danger"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#remove-client-modal"
                    data-client-name="{{ $c->name }}"
                    data-remove-client-link="{{ route('admin_clients_delete_get', ['id' => $c->id]) }}"
                    onclick="getClient(this)"
                >
                    Remove
                </a>
            </td>
        </tr>
        @endforeach
    </table>

    {{-- Modal --}}
    <div id="remove-client-modal" class="modal fade fw-light" tabindex="-1" aria-labelledby="remove-client-modal-label">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="remove-client-modal-label" class="modal-title">Hapus Client</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus client <span id="client-name" class="fw-bold"></span>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                    <a id="remove-client-button" class="btn btn-danger" href="">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}

    {{-- Modal Script --}}
    <script>
        function getClient(el) {
            let clientName = el.dataset.clientName,
                removeClientLink = el.dataset.removeClientLink,
                showClientName = document.querySelector('#client-name'),
                removeClientButton = document.querySelector('#remove-client-button');

            showClientName.innerHTML = clientName;
            removeClientButton.setAttribute('href', removeClientLink);
        }
    </script>
    {{-- Modal Script --}}
</div>
@endsection
