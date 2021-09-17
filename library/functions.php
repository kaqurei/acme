<?php
     // Get client data based on an email address
     function getClient($clientEmail){
      $db = acmeConnect();
      $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, 
              clientLevel, clientPassword FROM clients WHERE clientEmail = :email';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
      $stmt->execute();
      $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      return $clientData;
     }

// Validate email and password strings
function checkEmail($clientEmail){
    $validEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $validEmail;
   }

function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
 return preg_match($pattern, $clientPassword);
}

   // Build a navigation bar using the $categories array
function buildNav($categories) {
$navList = '<ul>';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
 $navList .= "<li><a href='/acme/products?action=category&categoryName=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= '</ul>';
return $navList;
}

// Verify the registration email is not in the database already
function verifyEmail($clientEmail) {
   $db = acmeConnect();
   $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
   $stmt->execute();
   $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
   $stmt->closeCursor();
   if(empty($matchEmail)){
    return 0;
   } else {
    return 1;
   }
  }

  // Build the categories select list 
  function buildCategoryList($categories){ 
   $catList = '<select name="categoryId" id="categoryList">'; 
   $catList .= "<option>Choose a Category</option>"; 
   foreach ($categories as $category) { 
    $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
   } 
   $catList .= '</select>'; 
   return $catList; 
  }

  function getSessionClient(){
    if(isset ($_SESSION['clientData']['clientId'])){
      $client = $_SESSION['clientData']['clientId'];
    }else{
      $client = "Visitor";
    }
    return $client;
  }

     // Get product information by invId
function getProductInfo($invId){
   $db = acmeConnect();
   $sql = 'SELECT * FROM inventory WHERE invId = :invId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->execute();
   $prodInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $prodInfo;
  }

  // Build product display from category when category is selected from nav menu
  function buildProductsDisplay($products){
   $pd = '<ul id="prod-display">';
   foreach ($products as $product) {
    $pd .= '<li><figure>';
    $pd .= "<a href='?action=viewProduct&id=$product[invId]'><h2>$product[invName]</h2>";
    $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
    $pd .= "<figcaption><strong>Price:</strong> $$product[invPrice]</figcaption>";
    $pd .= '</figure></li>';
   }
   $pd .= '</ul>';
   return $pd;
  }

  function buildThumbView($imageArray, $databaseCount){
   $thumbView = '<div class="product-wrap">';
   $thumbView .= '<h2>Product Thumbnails</h2>';
   $thumbView .= '<div class="thumbView">'; 
   if ($databaseCount == 0) {
      $thumbView .= "<p>No thumbnails found.</p></div></div>";
   }else{
   for($i = 0; $i <= $databaseCount - 1; $i++) { 
      $thumbView .= "<figure><img src=".$imageArray[$i]['imgPath']." alt='Thumbnail'></figure>"; 
   } 
   $thumbView .= '</div>'; 
   $thumbView .= '</div>'; 
   }
   return $thumbView; 
  }

  function buildProductPage($prodInfo){
   $prodPage = '<div id="product-wrap">';
   $prodPage .= '<div id="prod-inner-wrap">';
   $prodPage .= '<img class="small-view" src='.$prodInfo[0]['invImage'].' alt="Image of '.$prodInfo[0]['invName'].'">';
   $prodPage .= '<h1>'.$prodInfo[0]['invName'].'</h1>';
   $prodPage .= '<p><em>See product reviews below thumbnails.</em></p>';
   $prodPage .= '<strong>Description:</strong> '.$prodInfo[0]['invDescription'];
   $prodPage .= '<ul>';
   $prodPage .= '<li><strong>Primary Material:</strong> '.$prodInfo[0]['invStyle'].'</li>';
   $prodPage .= '<li><strong>Weight:</strong> '.$prodInfo[0]['invWeight'].'</li>';
   $prodPage .= '<li><strong>Shipping Size:</strong> '.$prodInfo[0]['invSize'].'</li>';
   $prodPage .= '<li><strong>Ships from '.$prodInfo[0]['invLocation'].'</strong></li>';
   $prodPage .= '<li><strong>Number in stock:</strong> '.$prodInfo[0]['invStock'].'</li>';
   $prodPage .= '</ul>';
   $prodPage .= '<p class="price">$'.$prodInfo[0]['invPrice'].'</p>';
   $prodPage .= '</div>';
   $prodPage .= '<img class="large-view" src='.$prodInfo[0]['invImage'].' alt="Image of '.$prodInfo[0]['invName'].'">';
   $prodPage .= '</div>';
   return $prodPage;
  }

  // Build user reviews display
  function buildUserReviewDisplay($reviews, $databaseCount) {
     $reviewDisplayUser = "<div class='userDisplay'>";
   if ($databaseCount == 0) {
     $reviewDisplayUser .= "<p>No reviews found.</p>";
   }else{
   for($i = 0; $i <= $databaseCount - 1; $i++) { 
     $reviewDisplayUser .= "<ul>"; 
     $reviewDisplayUser .= "<li><strong>Date:</strong> ".$reviews[$i]['reviewDate']." </li>"; 
     $reviewDisplayUser .= "<li><strong>Review:</strong> ".$reviews[$i]['reviewText']." </li>";
     $reviewDisplayUser .= "<li><strong><a href='?action=editReview&id=".$reviews[$i]['reviewId']."'>Edit Review</a></strong></li>";
     $reviewDisplayUser .= "<li><strong><a href='?action=confirmDelete&id=".$reviews[$i]['reviewId']."'>Delete Review</a></strong></li>";
     $reviewDisplayUser .= "</ul>"; 
       }
     }
   $reviewDisplayUser .= "</div>";
     return $reviewDisplayUser;
   }

     // Build product reviews display
  function buildProductReviewDisplay($invId, $clientId, $reviewCount, $reviews) {
   $reviewDisplayProduct = "<div class='productDisplay'>";
   $reviewDisplayProduct .= "<div class='reviewHead-wrapper'><h2>Product Reviews</h2>";
 if ($reviewCount == 0) {
   $reviewDisplayProduct .= "</div><p>No reviews found. <strong><a href='../reviews/?action=addReview&invId=".$invId."'>Add the first!</a></p>";
 }else{
  $reviewDisplayProduct .= "<p><strong><a href='../reviews/?action=addReview&invId=".$invId."'>Add a new review!</a></strong></p></div>";
 for($i = 0; $i <= $reviewCount - 1; $i++) {
  $userId = $reviews[$i]['clientId'];
  $userLastName = getUserLastName($userId);
  $userFirstName = getUserFirstName($userId);
  $screenName = createScreenName($userFirstName, $userLastName);
   $reviewDisplayProduct .= "<ul>"; 
   $reviewDisplayProduct .= "<li><strong>User:</strong> ".$screenName." </li>"; 
   $reviewDisplayProduct .= "<li><strong>Date:</strong> ".$reviews[$i]['reviewDate']." </li>"; 
   $reviewDisplayProduct .= "<li><strong>Review:</strong> ".$reviews[$i]['reviewText']." </li>";
   if ($clientId == $reviews[$i]['clientId'] ) {
   $reviewDisplayProduct .= "<li><strong><a href='../reviews/?action=editReview&id=".$reviews[$i]['reviewId']."'>Edit Review</a></strong></li>";
   }
   $reviewDisplayProduct .= "</ul>"; 
     }
   }
   $reviewDisplayProduct .= "</div>";
   return $reviewDisplayProduct;
 }

 function getUserLastName($userId) {
    $db = acmeConnect(); 
    $sql = ' SELECT clientLastname FROM clients WHERE clientId = :userId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $lastName = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $lastName; 
 }

 function getUserFirstName($userId) {
  $db = acmeConnect(); 
  $sql = ' SELECT clientFirstname FROM clients WHERE clientId = :userId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':userId', $userId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $firstName = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $firstName; 
}

function createScreenName($userFirstName, $userLastName){
  $firstName = $userFirstName[0]['clientFirstname'];
  $screenName = substr($firstName, 0, 1);
  $screenName .= $userLastName[0]['clientLastname'];
  return $screenName;
}

function getProductByReview($productId){
  $db = acmeConnect(); 
  $sql = ' SELECT invName FROM inventory WHERE invId = :productId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':productId', $productId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $product = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $product; 
}

/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
   $i = strrpos($image, '.');
   $image_name = substr($image, 0, $i);
   $ext = substr($image, $i);
   $image = $image_name . '-tn' . $ext;
   return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
   $id = '<ul id="image-display">';
   foreach ($imageArray as $image) {
    $id .= '<li>';
    $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
    $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
    $id .= '</li>';
   }
   $id .= '</ul>';
   return $id;
  }

  // Build the products select list
function buildProductsSelect($products) {
   $prodList = '<select name="invId" id="invId">';
   $prodList .= "<option>Choose a Product</option>";
   foreach ($products as $product) {
    $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
   }
   $prodList .= '</select>';
   return $prodList;
  }

  // Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
   // Gets the paths, full and local directory
   global $image_dir, $image_dir_path;
   if (isset($_FILES[$name])) {
    // Gets the actual file name
    $filename = $_FILES[$name]['name'];
    if (empty($filename)) {
     return;
    }
   // Get the file from the temp folder on the server
   $source = $_FILES[$name]['tmp_name'];
   // Sets the new path - images folder in this directory
   $target = $image_dir_path . '/' . $filename;
   // Moves the file to the target folder
   move_uploaded_file($source, $target);
   // Send file for further processing
   processImage($image_dir_path, $filename);
   // Sets the path for the image for Database storage
   $filepath = $image_dir . '/' . $filename;
   // Returns the path where the file is stored
   return $filepath;
   }
  }

  // Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
   // Set up the variables
   $dir = $dir . '/';
  
   // Set up the image path
   $image_path = $dir . $filename;
  
   // Set up the thumbnail image path
   $image_path_tn = $dir.makeThumbnailName($filename);
  
   // Create a thumbnail image that's a maximum of 200 pixels square
   resizeImage($image_path, $image_path_tn, 200, 200);
  
   // Resize original to a maximum of 500 pixels square
   resizeImage($image_path, $image_path, 500, 500);
  }

  // Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
   // Get image type
   $image_info = getimagesize($old_image_path);
   $image_type = $image_info[2];
  
   // Set up the function names
   switch ($image_type) {
   case IMAGETYPE_JPEG:
    $image_from_file = 'imagecreatefromjpeg';
    $image_to_file = 'imagejpeg';
   break;
   case IMAGETYPE_GIF:
    $image_from_file = 'imagecreatefromgif';
    $image_to_file = 'imagegif';
   break;
   case IMAGETYPE_PNG:
    $image_from_file = 'imagecreatefrompng';
    $image_to_file = 'imagepng';
   break;
   default:
    return;
  } // ends the resizeImage function
  
   // Get the old image and its height and width
   $old_image = $image_from_file($old_image_path);
   $old_width = imagesx($old_image);
   $old_height = imagesy($old_image);
  
   // Calculate height and width ratios
   $width_ratio = $old_width / $max_width;
   $height_ratio = $old_height / $max_height;
  
   // If image is larger than specified ratio, create the new image
   if ($width_ratio > 1 || $height_ratio > 1) {
  
    // Calculate height and width for the new image
    $ratio = max($width_ratio, $height_ratio);
    $new_height = round($old_height / $ratio);
    $new_width = round($old_width / $ratio);
  
    // Create the new image
    $new_image = imagecreatetruecolor($new_width, $new_height);
  
    // Set transparency according to image type
    if ($image_type == IMAGETYPE_GIF) {
     $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
     imagecolortransparent($new_image, $alpha);
    }
  
    if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
     imagealphablending($new_image, false);
     imagesavealpha($new_image, true);
    }
  
    // Copy old image to new image - this resizes the image
    $new_x = 0;
    $new_y = 0;
    $old_x = 0;
    $old_y = 0;
    imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
  
    // Write the new image to a new file
    $image_to_file($new_image, $new_image_path);
    // Free any memory associated with the new image
    imagedestroy($new_image);
    } else {
    // Write the old image to a new file
    $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
  } // ends the if - else began on line 36