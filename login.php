<?php
session_start();

if (isset($_SESSION['access_token'])) { // if user is already logged in
    header('Location: dashboard.php'); // redirect to dashboard
    exit();
}

$auth_url = 'https://accounts.google.com/o/oauth2/auth'; // url to send user to Google to login
$redirect_uri = 'http://localhost:3000/redirect.php'; // url to redirect user to after Google login

// insert your client id given by google oauth2 gives
$client_id = client_secret.client_id; // client id from Google API Console

$scope = 'https://www.googleapis.com/auth/userinfo.profile'; // scope of data to retrieve from Google

$login_url = $auth_url . '?redirect_uri=' . urlencode($redirect_uri) . '&client_id=' . $client_id . '&scope=' . $scope . '&response_type=code'; // create login url

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login with Google</title>
    <style type="text/css">
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
        body {
            background-color: #f1f1f1;
        }

        .image {
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            transition: box-shadow 0.3s, transform 0.3s;/* Add a smooth transition effect */
            transform: scale(1);
        }
        /* add hover to button image */
        .image:hover {
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6);
            transform: scale(1.01); 
        }
    </style>

</head>



<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Login with Google</h1>
                <a href="<?php echo $login_url; ?>"> <!-- add login url to button -->
                    <img class="image" src="google-login-button.png" alt="Login with Google">
                </a>
            </div>
        </div>
</body>
</html>
