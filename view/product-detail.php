<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME | Products - <?php echo $prodInfo[0]['invName'];?></title>
    <meta name="description" content="ACME products - <?php echo $prodInfo[0]['invName'] ?>">
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
        <?php if(isset($_SESSION['message'])){
            $message = $_SESSION['message']; echo $message;} ?>
        <?php  echo $buildPage; ?>
        <?php  echo buildThumbView($imageArray, $databaseCount); ?>
        <?php  echo buildProductReviewDisplay($invId, $clientId, $reviewCount, $reviews); ?>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>
</html>
<?php unset($_SESSION['message']);?>