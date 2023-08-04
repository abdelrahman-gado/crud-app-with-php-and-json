<?php

include_once __DIR__ . "/partials/header.php";
require_once __DIR__ . "/users/users.php";


if (!isset($_GET['id'])) {
    include_once __DIR__ . "/partials/not_found.php";
    exit;
}

$userId = $_GET['id'];

$user = getUserById($userId);

if (!$user) {
    include_once __DIR__ . "/partials/not_found.php";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $user = array_merge($user, $_POST);

    [$is_valid, $errors] = validateUser($user);

    if ($is_valid) {
        $updatedUser = updateUser($_POST, $userId);
        uploadImage($_FILES['picture'], $user);
        header('Location: index.php');
    }
}

?>


<?php include_once __DIR__ . "/_form.php"; ?>


<?php include_once __DIR__ . "/partials/footer.php" ?>