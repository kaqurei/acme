<?php
if (!isset($_SESSION['clientData']['clientEmail'])){
    $message = "You must be logged in to edit a review.";
    include  '../view/login.php';
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME | Reviews - Edit Review</title>
    <meta name="description" content="Edit your review">
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
        <h1>Edit Review</h1>
        <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
<form method="post" action="/acme/reviews/index.php">
   <h2><?php echo $clientName[0]['clientFirstname'] ?>'s <?php echo $prodName[0]['invName'] ?> Review</h2>
       <ul>
            <li>
               <label id="date">Review Posted: <?php echo $reviewInfo[0]['reviewDate'] ?></label>
            </li>
            <li>
            <input type="text" name="reviewText" id="reviewText" 
            <?php if(isset($reviewText)){ echo "value='$reviewText'"; }elseif(isset($reviewInfo[0]['reviewText'])) {echo "value='".$reviewInfo[0]['reviewText']."'"; }?> 
            required>
            </li>
           <li> 
               <input type="submit" value="Update Review">
            </li>
       </ul>
       <!-- Add the action name - value pair -->
       <input type="hidden" name="action" value="updateReview">
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