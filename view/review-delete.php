<?php
if (!isset($_SESSION['clientData']['clientEmail'])){
    $message = "<p>You must be logged in to edit or delete a review.</p>";
    include  '../view/login.php';
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME Reviews - Delete Review</title>
    <meta name="description" content="Delete Review Confirmation Page">
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
        <h1>Delete Review</h1>
        <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
<form method="post" action="/acme/reviews/index.php">
   <h2>Attention!</h2>
   <p>Deleting a review is permanent! It cannot be undone! Proceed only if you are really sure you want to delete your review FOREVER.</p>
       <ul>
       <li>
           <label id="product"><strong>Product:</strong></label>
            <?php echo $prodName[0]['invName'] ?> 
            </li>
           <li>
           <label id="date"><strong>Date:</strong></label>
            <?php echo $reviewInfo[0]['reviewDate'] ?> 
            </li>
            <li>
            <label id="review"><strong>Review:</strong></label>
            <?php echo $reviewInfo[0]['reviewText'] ?> 
            </li>
           <li> 
               <input type="submit" value="Delete Review">
            </li>
       </ul>
      <!-- Add the action name - value pair -->
      <input type="hidden" name="action" value="deleteReview">
       <!-- Add the reviewId to action -->
       <input type="hidden" name="reviewId" value="<?php if(isset($reviewInfo['reviewId'])){ echo $reviewInfo[0]['reviewId'];} elseif(isset($reviewId)){ echo $reviewId; } ?>">
       <input type="hidden" name="clientId" value="
       <?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} ?>">
   </form>
    </main>
    
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>
<?php unset($_SESSION['message']); ?>