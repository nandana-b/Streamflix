// Get references to DOM elements
const signUpButton = document.getElementById('signUpButton'); // Sign up button
const signInButton = document.getElementById('signInButton'); // Sign in button
const signInForm = document.getElementById('signIn'); // Sign in form
const signUpForm = document.getElementById('signup'); // Sign up form

// Event listener for sign up button click
signUpButton.addEventListener('click', function() {
    signInForm.style.display = "none"; // Hide sign in form
    signUpForm.style.display = "block"; // Show sign up form
});

// Event listener for sign in button click
signInButton.addEventListener('click', function() {
    signInForm.style.display = "block"; // Show sign in form
    signUpForm.style.display = "none"; // Hide sign up form
});
