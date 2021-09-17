<?php  if(isset($_SESSION['message'])){
            $message = $_SESSION['message']; 
            echo $message;} ?>
<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ACME | Home</title>
    <meta name="description" content="ACME Home">
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
        <h1>Welcome to ACME!</h1>
        <div id="hero">
            <div id="features">
                <ul>
                    <li>
                        <h2>Acme Rocket</h2>
                    </li>
                    <li>Quick lighting fuse</li>
                    <li>NHTSA approved seat belts</li>
                    <li>Mobile launch stand included</li>
                    <li><a href="/acme/cart/" title="Click here to add to your cart"><img id="actionbtn"
                                alt="Add to cart button" src="images/site/iwantit.gif"></a></li>
                </ul>
            </div>
        </div>

        <section class="twoColumn">
            <div class="reviews">
                <h2>ACME Rocket Reviews</h2>
                <ul>
                    <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                    <li>"That thing was fast!" (4/5)</li>
                    <li>"Talk about fast delivery." (5/5)</li>
                    <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                    <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                </ul>
            </div>
            <div class="recipes">
                <h2>Featured Recipes</h2>
                <div class="recipesWrap">
                    <figure>
                        <img src="images/recipes/bbqsand.jpg" alt="Pulled Roadrunner BBQ">
                        <figcaption><a href="#" title="Click here to view recipe for Pulled Roadrunner BBQ">Pulled
                                Roadrunner BBQ</a></figcaption>
                    </figure>
                    <figure>
                        <img src="images/recipes/potpie.jpg" alt="Roadrunner Pot Pie">
                        <figcaption><a href="#" title="Click here to view recipe for Roadrunner Pot Pie">Roadrunner
                                Pot Pie</a></figcaption>
                    </figure>
                    <figure>
                        <img src="images/recipes/soup.jpg" alt="Roadrunner Soup">
                        <figcaption><a href="#" title="Click here to view recipe for Roadrunner Soup">Roadrunner
                                Soup</a></figcaption>
                    </figure>
                    <figure>
                        <img src="images/recipes/taco.jpg" alt="Roadrunner Tacos">
                        <figcaption><a href="#" title="Click here to view recipe for Roadrunner Tacos">Roadrunner
                                Tacos</a></figcaption>
                    </figure>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/common/footer.php'; ?>
    </footer>

</body>

</html>