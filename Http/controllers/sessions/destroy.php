<?php

// log the user out

use Core\Authenticator;

$auth = new Authenticator();
$auth->logout();

// redirect to the home page
header('location: /');
exit();
