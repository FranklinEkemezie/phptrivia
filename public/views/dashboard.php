<link rel="stylesheet" href="../assets/css/dashboard.css">

<main>
    <section>
        <div class="main-container container-fluid px-0">

            <!-- Side bar - show on mobile only -->
            <div class="sidebar d-md-none offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-header border-bottom">
                    <!-- Brand -->
                    <a class="navbar-brand" href="/">
                        <h3 class="my-1 fw-bold">
                            <img src="../assets/imgs/icons/phptrivia.svg" alt="" class="img-fluid" width="40" />
                            PHPTrivia
                        </h3>
                    </a>
                    <button type="button" class="btn btn-close p-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body px-0">
                    <div class="list-group list-group-flush my-3">
                        <a href="/dashboard" class="list-group-item list-group-item-action border-bottom active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                        <a href="/dashboard/quiz" class="list-group-item list-group-item-action border-bottom"><i class="bi bi-question-circle me-2"></i> Quizzes</a>
                        <a href="/dashboard/leaderboard" class="list-group-item list-group-item-action border-bottom"><i class="bi bi-trophy me-2"></i> Leaderboard</a>
                        <a href="/dashboard/profile" class="list-group-item list-group-item-action border-bottom"><i class="bi bi-person me-2"></i>Profile</a>
                    </div>
                </div>
            </div>

            <!-- Side bar - show on desktop only -->
            <div class="sidebar d-none d-md-block border-end">
                <div class="offcanvas-body px-0">
                    <div class="list-group list-group-flush my-3">
                        <a href="/dashboard" class="list-group-item list-group-item-action border-bottom active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                        <a href="/dashboard/quiz" class="list-group-item list-group-item-action border-bottom"><i class="bi bi-question-circle me-2"></i> Quizzes</a>
                        <a href="/dashboard/leaderboard" class="list-group-item list-group-item-action border-bottom"><i class="bi bi-trophy me-2"></i> Leaderboard</a>
                        <a href="/dashboard/profile" class="list-group-item list-group-item-action border-bottom"><i class="bi bi-person me-2"></i>Profile</a>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="main-content">
                <!-- Side bar toggle button - Show only on mobile -->
                <button class="btn btn-outline-primary m-2 d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"><i class="bi bi-chevron-double-right"></i> Menu</button>

                {{ component:main-content }}
            </div>
        </div>
    </section>
</main>