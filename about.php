<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css" />
    <title>About Us</title>
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

<section id="about">
    <div class="about-content">
       <u> <h2>About Us</h2></u>
       <div class="about_team">
        <p>
            Welcome to kaishin Cafe, where we blend artistry with the finest ingredients to create
            an unforgettable experience. Our cafe is more than just a place to enjoy delicious food and
            beverages; it's a canvas of flavors that tell a story.
        </p>
        <img src="images/aboutteam.jpg" alt="">
</div>
<div class="about_story">
    
        <p>
        <b>Our Story:</b><br><br>
            At kaishin Cafe, we take pride in offering a diverse menu that caters to every palate.
            From artisanal coffees to mouth-watering crepes, each item is crafted with passion and precision.
            Our goal is to provide a warm and inviting space where you can savor the moment and indulge in
            culinary delights.
        </p>
        <img src="images/cafe.jpg" alt="">
</div>
<div class="about_team">
        <p>
        <b>Our Product</b><br><br> Explore our menu featuring a delightful selection of coffees, crepes, and more. Each item is
            carefully curated to deliver a unique and satisfying experience. Whether you're here for a
            refreshing beverage or a hearty meal, our commitment to quality and flavor shines through.
        </p>
        <img src="images/product.jpg" alt=""></div>
    </div>
</section>
<?php include "footer.php";?>
</body>
</html>