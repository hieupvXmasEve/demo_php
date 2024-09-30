<?php

use Core\App as CoreApp;
use Core\Database;
use Core\Validator;
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
// match the credentials
$user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        login($user);
        header('location: /');
        exit();
    }
}

// if the credentials are not valid
$errors['password'] = 'The provided credentials are incorrect.';

return view('sessions/create.view.php', [
    'errors' => $errors,
    'heading' => 'Login'
]);
