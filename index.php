<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Link to Google Fonts for custom fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Special+Elite&display=swap" rel="stylesheet">
    <!-- Link to external stylesheet for custom styles -->
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <!-- Container for the registration form, initially hidden -->
    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">Register</h1>
        <form method="post" action="register.php">
            <!-- Input group for first name -->
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
                <label for="fname">First Name</label>
            </div>
            <!-- Input group for last name -->
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                <label for="lName">Last Name</label>
            </div>
            <!-- Input group for email -->
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <!-- Input group for password -->
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <!-- Submit button for the registration form -->
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <!-- Separator for alternative login methods -->
        <p class="or">
            <br>
            ----------or--------
            <br><br>
        </p>
        <!-- Button for Google OAuth login -->
        <div class="g-btn">
            <a href="google-oauth.php">
                Continue with Google
            </a>
        </div>
        <!-- Link to switch to the sign-in form -->
        <div class="links">
            <p>Already Have Account? <button id="signInButton">Sign In</button></p>
        </div>
    </div>

    <!-- Container for the sign-in form -->
    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="register.php">
            <!-- Input group for email -->
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <!-- Input group for password -->
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <!-- Submit button for the sign-in form -->
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <!-- Separator for alternative login methods -->
        <p class="or">
            <br>
            ----------or--------
            <br><br>
        </p>
        <!-- Button for Google OAuth login -->
        <div class="g-btn">
            <a href="google-oauth.php">
                Continue with Google
            </a>
        </div>
        <!-- Link to switch to the registration form -->
        <div class="links">
            <p>Don't have account yet? <button id="signUpButton">Sign Up</button></p>
        </div>
    </div>
    <!-- Link to external JavaScript file for handling form switching -->
    <script src="./javascript/script.js"></script>
</body>
</html>
