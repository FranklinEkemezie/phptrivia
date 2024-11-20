<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPTrivia - {{ title }}</title>

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

    <!-- Include other CSS files -->
    {{ @for:stylesheet => stylesheets }}

    <link rel="stylesheet" href="{{ stylesheets.stylesheet }}" />
    {{ @endfor }}

    <!-- Include other JavaScript files -->
    {{ @for:javascript => :javascripts }}
    <script src="{{ javascript }}" defer></script>
    {{ @endfor }}

    <style>
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }


    </style>

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