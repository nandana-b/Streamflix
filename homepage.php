<?php
// Start the session to manage user login states
session_start();

// Include the database connection file to enable database interactions
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streamflix</title>
    <!-- Google Fonts for custom fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Link to external stylesheet for styling the page -->
    <link rel="stylesheet" href="./styles/styleHome.css">
</head>
<body>
    <header>
        <nav class="top-nav">
            <!-- Logo of the website -->
            <div class="logo">Streamflix</div>
            <div class="user-controls">
                <!-- Welcome message for the user -->
                <div class="wlcm" style="color: #fffbf2;">
                    Hello,  
                    <?php 
                        // Check if the user is logged in with email
                        if(isset($_SESSION['email'])){
                            // Get the user's email from the session
                            $email = $_SESSION['email'];
                            // Query to get the user's first name based on the email
                            $query = mysqli_query($conn, "SELECT users.firstName FROM users WHERE users.email='$email'");
                            // Fetch and display the user's first name
                            while($row = mysqli_fetch_array($query)){
                                echo $row['firstName'];
                            }
                        } 
                        // Check if the user is logged in with Google
                        elseif(isset($_SESSION['google_email'])) {
                            // Display the user's name from the session
                            echo $_SESSION['google_name'];
                        }
                    ?>
                    :)
                </div>
                <!-- Logout button -->
                <div class="logout"><a href="logout.php" style="text-decoration: none; color: #fffbf2;">Logout</a></div>
            </div>
        </nav>
        <!-- Navigation bar for different movie categories -->
        <nav class="tab-nav">
            <ul class="tab-links">
                <li><a href="new.php">New Releases</a></li>
                <li><a href="upcoming.php">Upcoming Movies</a></li>
                <li><a href="popular.php">Popular Movies</a></li>
            </ul>
        </nav>
    </header>
    <!-- Main content container -->
    <div class="container">
        <!-- Search bar for searching movies -->
        <div class="search-container">
            <input type="text" placeholder="Search for a movie..." id="movie-name">
            <button id="search-btn">Search</button>
        </div>
        <!-- Div to display search results -->
        <div id="result"></div>
    </div>

    <!-- Script files for handling search functionality and other dynamic content -->
    <script src="./javascript/key.js"></script>
    <script src="./javascript/homeScript.js"></script>
</body>
</html>
