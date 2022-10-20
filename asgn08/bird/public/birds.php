<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'WNC Birds'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>






<div id="main">

  <div id="page">
    <div class="intro">
      <img class="inset" src="<?php echo url_for('/images/tufted-titmouse.jpg') ?>" />
      <h2>Western North Carolina Birds</h2>
      <p>Birds found here in our local area.</p>
      <p>We will deliver it to your door and let you try it before you buy it.</p>
    </div>

    <table id="birds" border="1px">
      <tr>
        <th>Common Name</th>
        <th>Habitat</th>
        <th>Food</th>
        <th>Conservation ID</th>
        <th>Backyard Tips</th>
        <th>&nbsp;</th>
      </tr>

  <?php 

  $birds = Bird::find_all();

  ?>
      <?php foreach($birds as $bird) { ?>
      <tr>
        <td><?= h($bird->common_name); ?></td>
        <td><?= h($bird->habitat); ?></td>
        <td><?= h($bird->food); ?></td>
        <td><?= h($bird->conservation()); ?></td>
        <td><?= h($bird->backyard_tips); ?></td>
        <td><a href="detail.php?id=<?php echo $bird->id; ?>">View</a></td>
      </tr>
      <?php } ?>
    </table>

  </div>

</div>
<?php include(SHARED_PATH . '/public_footer.php'); ?>
