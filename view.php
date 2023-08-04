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

?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>View User: <b>
                    <?= $user['name'] ?>
                </b></h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                <a href="update.php?id=<?= $user['id'] ?>" class="btn btn-secondary">Update</a>
                <form action="delete.php" method="POST" style="display: inline-block">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <th>Name: </th>
                        <td>
                            <?= $user['name'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Username: </th>
                        <td>
                            <?= $user['username'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Email: </th>
                        <td>
                            <?= $user['email'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Phone: </th>
                        <td>
                            <?= $user['phone'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Website: </th>
                        <td>
                            <a href="https://<?= $user['website'] ?>" target="_blank"><?= $user['website'] ?></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include_once __DIR__ . "/partials/footer.php" ?>