<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPTrivia - 404 Not Found</title>

    <!-- Bootstrap CSS CDN -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/vendor/bootstrap/css/bootstrap.min.css" />
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="../../assets/vendor/bootstrap-icons/bootstrap-icons.min.css" />


    <!-- Custom styles -->
    <link rel="stylesheet" href="../../assets/css/main.css" />

</head>
<body>
    <!-- HEADER -->
    {{ component:header }}

    <!-- MAIN -->
    <main>
        <section class="py-5">
            <div class="text-center display-1 fw-bolder">
                <i class="bi bi-question-circle text-warning display-1"></i>
                <h3 class="display-1 fw-bold my-3">404 Not Found</h3>
                <p class="lead text-muted">The page you are looking for is not found</p>
                <a href="/" class="btn btn-primary rounded-pill px-4">Go to Home <i class="bi bi-arrow-right ps-2"></i></a>

            </div>
        </section>

    </main>


    <!-- FOOTER -->
    {{ component:footer }}
</body>
</html>