<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME | <?php echo $categoryName; ?> Products</title>
    <meta name="description" content="ACME <?php echo $categoryName; ?> products">
    <link rel="stylesheet" media="screen" href="/acme/css/main.css">
</head>

<body>

    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/header.php'; ?>
    </header>

    <nav>
        <!-- <?php // include $_SERVER['DOCUMENT_ROOT'].'/acme/common/nav.php'; ?> -->
        <?php echo $navList; ?>
    </nav>

    <main>
        <h1><?php echo $categoryName; ?> Products</h1>
        <?php if(isset($message)){ echo $message; } ?>
        <?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>