@if (session('success'))
    <div class="success-msg">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> <span class="success-text">{{ session('success') }}</span>
        </div>
    </div>
@endif


<div class="success-msg-common">
    <p><i class="fa-solid fa-circle-check me-1"></i> Your verification link has been sent to your email address</p>
</div>