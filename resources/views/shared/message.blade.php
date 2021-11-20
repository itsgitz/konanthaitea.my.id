<div class="py-1"></div>
<div class="message">
    {{-- ORDER MESSAGE --}}
    @if (session('order_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('order_message') }}
        <a href="{{ route('client_orders_get') }}">lihat transaksi</a>
        <button
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        >
        </button>
    </div>
    @endif
    {{-- ORDER MESSAGE --}}

    {{-- REGISTERED USER MESSAGE --}}
    @if (session('registered_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('registered_message') }}
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        >
        </button>
    </div>
    @endif
    {{-- REGISTERED USER MESSAGE --}}

    {{-- ADD CART MESSAGE --}}
    @if (session('cart_add_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('cart_add_message') }}
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        >
        </button>
    </div>
    @endif
    {{-- ADD CART MESSAGE --}}

    {{-- DELETED CART MESSAGE --}}
    @if (session('cart_delete_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('cart_delete_message') }}
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        >
        </button>
    </div>
    @endif
    {{-- DELETED CART MESSAGE --}}

    {{-- UPDATED CART MESSAGE --}}
    @if (session('cart_update_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('cart_update_message') }}
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        >
        </button>
    </div>
    @endif
    {{-- UPDATED CART MESSAGE --}}
</div>
<div class="py-1"></div>
