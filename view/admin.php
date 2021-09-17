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
    <title>ACME | Your Account</title>
    <meta name="description" content="View your account information.">
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
    <h1>Your Account</h1>
    <?php
   if (isset($message)) { 
    echo $message; 
   } ?>
    <ul>
        <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'] ?></li>
        <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
        <li>Email: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>
        <li><a href="?action=manageAccount">Manage Your Account</a></li>
        <li><a href="../reviews">Manage Your Reviews</a></li>
    </ul>
    <?php if($_SESSION['clientData']['clientLevel'] > 1){
        echo "<h2>Admin Panel</h2>
        <p>You are an administrator on this website. Please click the link below to manage products and catagories.</p>
        <a href='../products'>Manage Products & Catagories</a> <br>
        <a href='../uploads'>Manage Images</a>";
    } ?>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>
<?php unset($_SESSION['message']); ?>