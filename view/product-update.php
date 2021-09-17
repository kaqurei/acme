<?php
// Build the categories option list
$catList = '<select name="categoryId" id="catType">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
 $catList .= "<option value='$category[categoryId]'";
 if(isset($catType)){
  if($category['categoryId'] === $catType){
   $catList .= ' selected ';
  }
 } elseif(isset($prodInfo[0]['categoryId'])){
  if($category['categoryId'] === $prodInfo[0]['categoryId']){
   $catList .= ' selected ';
  }
 }
$catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';

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
      echo "Modify $prodInfo[invName] ";} 
      elseif(isset($invName)) { echo $invName; }?></title>
    <meta name="description" content="<?php if(isset($prodInfo['invName'])){ 
      echo "Modify $prodInfo[invName] ";} 
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
        <h1><?php if(isset($prodInfo[0]['invName'])){ 
      echo "Modify ".$prodInfo[0]['invName']."" ;} 
      elseif(isset($invName)) { echo $invName; }?></h1>
        <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
<form method="post" action="/acme/products/index.php">
   <h2>All Fields Required</h2>
       <ul>
           <li>
               <label id="chooseCat">Category</label> <?php echo $catList; ?> 
            </li>

            <li>
            <label id="productName">Item Name</label>
            <input type="text" name="invName" id="invName" 
            <?php if(isset($invName)){ echo "value='$invName'"; }elseif(isset($prodInfo[0]['invName'])) {echo "value='".$prodInfo[0]['invName']."'"; }?> 
            required>
            </li>

            <li>
            <label id="productDesc">Description</label>
            <input type="text" name="invDescription" id="invDescription" 
            <?php if(isset($invDescription)){ echo "value='$invDescription'"; }elseif(isset($prodInfo[0]['invDescription'])) {echo "value='".$prodInfo[0]['invDescription']."'"; }?> 
            required>
            </li>

            <li>
            <label id="productImage">Image</label>
            <input type="text" name="invImage" id="invImage" 
            <?php if(isset($invImage)){ echo "value='$invImage'"; }elseif(isset($prodInfo[0]['invImage'])) {echo "value='".$prodInfo[0]['invImage']."'"; }?> 
            required>
            </li>

            <li>
            <label id="productImageThumb">Image Thumbnail</label>
            <input type="text" name="invThumbnail" id="invThumbnail" 
            <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; }elseif(isset($prodInfo[0]['invThumbnail'])) {echo "value='".$prodInfo[0]['invThumbnail']."'"; }?> 
            required>
            </li>

            <li>
            <label id="productPrice">Price</label>
            <input type="number" step="0.01" name="invPrice" id="invPrice" 
            <?php if(isset($invPrice)){ echo "value='$invPrice'"; }elseif(isset($prodInfo[0]['invPrice'])) {echo "value='".$prodInfo[0]['invPrice']."'"; }?> 
            required>
            </li>

            <li>
            <label id="productStock">Stock</label>
            <input type="number" name="invStock" id="invStock" 
            <?php if(isset($invStock)){ echo "value='$invStock'"; }elseif(isset($prodInfo[0]['invStock'])) {echo "value='".$prodInfo[0]['invStock']."'"; }?> 
            required>
            </li>

            <li>
            <label id="productSize">Size</label>
            <input type="number" name="invSize" id="invSize" 
            <?php if(isset($invSize)){ echo "value='$invSize'"; }elseif(isset($prodInfo[0]['invSize'])) {echo "value='".$prodInfo[0]['invSize']."'"; }?> 
            required>
            </li>

            <li>
            <label id="productWeight">Weight (lbs)</label>
            <input type="number" name="invWeight" id="invWeight" 
            <?php if(isset($invWeight)){ echo "value='$invWeight'"; }elseif(isset($prodInfo[0]['invWeight'])) {echo "value='".$prodInfo[0]['invWeight']."'"; }?> 
            required>
            </li>

            <li>
            <label id="productLocation">Location</label>
            <input type="text" name="invLocation" id="invLocation" 
            <?php if(isset($invLocation)){ echo "value='$invLocation'"; }elseif(isset($prodInfo[0]['invLocation'])) {echo "value='".$prodInfo[0]['invLocation']."'"; }?> 
            required>
            </li>

            <li>
            <label id="productVendor">Vendor</label>
            <input type="text" name="invVendor" id="invVendor" 
            <?php if(isset($invVendor)){ echo "value='$invVendor'"; }elseif(isset($prodInfo[0]['invVendor'])) {echo "value='".$prodInfo[0]['invVendor']."'"; }?> 
            required>
            </li>

            <li>
            <label id="productStyle">Style</label>
            <input type="text" name="invStyle" id="invStyle" 
            <?php if(isset($invStyle)){ echo "value='$invStyle'"; }elseif(isset($prodInfo[0]['invStyle'])) {echo "value='".$prodInfo[0]['invStyle']."'"; }?> 
            required>
            </li>

           <li> 
               <input type="submit" value="Update Product">
            </li>
       </ul>
       <!-- Add the action name - value pair -->
       <input type="hidden" name="action" value="updateProd">
       <!-- Add the invId to action -->
       <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo[0]['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
   </form>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>