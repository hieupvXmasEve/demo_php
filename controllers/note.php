<?php
$config = require('config.php');
$db = new Database($config['database']);

$heading = 'Notes';

$currentUserId = 4;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] !== $currentUserId);


$note = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $_GET['id']])->find();

require "views/note.view.php";