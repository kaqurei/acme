<?php
if (!isset($_SESSION['clientData']['clientEmail'])){
    $message = "<p>You must be logged in to add a review.</p>";
    include  '../view/login.php';
    exit;
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
    <h1><?php if(isset($prodInfo[0]['invName'])){ 
      echo "Review ".$prodInfo[0]['invName']."" ;} 
      elseif(isset($invName)) { echo $invName; }?></h1>
    <?php
   if (isset($message)) { 
    echo $message; 
   } ?>
   
   <form method="post" action="/acme/reviews/index.php">
   <h2>Your Review</h2>
        <ul>
            <li>
            <label id="review">Comments</label>
            <input type="text" name="reviewText" id="reviewText" 
            <?php if(isset($reviewText)){echo "value='$reviewText'";}  ?> required>
            </li>

            <li>
               <input type="submit" value="Submit Review">
            </li>
       </ul>
       <!-- Add the action name - value pair -->
       <input type="hidden" name="action" value="submitReview">
       <!-- Add the invId to action -->
       <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo[0]['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
       <!-- Add the clientId to action -->
       <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">
    </form>

    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>
<?php unset($_SESSION['message']); ?>