<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;
$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] != $currentUserId);


$note = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $_GET['id']])->find();
view("notes/show.view.php", [
    'heading' => "Note",
    'note' => $note
]);
