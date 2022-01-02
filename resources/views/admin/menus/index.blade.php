@extends ('layouts.admin')
@section ('title', 'Manajemen Menu')

@section ('content')
<div id="admin-menu-main" class="py-3">
    <h5>Manajemen Menu</h5>

    @include ('shared.message')
    <div class="pt-2 pb-3">
        <a class="btn btn-primary btn-sm" href="{{ route('admin_menu_add_get') }}">Tambah Menu</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Status</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Ditambahkan Tanggal</th>
                <th scope="col" colspan="4">#</th>
            </thead>

            @if ($menus->isNotEmpty())
                @foreach ($menus as $m)
                <tr>
                    <td>{{ $m->name }}</td>
                    <td>Rp. {{ number_format( $m->price, 2, ',', '.' ) }}</td>
                    <td>
                        <span class="menu-status fw-bold" data-menu-status="{{ $m->status }}">
                            {{ $m->status }}
                        </span>
                    </td>
                    <td>{{ $m->quantity }}</td>
                    <td>{{ date('d M Y H:i:s', strtotime( $m->created_at )) }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('admin_menu_show_get', [ 'id' => $m->id ]) }}">
                            <i class="fas fa-eye"></i> Lihat Resep
                        </a>
                    </td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-secondary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#show-image"
                            data-menu-name="{{ $m->name }}"
                            data-menu-price="Rp. {{ number_format( $m->price, 2, ',', '.' ) }}"
                            data-menu-image="{{ $m->image }}"
                            onclick="showImage(this)"
                        >
                           <i class="fas fa-file-image"></i> Gambar
                        </button>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('admin_menu_edit_get', ['id' => $m->id]) }}">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                    </td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#remove-menu-modal"
                            data-menu-name="{{ $m->name }}"
                            data-menu-image="{{ $m->image }}"
                            data-remove-menu-link="{{ route('admin_menu_delete_get', [ 'id' => $m->id ]) }}"
                            onclick="removeMenu(this)"
                        >
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="fw-light text-center" colspan="6">Data menu kosong</td>
                </tr>
            @endif
        </table>
    </div>

    {{-- SHOW IMAGE --}}
    <!-- Modal -->
    <div class="modal fade" id="show-image" tabindex="-1" aria-labelledby="show-image-label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="show-image-label">Gambar Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="py-2">
                Nama Menu: <span class="fw-bold" id="menu-name"></span>
            </div>
            <div class="py-2">
                Harga: <span class="fw-bold" id="menu-price"></span>
            </div>
            <div class="py-2">
                <img class="img-fluid" id="menu-image" alt="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    {{-- SHOW IMAGE --}}

    {{-- Delete Menu Modal --}}
    <div id="remove-menu-modal" class="modal fade fw-light" tabindex="-1" aria-labelledby="remove-menu-modal-label">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="remove-menu-modal-label" class="modal-title">Hapus Menu</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus <span id="remove-menu-name" class="fw-bold"></span>?
                    <img id="remove-menu-image" class="img-fluid" alt="">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <a id="remove-menu-button" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete Menu Modal --}}

    <script>
        function showImage(el) {
            let menuNameEl = document.querySelector('#menu-name');
            let menuPriceEl = document.querySelector('#menu-price');
            let menuImageEl = document.querySelector('#menu-image');
            let menuName = el.dataset.menuName;
            let menuPrice = el.dataset.menuPrice;
            let menuImage = el.dataset.menuImage;

            menuNameEl.innerHTML = menuName;
            menuPriceEl.innerHTML = menuPrice;
            menuImageEl.src = menuImage;
        }

        function removeMenu(el) {
            let menuName = el.dataset.menuName;
            let menuImage = el.dataset.menuImage;
            let removeMenuLink = el.dataset.removeMenuLink;
            let menuNameEl = document.querySelector('#remove-menu-name');
            let menuImageEl = document.querySelector('#remove-menu-image');
            let removeMenuButton = document.querySelector('#remove-menu-button');

            menuNameEl.innerHTML = menuName;
            menuImageEl.src = menuImage;
            removeMenuButton.href = removeMenuLink;
        }
    </script>
</div>
@endsection
