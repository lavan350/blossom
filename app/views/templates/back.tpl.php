<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blossom | Back-office</title>

    <!-- General CSS -->
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/responsiveMenu.css">
    <link rel="stylesheet" href="/public/css/template.back.css">

    <!-- Module CSS -->
    <link rel="stylesheet" href="/public/css/back/adminBar.css">
    <link rel="stylesheet" href="/public/css/back/sideMenu.css">

    <!-- Back-office CSS -->
    <link rel="stylesheet" href="/public/css/back/<?php echo $this->sView ?>.css">

    <!-- Footer CSS -->
    <link rel="stylesheet" href="/public/css/back/footer.css">
</head>

<body>

    <header>        
        <!-- Admin Bar -->
        <?php include("views/back/modules/adminBar.php") ?>
    </header>

    <main>
        <section class="row back">
            <!-- Side Menu -->
            <?php include("views/back/modules/sideMenu.php") ?>
            <!-- Main View -->
            <?php include("views/back/" . $this->sView . ".view.php"); ?>
        </section>
    </main>

    <footer>
        <!-- Footer -->
        <?php include("views/back/footer.view.php")?>
    </footer>

    <script src="/public/js/lib/jquery.min.js"></script>
    <script src="/public/js/iconManager.js"></script>
</body>

</html>