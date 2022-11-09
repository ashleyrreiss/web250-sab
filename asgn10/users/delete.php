<?php

require_once('../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('users/index.php'));
}
$id = $_GET['id'];
$user = User::find_by_id($id);
if($user == false) {
  redirect_to(url_for('users/index.php'));
}

if(is_post_request()) {

  // Delete user
  $result = $user->delete();
  $_SESSION['message'] = 'The user was deleted successfully.';
  redirect_to(url_for('users/index.php'));

} else {
  // Display form
}

?>

<?php $page_title = 'Delete User'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

  <a href="<?= url_for('users/index.php'); ?>">&laquo; Back to List</a>

    <h1>Delete User</h1>
    <p>Are you sure you want to delete this user?</p>
    <p class="item"><?= h($user->full_name()); ?></p>

    <form action="<?= url_for('users/delete.php?id=' . h(u($id))); ?>" method="post">
        <input type="submit" name="commit" value="Delete User" />
    </form>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
