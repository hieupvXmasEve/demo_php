<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

// validate the form inputs
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 8, 255)) {
    $errors['password'] = 'Please provide a valid password.';
}

if (count($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

// check if the account already exists
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if ($user) {
    $errors['email'] = 'Email already exists.';
    return view('registration/create.view.php', [
        'errors' => $errors,
        'email' => $email
    ]);
} else {
    // if not, save one to the database, and then log the user in, and redirect to the home page
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);
    // mark that the user has logger in.
    login($user);

    header('location: /');
    exit();
}
