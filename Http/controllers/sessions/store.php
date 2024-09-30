<?php

use Core\App as CoreApp;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

// log in 
$db = CoreApp::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];
$form = new LoginForm();
if (!$form->validate($email, $password)) {
    return view('sessions/create.view.php', [
        'errors' => $form->errors(),
        'heading' => 'Login'
    ]);
}

$auth = new Authenticator();
$auth->attempt($email, $password);

if ($auth->attempt($email, $password)) {
    header('location: /');
    exit();
} else {

    return view('sessions/create.view.php', [
        'errors' => $errors,
        'heading' => 'Login'
    ]);
}
