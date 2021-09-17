<?php
//Check user level to display, otherwise redirect to home
$userLevel = $_SESSION['clientData']['clientLevel'];
if($userLevel < 2){
    header("Location: ../index.php");
}
?>
<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME Products - Add a Category</title>
    <meta name="description" content="ACME Categories Dashboard">
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
        <h1>Add Category</h1>
        <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
<form method="post" action="/acme/products/index.php">
       <ul>
            <li>
            <label id="category">Category Name</label>
            <input type="text" name="categoryName" id="categoryName" <?php if(isset($categoryName)){echo "value='$categoryName'";}  ?> required>
            </li>

           <li> 
               <input type="submit" value="Add Category">
            </li>
       </ul>
       <!-- Add the action name - value pair -->
       <input type="hidden" name="action" value="addCategory">
   </form>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>