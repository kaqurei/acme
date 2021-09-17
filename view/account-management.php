<?php
//Check that user is logged in, otherwise redirect them to home
  $clientData = getClient($_SESSION['clientData']['clientEmail']);
  if (!isset($_SESSION['clientData']['clientEmail'])){
  header("Location: ../index.php");
  }
//Display session messages, if any
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME | Update Your Account</title>
    <meta name="description" content="Update your ACME account">
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
        <h1>Update Your Account</h1>
        <?php if (isset($message)) {echo $message;}?>
<form method="post" action="/acme/accounts/index.php">
   <h2>Update Your Information</h2>
       <ul>
            <li>
            <label id="FirstName">First Name</label>
            <input type="text" name="clientFirstname" id="clientFirstname" 
            <?php if(isset($clientFirstname)){ echo "value='$clientFirstname'"; }elseif(isset($clientData['clientFirstname'])) 
            {echo "value='$clientData[clientFirstname]'"; }?> 
            required>
            </li>

            <li>
            <label id="LastName">Last Name</label>
            <input type="text" name="clientLastname" id="clientLastname" 
            <?php if(isset($clientLastname)){ echo "value='$clientLastname'"; }elseif(isset($clientData['clientLastname'])) 
            {echo "value='$clientData[clientLastname]'"; }?> 
            required>
            </li>

            <li>
            <label id="Email">Email Address</label>
            <input type="email" name="clientEmail" id="clientEmail" 
            <?php if(isset($clientEmail)){ echo "value='$clientEmail'"; }elseif(isset($clientData['clientEmail'])) 
            {echo "value='$clientData[clientEmail]'"; }?> 
            required>
            </li>
           <li> 
               <input type="submit" value="Update Info">
            </li>
       </ul>
       <!-- Add the action name - value pair -->
       <input type="hidden" name="action" value="updateUserInfo">
       <!-- Add the clientId to action -->
       <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
       elseif(isset($clientId)){ echo $clientId; } ?>">
   </form>
<p></p>
   <form method="post" action="/acme/accounts/index.php">
   <h2>Change Your Password</h2>
   <span class="labelTip">Password must be at least 8 characters with at least 1 uppercase character, 1 number and 1 special character.</span>
       <ul>
            <li>
            <label id="password">New Password</label>
            <input type="password" name="clientPassword" id="clientPassword" 
            pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></li>
            <li>
           <li> 
               <input type="submit" value="Change Password">
            </li>
       </ul>
       <!-- Add the action name - value pair -->
       <input type="hidden" name="action" value="updatePassword">
       <!-- Add the clientId to action -->
       <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
       elseif(isset($clientId)){ echo $clientId; } ?>">
   </form>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>
<?php unset($_SESSION['message']);?>