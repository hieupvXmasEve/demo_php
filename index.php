<?php

require 'functions.php';
require 'Database.php';
//require 'router.php';

// connect to the database, execute a query


$config = require 'config.php';

$db = new Database($config['database']);

$id = $_GET['id'];
$query = "select * from posts where id = :id";
$posts = $db->query($query, [':id' => $id])->fetchAll(PDO::FETCH_ASSOC);
dd($posts);