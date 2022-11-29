<?php require_once('private/initialize.php'); ?>

<?php

  // Get requested ID

  $id = $_GET['id'] ?? false;
  if(!$id) {
    redirect_to('birds.php');
  }

  $bird = Bird::find_by_id($id);
  // 2. dump bike
  //var_dump($bike); exit;

?>

<?php $page_title = 'Detail'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

  <a href="birds.php">Back to Birds</a>

      <dl>
        <dt>Name</dt>
        <dd><?php echo h($bird->common_name); ?></dd>
      </dl>
      <dl>
        <dt>Habitat</dt>
        <dd><?php echo h($bird->habitat); ?></dd>
      </dl>
      <dl>
        <dt>Food</dt>
        <dd><?php echo h($bird->food); ?></dd>
      </dl>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
