<div class="modal fade px-2" id="loginBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-block border my-0 pt-3">
                <!-- Close button -->
                <button type="button" class="btn btn-sm btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="text-center">
                    <h1 class="modal-title h4 fw-bold" id="loginBackdropLabel">
                        <img src="../assets/imgs/icons/phptrivia.svg" alt="" class="img-fluid" width="40" /> <br>
                        Welcome to <span class="text-primary">PHPTrivia</span>
                    </h1>
                    <p class="text-muted mb-0">Signup to start your PHP adventure!</p>

                </div>
            </div>

            <div class="modal-body">
                <!-- Login Form -->
                <div class="container-fluid">
                    <form action="/signup" method="post" id="signup-form">
                        <!-- Username -->
                        <div class="my-2 mb-3">
                            <label for="username-id" class="form-label"><i class="bi bi-person"></i> Username</label><br>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input type="text" name="username" id="username-id" class="form-control" placeholder="your_username" required />
                            </div>
                            <span class="float-end small text-danger">{{ :username_error }}</span>
                        </div>

                        <!-- Email -->
                        <div class="my-2 mb-3">
                            <label for="email-id" class="form-label"><i class="bi bi-envelope"></i> Email</label>
                            <input type="email" name="email" id="email-id" class="form-control" placeholder="you@example.com" required />
                            <span class="float-end small text-danger">{{ :email-error }}</span>
                        </div>

                        <div class="my-2 mb-3">
                            <label for="password-id" class="form-label"><i class="fbi bi-lock"></i> Password</label>
                            <input type="password" name="password" id="password-id" class="form-control" placeholder="Password" required />
                            <span class="float-end small text-danger">{{ :password-error }}</span>
                        </div>

                        <div class="my-2 mb-3">
                            <label for="password-confirm-id" class="form-label"><i class="bi bi-lock"></i> Confirm Password</label>
                            <input type="password" name="password-confirm" id="password-confirm-id" class="form-control" placeholder="Confirm Password" required />
                            <span class="float-end small text-danger">{{ :password-confirm-error }}</span>
                        </div>

                        <!-- Experience Level -->
                        <div class="my-2 mb-3">
                            <label for="experience-level-id" class="form-label"><i class="bi bi-book"></i> Experience Level</label>
                            <select name="experience_level" id="experience-level-id" class="form-select">
                                <option value="" disabled selected>Select your PHP experience</option>
                                <option value="1">Beginner</option>
                                <option value="2">Intermediate</option>
                                <option value="3">Advanced</option>
                            </select>
                        </div>

                        <div class="my-3">
                            <button type="submit"  class="btn btn-primary d-block w-100">Start Quizzing</button>
                            <p class="small text-center my-2">By logging in, you agree to our Terms of Service and Privacy Policy</p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer d-block py-1">
                <div class="text-center small">
                    <p class="small text-black-50">
                        Did you know? PHP originally stood for "Personal Home Page"!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/signup-modal.js" defer></script>