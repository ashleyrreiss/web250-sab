<?php

require_once('../private/initialize.php');

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['user'];
  $user = new user($args);
  $result = $user->save();

  if($result === true) {
    $new_id = $user->id;
    $_SESSION['message'] = 'The user was created successfully.';
    redirect_to(url_for('users/show.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $user = new User;
}

?>

<?php $page_title = 'Create User'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>


  <a class="back-link" href="<?php echo url_for('users/index.php'); ?>">&laquo; Back to List</a>

    <h1>Create User</h1>

    <?php echo display_errors($user->errors); ?>

    <form action="<?php echo url_for('users/new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

        <input type="submit" value="Create Member" />
    </form>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
