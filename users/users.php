<?php

function getUsers(): array
{
    $users = json_decode(
        json: file_get_contents(__DIR__ . "/users.json"),
        associative: true
    );

    return $users;
}

function getUserById(int|string $id): ?array
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }

    return null;
}

function createUser(array $data): array
{
    $users = getUsers();
    $data['id'] = rand(1000000, 2000000);
    $users[] = $data;

    putJson($users);

    return $data;
}

function updateUser(array $data, int|string $id): array
{
    $updateUser = [];
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            $users[$i] = $updateUser = array_merge($user, $data);
        }
    }

    putJson($users);

    return $updateUser;
}

function deleteUser(int|string $id)
{
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            array_splice($users, $i, 1);
            break;
        }
    }

    putJson($users);
}


function uploadImage(array $file, array $user): void
{
    // update the image, if we only uploaded one
    if (isset($_FILES['picture']) && $_FILES['picture']['name']) {

        if (!is_dir(__DIR__ . "/images")) {
            mkdir(__DIR__ . "/images");
        }

        // Get the file extension from the filename
        $filename = $file['name'];
        $dotPosition = strpos($filename, '.');
        $extension = substr($filename, $dotPosition + 1);

        // Delete the old picture for current user.
        if (
            isset($user['extension'])
            && file_exists(__DIR__ . "/images/{$user['id']}.{$user['extension']}")
        ) {
            unlink(__DIR__ . "/images/{$user['id']}.{$user['extension']}");
        }

        move_uploaded_file(
            $file['tmp_name'],
            __DIR__ . "/images/{$user['id']}.{$extension}"
        );

        $updatedUser['extension'] = $extension;
        updateUser($updatedUser, $user['id']);
    }
}


function putJson(array $users): void
{
    file_put_contents(
        __DIR__ . "/users.json",
        json_encode($users, JSON_PRETTY_PRINT)
    );
}


function validateUser($user)
{
    $errors = [
        "name" => "",
        "username" => "",
        "email" => "",
        "phone" => "",
        "website" => ""
    ];

    $is_valid = true;

    // Start of validation
    if (!$user['name']) {
        $errors['name'] = 'Name is mandatory';
        $is_valid = false;
    }

    if (!$user['username'] || strlen($user['username']) < 6 || strlen($user['username']) > 16) {
        $errors['username'] = 'Username is required and it must be between 6 and 16 character inclusively';
        $is_valid = false;
    }

    if ($user['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "This must be a valid email address";
        $is_valid = false;
    }

    if (!filter_var($user['phone'], FILTER_VALIDATE_INT)) {
        $errors['phone'] = "This must be a valid phone number";
        $is_valid = false;
    }

    // End of validation

    return [$is_valid, $errors];
}