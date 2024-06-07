<?php 

// Display errors for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection file
include 'connect.php';

// Sign Up form submission handling
if(isset($_POST['signUp'])){
    // Retrieve form data
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Encrypt the password using md5 hashing
    $password = md5($password);

    // Check if the email already exists in the database
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if($result->num_rows > 0){
        echo "Email Address Already Exists!";
    }
    else{
        // Insert user data into the database
        $insertQuery = "INSERT INTO users(firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
        if($conn->query($insertQuery) == TRUE){
            // Redirect to index.php after successful registration
            header("location: index.php");
        }
        else{
            echo "Error: " . $conn->error;
        }
    }
}

// Sign In form submission handling
if(isset($_POST['signIn'])){
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Encrypt the password using md5 hashing
    $password = md5($password);
   
    // Check if the email and password match in the database
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        // Start a session and store the user's email
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        // Redirect to homepage.php after successful login
        header("Location: homepage.php");
        exit();
    }
    else{
        echo "Not Found, Incorrect Email or Password!";
    }
}
?>
