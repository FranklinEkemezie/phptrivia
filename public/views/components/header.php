<header>
    <div class="container-fluid border-bottom">
        <!-- NavBar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="navbar-brand" href="/">
                    <h3 class="my-1 fw-bold">
                        <img src="../assets/imgs/icons/phptrivia.svg" alt="" class="img-fluid" width="40" />
                        PHPTrivia
                    </h3>
                </a>

                <!-- Toggle Button -->
                <button class="btn border-0 navbar-toggler border" type="button" data-bs-toggle="collapse" data-bs-target="#home-nav-bar">
                    <i class="bi bi-list"></i>
                </button>

                <!-- NavBar -->
                <div class="collapse navbar-collapse" id="home-nav-bar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <!-- Home -->
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>

                        <!-- Quizzes -->
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard/quizzes">Quizzes</a>
                        </li>

                        <!-- Leaderboard -->
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard/leaderboard">Leaderboard</a>
                        </li>

                        <!-- About -->
                        <li class="nav-item">
                            <a class="nav-link" href="/about">About</a>
                        </li>

                        <div class="ms-md-4 my-3 my-md-0">
                            <!-- Profile pix -->

                            <a href="/logout" class="btn border border-secondary">
                                <i class="fa fa-sign-out me-2"></i>
                                Logout
                            </a>

                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>