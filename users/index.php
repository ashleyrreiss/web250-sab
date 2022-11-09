<?php 
  require_once('../private/initialize.php');   
  $users = User::find_all();
  $page_title = 'Members'; 
  include(SHARED_PATH . '/user_header.php'); 
?>

    <h1>Members</h1>
      <a href="<?php echo url_for('users/new.php'); ?>">Add member</a>

  	<table border="1">
      <tr>
        <th>ID</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Username</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($users as $user) { ?>
        <tr>
          <td><?= h($user->id); ?></td>
          <td><?= h($user->first_name); ?></td>
          <td><?= h($user->last_name); ?></td>
          <td><?= h($user->email); ?></td>
          <td><?= h($user->username); ?></td>
          <td><a href="<?= url_for('users/show.php?id=' . h(u($user->id))); ?>">View</a></td>
          <td><a href="<?= url_for('users/edit.php?id=' . h(u($user->id))); ?>">Edit</a></td>
          <td><a href="<?= url_for('users/delete.php?id=' . h(u($user->id))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
