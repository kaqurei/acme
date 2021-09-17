<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME Register New Account</title>
    <meta name="description" content="Register for an account on ACME">
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
    <h1>Register for an Account</h1>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form method="post" action="/acme/accounts/index.php">
    <ul>
        <li>
            <h2>Account Info</h2>
        </li>
        <li>
        <em>***All fields required.***</em>
        </li>
        <li>
            <label id="firstname">First Name</label>
            <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required>
        </li>
        <li>
            <label id="lastname">Last Name</label>
            <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required>
        </li>
        <li>
            <label id="email">Email Address</label>
            <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
        </li>
        <li>
            <label id="password">Password</label>
            <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required> 
            <span class="labelTip">Password must be at least 8 characters with at least 1 uppercase character, 1 number and 1 special character.</span>
        </li>
        <li>
            <input type="submit" name="submit" id="registerButton" value="Register">
        </li>
        <li>
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="register">
        </li>
    </ul>
    </form>

    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>