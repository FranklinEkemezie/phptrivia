<main>
    <!-- Login Form -->
    <section class="px-2">
        <div class="container my-3 py-2 border rounded-2 shadow-sm" style="max-width: 400px;">
            <div class="text-center my-3">
                <h2 class="fw-bold text-primary">Sign In</h2>

            </div>

            <form action="/signup" method="post" id="login-form">

                <!-- Username/Email -->
                <div class="my-3">
                    <label for="username-email-id" class="form-label"><i class="bi bi-person"></i> Username or Email</label><br>
                    <input type="text" name="username-email" id="username-email-id" class="form-control" placeholder="your_username" value="{{ :username }}" required />
                </div>

                <!-- Password -->
                <div class="my-3">
                    <label for="password-id" class="form-label"><i class="fbi bi-lock"></i> Password</label>
                    <input type="password" name="password" id="password-id" class="form-control" placeholder="Password" required />
                </div>

                <!-- Submit -->
                <div class="mt-3">
                    <button type="submit"  class="btn btn-primary d-block w-100">Login</button>
                    <p class="text-center my-2">Don't have an account? <a href="/signup">Register</a></p>
                    <p class="small text-center my-2">By logging in, you agree to our Terms of Service and Privacy Policy</p>
                </div>
            </form>
        </div>
    </section>
</main>