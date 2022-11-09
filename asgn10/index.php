<?php require_once('private/initialize.php'); ?>

<?php 
$birds = Bird::find_all(); 
$page_title = 'Birds'; 
include(SHARED_PATH . '/public_header.php'); 

?>


<h1>Bird List</h1>


  	<table border="1">
      <tr>
        <th>Name</th>
        <th>Habitat</th>
        <th>Food</th>
      </tr>

      <?php foreach($birds as $bird) { ?>
        <tr>
          <td><?php echo h($bird->common_name); ?></td>
          <td><?php echo h($bird->habitat); ?></td>
          <td><?php echo h($bird->food); ?></td>
    	  </tr>
      <?php } ?>
  	</table>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
