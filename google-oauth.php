<?php
// Initialize the session
session_start();

// Include database connection file
include("connect.php");

// Google OAuth configuration
$google_oauth_client_id = 'YOUR_CLIENT_ID';
$google_oauth_client_secret = 'YOUR_CLIENT_SECRET';
$google_oauth_redirect_uri = 'http://localhost/login/google-oauth.php';
$google_oauth_version = 'v3';

// Check if the authorization code is set
if (isset($_GET['code']) && !empty($_GET['code'])) {
    // Parameters for the token request
    $params = [
        'code' => $_GET['code'],
        'client_id' => $google_oauth_client_id,
        'client_secret' => $google_oauth_client_secret,
        'redirect_uri' => $google_oauth_redirect_uri,
        'grant_type' => 'authorization_code'
    ];

    // Initialize cURL for the token request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the token request
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        error_log('Curl error: ' . curl_error($ch));
    }
    curl_close($ch);

    // Decode the response
    $response = json_decode($response, true);

    // Check if access token is received
    if (isset($response['access_token']) && !empty($response['access_token'])) {
        // Initialize cURL for the user info request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);

        // Execute the user info request
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            error_log('Curl error: ' . curl_error($ch));
        }
        curl_close($ch);

        // Decode the user info response
        $profile = json_decode($response, true);

        // Check if email is received in the profile
        if (isset($profile['email'])) {
            // Regenerate session ID for security
            session_regenerate_id();
            $_SESSION['google_loggedin'] = TRUE;
            $_SESSION['google_email'] = $profile['email'];
            $_SESSION['google_name'] = isset($profile['name']) ? $profile['name'] : '';
            $_SESSION['google_picture'] = isset($profile['picture']) ? $profile['picture'] : '';

            // Redirect to the homepage
            header('Location: homepage.php');
            exit;
        } else {
            // Log and display error if profile information is missing
            error_log('Could not retrieve profile information!');
            exit('Could not retrieve profile information! Please try again later!');
        }
    } else {
        // Log and display error if access token is invalid
        error_log('Invalid access token: ' . json_encode($response));
        exit('Invalid access token! Please try again later!');
    }
} else {
    // Redirect to Google OAuth authorization URL
    $params = [
        'response_type' => 'code',
        'client_id' => $google_oauth_client_id,
        'redirect_uri' => $google_oauth_redirect_uri,
        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
        'access_type' => 'offline',
        'prompt' => 'consent'
    ];
    header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
    exit;
}
?>
