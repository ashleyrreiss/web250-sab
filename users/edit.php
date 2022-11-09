<?php

require_once('../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/users/index.php'));
}
$id = $_GET['id'];
$admin = admin::find_by_id($id);
if($admin == false) {
  redirect_to(url_for('users/index.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['admin'];
  $admin->merge_attributes($args);
  $result = $admin->save();

  if($result === true) {
    $_SESSION['message'] = 'The admin was updated successfully.';
    redirect_to(url_for('users/show.php?id=' . $id));
  } else {
    // show errors
  }

} else {

  // display the form

}

?>

<?php $page_title = 'Edit admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

  <a class="back-link" href="<?php echo url_for('/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="User edit">
    <h1>Edit User</h1>

    <?php echo display_errors($user->errors); ?>

    <form action="<?php echo url_for('/users/edit.php?id=' . h(u($id))); ?>" method="post">

      <?php include('form_fields.php'); ?>
        <input type="submit" value="Edit admin" />

    </form>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
