<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Feedback Form</title>
		<link rel="stylesheet" href="style.css" />

</head>

<body>
    
     <!-- Display Second Half of Feedback as Slideshow -->
     <h1 class="feedback__title">Add Your Feedback</h1>
     <div class="slideshow-section">
		
        <!-- <div class="hr-container">
            <hr class="hr-line">
        </div> --> 
    <div class="slideshow-container">
        <?php
		include "connection.php";
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
<div class="feedback-section">
<?php
    
    // Fetch recent feedback from the database
    $query = "SELECT * FROM feedback ";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='feedback-item'>";
            echo "<p> {$row['name']}</p>";
            echo "<p>{$row['message']}</p>";
            echo "</div>" ;
        }
    } else {
        echo "Error retrieving feedback: " . mysqli_error($con);
    }
    ?></div>

     <form class="feedback-form" method="post" action="feedback_form.php">
     
<h2>Write your feedback </h2>

    <label for="name">Name:</label>
    <input type="text" name="name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="message">Feedback:</label>
    <textarea name="message" rows="4" required></textarea>

    <button type="submit">
Submit Feedback
</button>
</form>
    <?php include "footer.php";?>
</body>

</html>
