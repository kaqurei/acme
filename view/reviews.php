<?php
//Check that user is logged in, otherwise redirect them to home
$clientData = getClient($_SESSION['clientData']['clientEmail']);
if (!isset($_SESSION['clientData']['clientEmail'])){
header("Location: ../index.php");
}
  //Display session messages, if any
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?>
<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME | Reviews</title>
    <meta name="description" content="Add product review.">
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
    <h1>Your Reviews</h1>
    <?php
   if (isset($message)) { 
    echo $message; 
   } ?>
   
   <?php echo buildUserReviewDisplay($reviews, $databaseCount); ?>

    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>
<?php unset($_SESSION['message']); ?>