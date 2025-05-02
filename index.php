
<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "", "gcafe"); // Update credentials

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCafe</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <!-- Header Section -->
    <div class="header-container">
        <h1><i>The Gallery<br> Cafe</i></h1>
        <ul class="navbar">
            <li><a class="active" href="#">Home</a></li>
            <li><a href="Aboutus.html">About Us</a></li>
            <li><a href="second.html">Menu</a></li>
            <li><a href="fifth.html">Contact Us</a></li>
            <li><a href="signin.php">Sign In</a></li>
        </ul>
    </div><br><br>

    <!-- Hero Image & Intro -->
    <div class="image-container">
        <img src="Images01.png" alt="Cafe Image"> 
        <p2><br>"Embracing <br>the simplicity <br>& warmth <br>of the cafe experience."</p2>
    </div><br><br>

    <!-- Welcome Section -->
    <div class="intro-container">
        <h3>Welcome to The Gallery Cafe...</h3>
        <p>
            Discover an extraordinary dining experience at The Gallery Cafe, where culinary excellence meets artistic elegance.
            Nestled in the heart of Colombo, our cafe is a haven for food lovers and art enthusiasts alike.
            Indulge in a diverse menu featuring exquisite dishes crafted from the freshest ingredients, all served in an ambiance that celebrates creativity and culture.
            Whether you're joining us for a casual lunch, a romantic dinner, or a special event,
            The Gallery Cafe promises an unforgettable journey for your senses.
        </p>
    </div>

    <!-- Gallery Images -->
    <div class="images-container">
        <img src="images02.png" alt="First Image" class="image first-image">
        <img src="images03.png" alt="Second Image" class="image second-image">
        <img src="images06.png" alt="Third Image" class="image third-image">
        <img src="images04.png" alt="Fourth Image" class="image fourth-image">
    </div>

    <!-- Static Special Events -->
    <div class="special-container">
        <h2>Special Events</h2>
        <?php
        $conn = new mysqli("localhost", "root", "", "gcafe");

        if ($conn->connect_error) {
            echo "<p>Failed to connect to the database: " . $conn->connect_error . "</p>";
        } else {
            $result = $conn->query("SELECT * FROM events ORDER BY event_date ASC LIMIT 3");

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="event-container">';
                    echo '<a href="' . htmlspecialchars($row['image_path']) . '"><img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['title']) . '"></a>';
                    echo '<div class="description">';
                    echo '<h4>' . htmlspecialchars($row['title']) . '</h4>';
                    echo '<p>Date: ' . htmlspecialchars($row['event_date']) . '</p>';
                    echo '<p>Time: ' . htmlspecialchars($row['event_time']) . '</p>';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                    echo '<a href="signin.php" class="reservation-button">Reserve Your Spot</a>';
                    echo '</div></div>';
                }
            } else {
                echo "<p>No upcoming events found.</p>";
            }
            $conn->close();
        }
        ?>
    </div>

    <!-- Promotions Section -->
<h3>Promotions</h3>
<div class="promotions-container">
    <?php
    // Reconnect to DB if necessary
    $conn = new mysqli("localhost", "root", "", "gcafe");

    if ($conn->connect_error) {
        echo "<p>Failed to connect to the database: " . $conn->connect_error . "</p>";
    } else {
        $sql = "SELECT * FROM promotions ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="poster">';
                echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Promotional Poster">';
                echo '<div class="details">';
                echo '<button class="close-btn">Close</button>';
                echo '<div class="promotion-content">';
                echo '<h2 class="promotion-title">' . htmlspecialchars($row['title']) . '</h2>';
                echo '<p><strong>Valid Dates:</strong> ' . htmlspecialchars($row['valid_date']) . '</p>';
                echo '<p>' . htmlspecialchars($row['details']) . '</p>';
                echo '</div>';
                echo '<a href="signin.php" class="reservation-button">GET</a>';
                echo '</div></div>';
            }
        } else {
            echo "<p>No promotions available at this time.</p>";
        }
        $conn->close();
    }
    ?>
</div>


    

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 The Gallery Cafe. All Rights Reserved.</p>
        <p>
            <a href="Privacy.html">Privacy Policy</a>
            <a href="Terms.html">Terms of Service</a>
            <a href="Fifth.html">Contact Us</a>
        </p>
    </footer>

    <!-- Promotion Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const posters = document.querySelectorAll('.poster');

        posters.forEach(poster => {
            const details = poster.querySelector('.details');

            // When the poster is clicked, show its details
            poster.addEventListener('click', () => {
                details.classList.add('show');
            });

            // Close button hides the details
            const closeBtn = poster.querySelector('.close-btn');
            closeBtn.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent triggering poster click
                details.classList.remove('show');
            });
        });
    });
</script>

</body>
</html>
