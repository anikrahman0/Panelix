@if (session('success'))
    <div class="success-msg">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> <strong>{{ session('success') }}</strong>
        </div>
    </div>
@endif