<?php


require_once __DIR__ . "/users/users.php";

$users = getUsers();
?>

<?php include_once __DIR__ . "/partials/header.php" ?>

<div class="container">
  <div>
    <a class="btn btn-success" href="create.php">Create New User</a>
  </div>
  <table class="table">
    <thead>
      <th>Image</th>
      <th>Name</th>
      <th>Username</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Website</th>
      <th>Actions</th>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td>
            <?php if (isset($user['extension'])): ?>
              <img width="60px" height="60px" src="<?= "/users/images/{$user['id']}.{$user['extension']}" ?>" alt="">
            <?php endif; ?>
          </td>
          <td>
            <?= $user['name'] ?>
          </td>
          <td>
            <?= $user['username'] ?>
          </td>
          <td>
            <?= $user['email'] ?>
          </td>
          <td>
            <?= $user['phone'] ?>
          </td>
          <td>
            <a href="https://<?= $user['website'] ?>" target="_blank"><?= $user['website'] ?></a>
          </td>
          <td>
            <a href="view.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
            <a href="update.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-secondary">Update</a>
            <form action="delete.php" method="POST" style="display: inline-block">
              <input type="hidden" name="id" value="<?= $user['id'] ?>">
              <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>

<?php include_once __DIR__ . "/partials/footer.php" ?>