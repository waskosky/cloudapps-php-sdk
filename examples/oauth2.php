<?php

use CloudPrinter\CloudApps\Authentication\OAuth2;

$config = [
    'client_id' => '***',
    'client_secret' => '***',
    'redirect_uri' => 'http://www.your-site.com',
    'scope' => 'read-write'
];
$oAuth2 = new OAuth2($config);

// Step 1. Getting authorization code url.
$authorizationCodeUrl = $oAuth2->getAuthorizationCodeUrl();

// Step 2. Getting access token by authorization code that comes to redirect url.
$code = $_GET['code'];
$accessToken = $oAuth2->getAccessToken($code);


