<div class="message">
    @if (session('order_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('order_message') }}
        <button
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        >
        </button>
    </div>
    @endif

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
</div>
