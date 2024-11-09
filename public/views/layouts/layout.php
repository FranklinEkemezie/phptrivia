<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPTrivia - {{ title }}</title>

    <!-- Include CSS files -->
    {{ @for:stylesheet=>stylesheets }}
        <link rel="stylesheet" href="{{ stylesheet.href }}" />
    {{ @endfor }}

    <!-- Include JavaScript files -->
    {{ @for:script=>scripts }}
        <script src="{{ script.src }}" defer></script>
    {{ @endfor }}

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css" />
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.min.css" />
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="../assets/vendor/fontawesome/css/all.min.css" />

    <!-- Custom styles -->
    <link rel="stylesheet" href="../../assets/css/main.css" />

    <!-- Custom Javascript -->
    <script src="../../assets/js/main.js" defer></script>

</head>
<body>

    <!-- HEADER -->
    {{ &component:header }}

    <!-- MAIN -->
    {{ &view }}

    <!-- FOOTER -->
    {{ &component:footer }}

    <!-- FLASH MESSAGES -->
    {{ component:flash-message }}

    
</body>
</html>