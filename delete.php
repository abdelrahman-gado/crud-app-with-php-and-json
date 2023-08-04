<?php

require_once __DIR__ . "/users/users.php";


if (!isset($_POST['id'])) {
    include_once __DIR__ . "/partials/not_found.php";
    exit;
}

$userId = $_POST['id'];

deleteUser($userId);

header("Location: index.php");