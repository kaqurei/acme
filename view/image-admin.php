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
    <title>Image Management</title>
    <meta name="description" content="ACME Image Management">
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
    <h1>Image Management</h1>
    <p>Welcome, please choose an option below.</p>

    <h2>Add New Product Image</h2>
    <?php
    if (isset($message)) {
        echo $message;
        } ?>
        
        <form action="/acme/uploads/" method="post" enctype="multipart/form-data">
        <label for="invItem">Product</label><br>
        <?php echo $prodSelect; ?><br><br>
        <label>Upload Image:</label><br>
        <input type="file" name="file1"><br>
        <input type="submit" class="regbtn" value="Upload">
        <input type="hidden" name="action" value="upload">
    </form>

    <h2>Existing Images</h2>
    <p class="notice">You must manually delete thumbnails related to full size images and vice versa.</p>
    <?php
    if (isset($imageDisplay)) {
        echo $imageDisplay;
        } ?>

    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>
    <script src="../js/products.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>