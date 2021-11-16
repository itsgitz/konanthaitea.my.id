<div class="message">
    @if (session('order_message'))
    <div class="alert alert-success alert-dismissable fade show" role="alert">
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
    <div class="py-3">
        <h4 class="text-success fw-light">{{ session('registered_message') }}</h4>
    </div>
    @endif
</div>
