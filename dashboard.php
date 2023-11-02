<?php
session_start();

if (!isset($_SESSION['access_token'])) { // if user is not logged in
    header('Location: login.php'); // redirect to login page
    exit();
}

$access_token = $_SESSION['access_token']; // get the access token from the session
$user_info_url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token; // url to get user info from Google

$user_info_json = file_get_contents($user_info_url); // get user info from Google
$user_info = json_decode($user_info_json, true); // decode the json into an array

if (isset($user_info['name'])) { // if the name is in the array
    $user_name = $user_info['name']; // put the name into a variable
} else {
    $user_name = 'User'; // if not, just call them user
}

if (isset($_GET['logout'])) { 
    // User clicked the logout link, destroy the session
    session_unset(); // remove all session variables
    session_destroy(); // destroy session
    header('Location: login.php'); // redirect to login page
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            background-color: #f1f1f1;
        }
        
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ccc;
            padding: 50px;
            border-radius: 10px;
            background-color: #fff;
        }

        .logout-image {
            width: 150px;
            height: 50px;
            padding: 10px;
            border: 5px solid;
            border-color: black;
            border-radius: 10px;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            transition: box-shadow 0.3s, transform 0.3s;/* Add a smooth transition effect */
            transform: scale(1);
        }

        .logout-image:hover {
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6);
            transform: scale(1.01); 
        }
    </style>
</head>
<body>
    <div class="container">
    <h1>Hello,</br> <?php echo $user_name; ?>! </br>Welcome to Pandora Company Limited.</h1>
    <a href="dashboard.php?logout=1"> <!-- add logout url to button -->
        <img class="logout-image" src="logout.png" alt="Login with Google">
    </a>
    </div>
</body>
</html>
