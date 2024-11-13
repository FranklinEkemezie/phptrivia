<!-- General Message display toast -->
<div class="toast flash-message bg-danger text-white" role="alert">
    <div class="d-flex align-items-center px-3">
        <i class="fas fa-xmark-circle"></i>
        <div class="toast-body">
            Danger: {{ message }}
        </div>
        <button type="button" class="btn p-0 text-white ms-auto" data-bs-dismiss="toast" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
