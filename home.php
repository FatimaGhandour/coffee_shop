<?php include "connection.php";?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Fusion Artesian Cafe</title>
		<link rel="stylesheet" href="style.css" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@300&family=Cookie&family=Cormorant+Upright:wght@300&family=DM+Serif+Display:ital@1&family=Dancing+Script:wght@700&family=Delicious+Handrawn&family=EB+Garamond&family=Fasthand&family=Fjalla+One&family=Inter:wght@200&family=Kalam:wght@400;700&family=Pacifico&family=Playfair+Display&family=Prompt:ital,wght@1,500&family=Roboto:wght@100&family=Satisfy&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
		<div class="heroSection"></div>
		<h1 class="title">From Beans to Bliss</h1>
		<div class="gallery">
            <h2>Try the best</h2>
            <div class="hr-container">
            <hr class="hr-line">
        </div>
    <?php
    $sql = "SELECT * FROM gallery";
    $result = $con->query($sql);

    $cardNumber = 1;

    while ($row = $result->fetch_assoc()) {
        echo '<div class= "card__content">';
        echo '<div class="card__gallery card-' . $cardNumber . '">';
        echo '<img class = "card__image "src="data:images/jpg;base64,' . base64_encode($row['image']) . '" alt=" Image">';
        echo '<p ><p class="card__text">' . $row['text'] . '</p></p>';
        echo '</div>';
        echo '</div>';

        $cardNumber++;
    }
    ?>
</div>
		<div class="slideshow-section">
		<h1>Clients Reviews</h1>
        <div class="hr-container">
            <hr class="hr-line">
        </div>
    <div class="slideshow-container">
        <?php
		
        $query = "SELECT * FROM feedback ORDER BY id DESC LIMIT 3, 3";
        $result = mysqli_query($con, $query);

        if ($result) {
            $index = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='fade' id='feedback{$index}'>";
                echo "<p class='name'>{$row['name']}</p>";
                // echo "<p>Email: {$row['email']}</p>";
                echo "<p>{$row['message']}</p>";
                echo "</div>";
                $index++;
            }
        } else {
            echo "Error retrieving feedback: " . mysqli_error($con);
        }
        ?>
    </div>
	</div>

    <script>
        // JavaScript for the slideshow
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("fade");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 3000); // Change slide every 3 seconds
        }
    </script>
		<?php include "footer.php";?>
	</div>
	</body>
    <script src="./script.js"></script>

</html>