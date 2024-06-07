<?php
// Start the session
session_start();

// Include the database connection file
include("connect.php");

// API key for The Movie Database (TMDb)
$api_key = "9a9d653a7ab7e5f532d70976d936ef5c";

// API URL for fetching popular movies
$api_url = "https://api.themoviedb.org/3/movie/upcoming?api_key={$api_key}&language=en-US&page=1";

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);// Set the API URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the response as a string
$output = curl_exec($ch);// Execute the cURL request
curl_close($ch);// Close the cURL session

// Decode the JSON response to an associative array
$movies = json_decode($output, true);
// Get the results array from the response
$movies = $movies['results'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Movies</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="./styles/extra.css">
</head>
<body>
    <header>
        <!-- Top navigation -->
        <nav class="top-nav">
            <div class="logo"><a href="homepage.php">Streamflix</a></div>
            <div class="user-controls">
                <div class="wlcm" style="color: #fffbf2;">
                    Hello,  
                    <?php 
                    // Display the user's first name if logged in
                        if(isset($_SESSION['email'])){
                            $email=$_SESSION['email'];
                            $query=mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
                            while($row=mysqli_fetch_array($query)){
                                echo $row['firstName'];
                            }
                        }
                    ?>
                    :)
                </div>
                <div class="logout"><a href="logout.php" style="text-decoration: none;color: #fffbf2;">Logout</a></div>
            </div>
        </nav>
        <!-- Tab navigation -->
        <nav class="tab-nav">
            <ul class="tab-links">
                <li><a href="new.php">New Releases</a></li>
                <li><a href="upcoming.php">Upcoming Movies</a></li>
                <li><a href="popular.php">Popular Movies</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Upcoming Movies</h1>
        <!-- Display upcoming movies -->
        <div id="upcoming-movies" class="movie-grid">
            <?php foreach ($movies as $movie): ?>
                <div class="movie-card" onclick='showMovieInfo(<?php echo json_encode($movie); ?>)'>
                    <img src="https://image.tmdb.org/t/p/w500<?php echo $movie['poster_path']; ?>" alt="<?php echo $movie['title']; ?> poster">
                    <h2><?php echo $movie['title']; ?></h2>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal for displaying movie details -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modal-poster" src="" alt="Movie Poster">
            <div id="movie-details">
                <h2 id="modal-title"></h2>
                <p id="modal-rating"></p>
                <h3>Overview: </h3>
                <p id="modal-overview"></p>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="left-content">
                <div class="fLogo">Streamflix</div><!-- Added Streamflix logo -->
                <div class="horizontal-line"></div> <!-- Moved the horizontal line outside of the .footer-content -->
                <div class="footer-links">
                    <a href="homepage.php"> > Home</a>
                </div>
                <div class="footer-contact">
                <p>Contact us: <a href="mailto:streamflicksoff@gmail.com">streamflicksoff@gmail.com</a></p>
                </div>
            </div>
            <img src="./styles/images/dp.png" alt="Your Image" style="width: 150px; height: auto;"> <!-- Your image -->
        </div>
        <div class="horizontal-line"></div> <!-- Moved the horizontal line outside of the .footer-content -->
        <p>&copy; Streamflix 2024. All rights reserved.</p>
    </footer>

    <!-- JavaScript for handling the modal -->
    <script src="./javascript/rest.js"></script>
</body>
</html>
