<?php
//Check user level to display, otherwise redirect to home
$userLevel = $_SESSION['clientData']['clientLevel'];
if($userLevel < 2){
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME Products - <?php if(isset($prodInfo['invName'])){ 
      echo "Delete $prodInfo[invName] ";} 
      elseif(isset($invName)) { echo $invName; }?></title>
    <meta name="description" content="<?php if(isset($prodInfo['invName'])){ 
      echo "Delete $prodInfo[invName] ";} 
      elseif(isset($invName)) { echo $invName; }?>">
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
        <h1><?php if(isset($prodInfo['invName'])){ 
      echo "Delete $prodInfo[invName] ";} 
      elseif(isset($invName)) { echo $invName; }?></h1>
        <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
<form method="post" action="/acme/products/index.php">
   <h2>Attention!</h2>
   <p>Deleting an item is permanent! It cannot be undone! Proceed only if you are really sure you want to delete <?php echo "$prodInfo[invName]" ?> FOREVER.</p>
       <ul>
            <li>
            <label id="productName">Item Name</label>
            <input type="text" name="invName" id="invName" 
            <?php if(isset($invName)){ echo "value='$invName'"; }elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?> 
            readonly>
            </li>

            <li>
            <label id="productDesc">Description</label>
            <?php if(isset($invDescription)){ echo "value='$invDescription'"; }elseif(isset($prodInfo['invDescription'])) {echo "$prodInfo[invDescription]"; }?> 
            </li>
           <li> 
               <input type="submit" value="Delete Product">
            </li>
       </ul>
       <!-- Add the action name - value pair -->
       <input type="hidden" name="action" value="deleteProd">
       <!-- Add the invId to action -->
       <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">
   </form>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>