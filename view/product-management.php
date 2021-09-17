<?php
//Check user level to display, otherwise redirect to home
$userLevel = $_SESSION['clientData']['clientLevel'];
if($userLevel < 2){
    header("Location: ../index.php");
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
    <title>ACME Products</title>
    <meta name="description" content="ACME Products">
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
    <h1>Product Management</h1>
    <?php
   if (isset($message)) { 
    echo $message; 
   } ?>
    <form>
   <ul>
       <li><label id="categories">Add New Category</label> <button type="submit" name="action" value="categoryDashboard">Go!</button></li>
       <li><label id="products">Add New Product</label> <button type="submit" name="action" value="productDashboard">Go!</button></li>
    </ul>
   </form>
   <?php
   if (isset($categoryList)) { 
    echo '<h2>Products By Category</h2>'; 
    echo '<p>Choose a category to see and edit those products.</p>'; 
    echo $categoryList; 
   }
   ?>
   <noscript> <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p> </noscript>
   <table id="productsDisplay"></table>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>
    <script src="../js/products.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>