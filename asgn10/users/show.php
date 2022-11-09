<?php require_once('../private/initialize.php'); ?>

<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$user = User::find_by_id($id);

?>

<?php $page_title = 'Show User: ' . h($user->full_name()); ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

  <a class="back-link" href="<?php echo url_for('users/index.php'); ?>">&laquo; Back to List</a>

    <h1>User: <?php echo h($user->full_name()); ?></h1>

      <dl>
        <dt>First name</dt>
        <dd><?php echo h($user->first_name); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($user->last_name); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($user->email); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($user->username); ?></dd>
      </dl>

