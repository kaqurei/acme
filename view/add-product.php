<?php
// Build category list
$catList = '<select name="categoryId" id="catType">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
     $catList .= "<option value='$category[categoryId])'";
   if(isset($catType)){
     if($category['categoryId'] === $catType){
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
    <title>ACME Products - Add a Product</title>
    <meta name="description" content="ACME Products Dashboard">
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
        <h1>Add Product</h1>
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
            <input type="text" name="invName" id="invName" <?php if(isset($invName)){echo "value='$invName'";}  ?> required>
            </li>

            <li>
            <label id="productDesc">Description</label>
            <input type="text" name="invDescription" id="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?> required>
            </li>

            <li>
            <label id="productImage">Image</label>
            <input type="text" name="invImage" id="invImage" value="/acme/images/products/no-image.png">
            <input type="hidden" name="invThumbnail" id="invThumbnail" value="/acme/images/products/no-image.png">
            </li>

            <li>
            <label id="productPrice">Price</label>
            <input type="number" step="0.01" name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required>
            </li>

            <li>
            <label id="productStock">Stock</label>
            <input type="number" name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required>
            </li>

            <li>
            <label id="productSize">Size</label>
            <input type="number" name="invSize" id="invSize" <?php if(isset($invSize)){echo "value='$invSize'";}  ?> required>
            </li>

            <li>
            <label id="productWeight">Weight (lbs)</label>
            <input type="number" name="invWeight" id="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";}  ?> required>
            </li>

            <li>
            <label id="productLocation">Location</label>
            <input type="text" name="invLocation" id="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";}  ?> required>
            </li>

            <li>
            <label id="productVendor">Vendor</label>
            <input type="text" name="invVendor" id="invVendor" <?php if(isset($invVendor)){echo "value='$invVendor'";}  ?> required>
            </li>

            <li>
            <label id="productStyle">Style</label>
            <input type="text" name="invStyle" id="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";}  ?> required>
            </li>

           <li> 
               <input type="submit" value="Add Product">
            </li>
       </ul>
       <!-- Add the action name - value pair -->
       <input type="hidden" name="action" value="addProduct">
   </form>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>