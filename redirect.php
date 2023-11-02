<?php
session_start();

if (isset($_GET['code'])) { // if the code param has been sent to this file
    $code = $_GET['code']; // put the code into a variable
    
    $client_id = '1019511608894-0ubg2v65b0iqs5vcfcjms0m4j1sbglpo.apps.googleusercontent.com'; // client id from Google API Console
    $client_secret = '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'; // client secret from Google API Console
    $redirect_uri = 'http://localhost:3000/redirect.php'; // url to redirect user to after login
    
    $token_url = 'https://accounts.google.com/o/oauth2/token'; // url to send curl request to get token
    
    $token_data = array( // put client data into array to send to get token
        'code' => $code, // the code from Google
        'client_id' => $client_id, // client id from Google API Console
        'client_secret' => $client_secret, // client secret from Google API Console
        'redirect_uri' => $redirect_uri, // url to redirect user to after login
        'grant_type' => 'authorization_code' // type of grant
    );
    
    $ch = curl_init($token_url); // start cURL to get token
    curl_setopt($ch, CURLOPT_POST, 1); // set cURL to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_data)); // set cURL data with fields from array
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // tell cURL to return data in a variable
    
    $token_response = curl_exec($ch); // execute cURL to get token
    curl_close($ch); // close cURL
    
    $token_data = json_decode($token_response, true); // decode the json response into an array
    
    if (isset($token_data['access_token'])) { // if the access token is in the array
        $_SESSION['access_token'] = $token_data['access_token']; // put the access token into a session variable
        header('Location: dashboard.php'); // redirect to dashboard
        exit();
    }
}

?>
