<?php require_once('private/initialize.php'); ?>

<?php $page_title = 'Birds'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <div id="page">
    <div class="intro">
      <h2>Our Collection of Birds</h2>
    </div>

    <table id="inventory" border="1">
      <tr>
        <th>Name</th>
        <th>Habitat</th>
        <th>Food</th>
      </tr>

<?php

$birds = Bird::find_all();

?>
      <?php foreach($birds as $bird) { ?>
      <tr>
        <td><?php echo h($bird->common_name); ?></td>
        <td><?php echo h($bird->habitat); ?></td>
        <td><?php echo h($bird->food); ?></td>

      </tr>
      <?php } ?>

    </table>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
