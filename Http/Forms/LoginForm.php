<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];
    public function validate($email, $password)
    {
        if (!Validator::email($email)) {
            $this->errors['email'] = 'Please provide a email address.';
        }
        if (!Validator::string($password, 7, 255)) {
            $this->errors['password'] = 'Please provide a password of at least 8 characters.';
        }
        return empty($this->errors);
    }
    public function errors()
    {
        return $this->errors;
    }
}
