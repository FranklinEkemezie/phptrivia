<section>
    <div class="toast-container flash-container position-fixed top-0 start-50 translate-middle-x mt-3">
        {{ messages }}
    </div>

    <script>
    // Load all flash message
    const flashMessageEls = document.querySelectorAll(".flash-container .flash-message");    
    flashMessageEls.forEach(el => {
        let toastInstance = bootstrap.Toast.getOrCreateInstance(el);

        console.log(toastInstance);

        toastInstance.show();
    });
    </script>
</section>