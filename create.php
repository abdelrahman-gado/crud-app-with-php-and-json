<?php

include_once __DIR__ . "/partials/header.php";
require_once __DIR__ . "/users/users.php";

$user = [
    "id" => "",
    "name" => "",
    "username" => "",
    "email" => "",
    "phone" => "",
    "website" => ""
];


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $user = array_merge($user, $_POST);

    [$is_valid, $errors] = validateUser($user);


    if ($is_valid) {
        $user = createUser($_POST);

        uploadImage($_FILES['picture'], $user);

        header('Location: index.php');
    }
}
?>

<?php include_once __DIR__ . "/_form.php" ?>


<?php include_once __DIR__ . "/partials/footer.php" ?>