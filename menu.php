<?php
include 'connection.php'; // Include your database connection


$items = getItemsForAboutPage();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>About Us</title>
		<link rel="stylesheet" href="style.css" />
        <style>
    .menu__item-image:hover {
        border: 2px solid #333;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    }
</style>
</head>

<body>
<nav class="navbar">
			<img class="navlogo" src="\project\images\coffeelogo.png" alt="" />
			<ul class="navList">
				<li class="navList__item">
					<a href="home.php" class="item__link">Home</a>
				</li>
				<li class="navList__item">
					<a href="menu.php" class="item__link">Menu</a>
				</li>
				<li class="navList__item">
					<a href="feedback.php" class="item__link">Feedback</a>
				</li>
				<li class="navList__item">
					<a href="about.php" class="item__link">About</a>
				</li>
                <li class="navList__item">
                <a href="signup.php" class="item__link">Sign Up</a>
                </li>
				</ul>
                <div class="navbar__hamMenu" onclick="navbarMobileView()">
                <span class="navbar_hamMenu_span"></span>
                <span class="navbar_hamMenu_span"></span>
                <span class="navbar_hamMenu_span"></span>
            </div>
		</nav>
    <div class="heroSection_menu"></div>
	<h1 class="title__menu">Our menu is different!!</h1>
     <p class="text__menu">
        Try the best taste.                                                                   
        Today is your day.                                                                         
         We have our special offer.                                                     
         Sit in the cofe, get your favorite cup of Coffee                                            
        and enjoy with our 40% offer                                                   
     </p>
     <div class="detail">
        <h2 class="menu__head">Our Special Menu</h2>
          <div class="hr-container">
     <hr class="hr-line"></div></div>
   
 <section class="menu__container">
    <!-- Display Items with Images -->
  <h3 class="menu__items">Items in Stock</h3>
    <div class="menu__list">
         <?php foreach ($items as $item) : ?>
            <div class="menu__list__item">
                <!-- Check if the image file exists before displaying -->
                <?php
                $imagePath = $item["image"];
                if (file_exists($imagePath)) {
                    echo "<img src=\"$imagePath\" alt=\"{$item["name"]}\" class=\"menu__item-image\"  style=\"max-width: 150px; height: auto;\">";
                } else {
                    echo "Image not found: $imagePath";
                }
                ?>
                <div class="menu__item-details">
                    <strong><?= $item["name"] ?></strong> - <?= $item["description"] ?> (Price: <?= $item["price"] ?>)
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

    <!-- Your Intro Section -->
<?php include "footer.php";?>

</body>

</html>
