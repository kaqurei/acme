<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME Login</title>
    <meta name="description" content="Login to Your Account on ACME">
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
    <h1>Login to Your Account</h1>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form method="post" action="/acme/accounts/">
    <ul>
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
            <input type="submit" name="submit" id="loginButton" value="Login!">
        </li>
        <li>
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="Login">
        </li>
    </ul>
    </form>

    <p>Don't have an account?</p>
    <a class="button" href="/acme/accounts/index.php?action=registration">Register Now!</a>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>