<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPTrivia - Welcome</title>

    <!-- Bootstrap CSS CDN -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css" />
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.min.css" />
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="../assets/vendor/fontawesome/css/all.min.css" />

    <!-- Custom styles -->
    <link rel="stylesheet" href="../../assets/css/main.css" />

</head>
<body>
    <!-- HEADER -->
    {{ component:header }}

    <!-- MAIN -->
    <main>

    <!-- Hero section -->
        <section class="py-5 my-3">
            <div class="container-fluid text-center mt-5">
                <h2 class="display-4 fw-bold">Welcome to <span class="text-secondary">PHPTrivia</span></h2>
                <p class="lead text-muted roboto-light">Test your knowledge, challenge your friends, and learn something new with our exciting quizzes!</p>

                <div class="container-fluid text-center">
                    <img src="../assets/imgs/php_elephant.png" alt="" width="120" class="img-fluid" />
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginBackdrop">Start Quiz</button>
                    <button type="button" class="btn btn-outline-primary">Continue Quiz</button>
                </div>
            </div>
        </section>


        <!-- Signup  -->
        <section>
            <!-- Login Modal -->
            {{ component:login-modal }}
        </section>

        <!-- Features Section -->
        <section class="py-5 my-5">
            <div class="container text-center">
                <h2 class="display-5 fw-bold my-4">Features</h2>

                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center p-3 m-3">
                            <i class="fas fa-laptop-code fa-5x text-secondary my-2"></i>
                            <h3 class="h4 fw-bold">PHP for All Skill Levels</h3>
                            <p class="lead roboto-light text-muted small">From beginner basics to advanced concepts, 
                                our quizzes cover every aspect of PHP development.</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="text-center p-3 m-3">
                            <i class="fas fa-stopwatch fa-5x text-secondary my-2"></i>
                            <h3 class="h4 fw-bold">Timed Challenges</h3>
                            <p class="lead roboto-light text-muted small">Test your knowledge under pressure with our timed quizzes.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="text-center p-3 m-3">
                            <i class="fas fa-trophy fa-5x text-secondary my-2"></i>
                            <h3 class="h4 fw-bold">Leaderboards</h3>
                            <p class="lead roboto-light text-muted small">Compete with friends and see how you rank globally.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="text-center p-3 m-3">
                            <i class="fas fa-shapes fa-5x text-secondary my-2"></i>
                            <h3 class="h4 fw-bold">Learn As You Play</h3>
                            <p class="lead roboto-light text-muted small">Gain new knowledge with every quiz you take.</p>
                        </div>
                    </div>                    
                </div>
            </div>
        </section>


    </main>


    <!-- FOOTER -->
    {{ component:footer }}
</body>
</html>