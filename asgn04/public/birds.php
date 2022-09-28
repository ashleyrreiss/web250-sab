<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'WNC Birds'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>






<div id="main">

  <div id="page">
    <div class="intro">
      <img class="inset" src="<?php echo url_for('/images/tufted-titmouse.jpg') ?>" />
      <h2>Western North Carolina Birds</h2>
      <p>Birds found here in our area.</p>
      <p>We will deliver it to your door and let you try it before you buy it.</p>
    </div>

    <table id="birds">
      <tr>
        <th>Common Name</th>
        <th>Habitat</th>
        <th>Food</th>
        <th>Nest Placement</th>
        <th>Behavior</th>
        <th>Conservation ID</th>
        <th>Backyard Tips</th>
      </tr>

  <?php 
  $parser = new ParseCSV(PRIVATE_PATH . '/wnc-birds.csv');
  $bird_array = $parser->parse();
  ?>
      <?php foreach($bird_array as $args) { ?>
      <?php $bird = new Bird($args); ?>
      <tr>
        <td><?= h($bird->common_name); ?></td>
        <td><?= h($bird->habitat); ?></td>
        <td><?= h($bird->food); ?></td>
        <td><?= h($bird->nest_placement); ?></td>
        <td><?= h($bird->behavior); ?></td>
        <td><?= h($bird->conservation()); ?></td>
        <td><?= h($bird->backyard_tips); ?></td>
      </tr>
      <?php } ?>
    </table>
  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
