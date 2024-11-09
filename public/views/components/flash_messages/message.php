<!-- General Message display toast -->
<div class="toast flash-message position-fixed top-0 start-50 mt-3 translate-middle-x align-items-center text-white bg-success border-0" role="alert">
    <div class="d-flex align-items-center px-3">
        <i class="fas fa-info-circle"></i>
        <div class="toast-body">
            {{ message }}
        </div>
        <button type="button" class="btn p-0 text-white ms-auto" data-bs-dismiss="toast" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<script>
    // Load all flash message
    const flashMessageEls = document.querySelectorAll(".flash-message");
    flashMessageEls.forEach(el => {
        (bootstrap.Toast.getOrCreateInstance(el))
            .show();
    })
</script>