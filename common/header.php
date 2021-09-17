<?php

//Build account link
if (empty($_SESSION['clientData']['clientEmail'])){
$accountLink = "<a href='/acme/accounts/index.php?action=login' title='Click here to view your account details'>My Account</a>";
$clientFirstName = "";
} else {
$accountLink = "<a href='/acme/accounts/index.php?action=Logout' title='Click here to log out'>Log Out</a>";
$clientFirstName = $_SESSION['clientData']['clientFirstname'];
}
?>

<div class="logo">
    <img src="/acme/images/site/logo.gif" alt="ACME Logo">
</div>
<div class="accountObjects">
    <img src="/acme/images/site/account.gif" alt="My Account Icon"> 
    <?php echo $accountLink; ?> <?php if(isset($_SESSION['clientData']['clientFirstname'])){
 echo "<span> | Welcome, <a href='/acme/accounts/'>$clientFirstName</a></span>";
} ?>
</div>