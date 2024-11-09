<!-- Warning toast -->
<div class="toast flash-message align-items-center bg-danger text-white border-0" role="alert">
    <div class="d-flex align-items-center px-3">
        <i class="fas fa-user-times"></i>
        <div class="toast-body">
            Something went wrong: {{ message}}
        </div>
        <button type="button" class="btn p-0 text-white ms-auto" data-bs-dismiss="toast" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>