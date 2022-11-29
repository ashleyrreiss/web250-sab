<?php

require_once('../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('../web250/sab/users/index.php'));
}
$id = $_GET['id'];
$user = user::find_by_id($id);
if($user == false) {
  redirect_to(url_for('../web250/sab/users/index.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['user'];
  $user->merge_attributes($args);
  $result = $user->save();

  if($result === true) {
    $session->message('The user was updated successfully.');
    redirect_to(url_for('../web250/sab/users/show.php?id=' . $id));
  } else {
    // show errors
  }

} else {

  // display the form

}

?>

<?php $page_title = 'Edit user'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

  <a class="back-link" href="<?php echo url_for('../web250/sab/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="User edit">
    <h1>Edit User</h1>

    <?php echo display_errors($user->errors); ?>

    <form action="<?php echo url_for('../web250/sab/users/edit.php?id=' . h(u($id))); ?>" method="post">

      <?php include('form_fields.php'); ?>
        <input type="submit" value="Edit user" />

    </form>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
