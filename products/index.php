<?php

/**********************
* Products Controller *
***********************/

 // Create or access a Session 
 session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the functions library
require_once '../library/functions.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the products model
require_once '../model/products-model.php';

// Get the array of categories
$categories = getCategories();

// Build a navigation bar using the $categories array
$navList = buildNav($categories);


// Test that function worked by uncommenting the following two lines
// var_dump($categories);
//	exit;

// Switch action to display correct view
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = 'default';
  }
 }

 switch ($action){

  //** ACTION: View Product Dashboard **//
  case 'productDashboard':
  include '../view/add-product.php';
  break;

  //** ACTION: View Category Dashboard **//
  case 'categoryDashboard':
  include '../view/add-category.php';
  break;

  //** ACTION: Add New Product **//
  case 'addProduct':
// Filter and store the data
  $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
  $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
  $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
  $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
  $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
  $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
  $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
  $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
  $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
  $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
  $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

// Check for missing data - provide error messages specific to missing data
if(empty($invName)){
  $message = '<p>Please provide information for product name.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($invDescription)){
  $message = '<p>Please provide information for product description.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($invImage)){
  $message = '<p>Please provide information for product image.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($invThumbnail)){
  $message = '<p>Please provide information for product image thumbnail.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($invPrice)){
  $message = '<p>Please provide information for product price.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($invStock)){
  $message = '<p>Please provide information for product stock.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($invSize)){
  $message = '<p>Please provide information for product size.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($invWeight)){
  $message = '<p>Please provide information for product weight.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($invLocation)){
  $message = '<p>Please provide information for product location.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($categoryId)){
  $message = '<p>Please provide information for category.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($invVendor)){
  $message = '<p>Please provide information for product vendor.</p>';
  include '../view/add-product.php';
  exit;
}
if(empty($invStyle)){
  $message = '<p>Please provide information for product style.</p>';
  include '../view/add-product.php';
  exit;
}

// Send the data to the model
$itemOutcome = addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

// Check and report the result
if($itemOutcome === 1){
  $message = "<p>".$invName." has been added successfully.</p>";
  include '../view/add-product.php';
  exit;
} else {
  $message = "<p>Item registry failed. Please try again.</p>";
  include '../view/add-product.php';
  exit;
}
  break;

  //** ACTION: Add New Category **//
  case 'addCategory':
  // Filter and store the data
    $categoryName = filter_input(INPUT_POST, 'categoryName');
  
  // Check for missing data
  if(empty($categoryName)){
    $message = 'Please add name for new category.';
    include '../view/add-category.php';
    exit;
  }
    
  // Send the data to the model
  $catOutcome = addCategory($categoryName);
  
  // Check and report the result
  if($catOutcome === 1){
    header("Location: index.php");
    exit;
  } else {
    $message = "<p>Category registry failed. Please try again.</p>";
    include '../view/add-category.php';
    exit;
  }
    break;
    
    //** ACTION: Display list of inventory by category **//
    case 'getInventoryItems': 
    // Get the categoryId 
    $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT); 
    // Fetch the products by categoryId from the DB 
    $productsArray = getProductsByCategory($categoryId); 
    // Convert the array to a JSON object and send it back 
    echo json_encode($productsArray); 
    break;

    //** ACTION: Go to update view to modify record in the products database *//
    case 'mod':
    //Get inventory id and filter
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    //Send invId variable to function in Product Model to get information on product from database
    $prodInfo = getProductInfo($invId);
    //Check to see if prodInfo variable returned product data successfully. If not, display error
    if(count($prodInfo)<1){
      $message = 'Sorry, no product information could be found.';}
    //Display view to update data
    include '../view/product-update.php';
    exit;
    break;

    //** ACTION: Update inventory record in the database *//
    case 'updateProd':
    // Filter and store the data
  $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
  $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
  $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
  $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
  $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
  $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
  $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
  $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
  $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
  $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
  
  // Check for missing data - provide error messages specific to missing data
  if(empty($categoryId)){
    $message = '<p>Please provide information for category.</p>';
    include '../view/product-update.php';
    exit;
  }
  if(empty($invId)){
    $message = '<p>Sorry, product was not found.</p>';
    include '../view/product-update.php';
    exit;
  }
  if(empty($invName)){
  $message = '<p>Please provide information for product name.</p>';
  include '../view/product-update.php';
  exit;
}
  if(empty($invDescription)){
  $message = '<p>Please provide information for product description.</p>';
  include '../view/product-update.php';
  exit;
}
  if(empty($invImage)){
  $message = '<p>Please provide information for product image.</p>';
  include '../view/product-update.php';
  exit;
}
  if(empty($invThumbnail)){
  $message = '<p>Please provide information for product image thumbnail.</p>';
  include '../view/product-update.php';
  exit;
}
  if(empty($invPrice)){
  $message = '<p>Please provide information for product price.</p>';
  include '../view/product-update.php';
  exit;
}
  if(empty($invStock)){
  $message = '<p>Please provide information for product stock.</p>';
  include '../view/product-update.php';
  exit;
}
  if(empty($invSize)){
  $message = '<p>Please provide information for product size.</p>';
  include '../view/product-update.php';
  exit;
}
  if(empty($invWeight)){
  $message = '<p>Please provide information for product weight.</p>';
  include '../view/product-update.php';
  exit;
}
  if(empty($invLocation)){
  $message = '<p>Please provide information for product location.</p>';
  include '../view/product-update.php';
  exit;
}
  if(empty($invVendor)){
  $message = '<p>Please provide information for product vendor.</p>';
  include '../view/product-update.php';
  exit;
}
  if(empty($invStyle)){
  $message = '<p>Please provide information for product style.</p>';
  include '../view/product-update.php';
  exit;
}  
   // Send the data to the model
   $updateResult = updateProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, 
   $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle, $invId);

// Check and report the result
if($updateResult){
  //Include success message in session and redirect back to products page
  $message = "<p>".$invName." has been updated successfully.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
} else {
  $message = "<p>Item update failed. No information was changed. Please try again.</p>";
  include '../view/product-update.php';
  exit;
}
    break;

    //** ACTION: Delete a product **//
    case 'del':
    //Get inventory id and filter
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    //Send invId variable to function in Product Model to get information on product from database
    $prodInfo = getProductInfo($invId);
    //Check to see if prodInfo variable returned product data successfully. If not, display error
    if(count($prodInfo)<1){
      $message = 'Sorry, no product information could be found.';}
    //Display view to update data
    include '../view/product-delete.php';
    exit;
    break; 

    case 'deleteProd':
   $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
   $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
 
   // Send the data to the model
   $deleteResult = deleteProduct($invId);

// Check and report the result
if($deleteResult){
  //Include success message in session and redirect back to products page
  $message = "<p>".$invName." has been deleted successfully.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
} else {
  $message = "<p>Item delete failed. Please try again.</p>";
  include '../view/product-delete.php';
  exit;
}
    break; 

    //** ACTION: Click category in nav menu  */
    case 'category':
    // Get, filter, and store category name
    $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
    // Get products in the category
    $products = getProductsByCategoryName($categoryName);
    // Check to see if results were returned from the product list, display error if not. Call function to build HTML list if so.
    if(!count($products)){
      $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
    } else {
      $prodDisplay = buildProductsDisplay($products);
    }
    include '../view/category.php';
    break;

    //** ACTION: Click product in category display  */
    case 'viewProduct':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    //Send invId variable to function in Product Model to get information on product from database
    $prodInfo = getProductInfo($invId);
    //Get item thumbnails
    $imageArray = getThumbnails($invId);
    //Count item thumbnails in database for loop
    $databaseCount = countImages($invId);
    //Discover client viewing the page for purpose of review edit shortcut
    $clientId = getSessionClient(); 
    //Count reviews related to this item in database for loop
    $reviewCount = countReviews($invId);
    //Get reviews for item
    $reviews = getReviews($invId);
    //Build thumbnail view
    $buildThumbView = buildThumbView($imageArray, $databaseCount);
    //Display view
    $buildPage = buildProductPage($prodInfo);
    include '../view/product-detail.php';
    break;

    //** ACTION: Default, display management console **//
    default:
    //Call function to build category list and display related inventory data
    $categoryList = buildCategoryList($categories);
    include '../view/product-management.php';
    break;
}