<!-- Signup Form -->
<main>
    <section class="px-2">
        <div class="container my-4 py-2 border rounded-2 shadow-sm" style="max-width: 400px;">
            <div class="text-center my-3">
                <h2 class="fw-bold text-primary">Register</h2>

            </div>

            <form action="/signup" method="post" id="signup-form">
                <!-- Username -->
                <div class="my-3">
                    <label for="username-id" class="form-label"><i class="bi bi-person"></i> Username</label><br>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text" name="username" id="username-id" class="form-control" placeholder="your_username" value="{{ :username }}" required />
                    </div>
                    <span class="float-end small text-danger">{{ :username_error }}</span>
                </div>

                <!-- Email -->
                <div class="my-3">
                    <label for="email-id" class="form-label"><i class="bi bi-envelope"></i> Email</label>
                    <input type="email" name="email" id="email-id" class="form-control" placeholder="you@example.com" value="{{ :email }}" required />
                    <span class="float-end small text-danger">{{ :email-error }}</span>
                </div>

                <div class="my-3">
                    <label for="password-id" class="form-label"><i class="fbi bi-lock"></i> Password</label>
                    <input type="password" name="password" id="password-id" class="form-control" placeholder="Password" required />
                    <span class="float-end small text-danger">{{ :password-error }}</span>
                </div>

                <div class="my-3">
                    <label for="password-confirm-id" class="form-label"><i class="bi bi-lock"></i> Confirm Password</label>
                    <input type="password" name="password-confirm" id="password-confirm-id" class="form-control" placeholder="Confirm Password" required />
                    <span class="float-end small text-danger">{{ :password-confirm-error }}</span>
                </div>

                <!-- Experience Level -->
                <div class="my-3">
                    <label for="experience-level-id" class="form-label"><i class="bi bi-book"></i> Experience Level</label>
                    <select name="experience-level" id="experience-level-id" class="form-select">
                        <option value="" disabled selected>Select your PHP experience</option>
                        <option value="1">Beginner</option>
                        <option value="2">Intermediate</option>
                        <option value="3">Advanced</option>
                    </select>
                    <span class="float-end small text-danger">{{ :experience-level-error }}</span>
                </div>

                <!-- Submit -->
                <div class="mt-3">
                    <button type="submit"  class="btn btn-primary d-block w-100">Start Quizzing</button>
                    <p class="text-center my-2">Already have an account? <a href="/login">Login</a></p>
                    <p class="small text-center my-2">By signing up, you agree to our Terms of Service and Privacy Policy</p>
                </div>
            </form>
        </div>
    </section>
</main>