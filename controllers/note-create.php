<?php

$heading = 'Create Note';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Next episode: Create new note using form data from $_POST.
    dd($_POST);
}

require 'views/node-create.view.php';