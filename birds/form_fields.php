<?php require_once('../private/initialize.php'); ?>

<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($bird)) {
  redirect_to(url_for('/birds/index.php'));
}
?>

<dl>
  <dt >Common Name</dt>
  <dd><input type="text" name="bird[common_name]" value="<?php echo h($bird->common_name); ?>" /></dd> <font color="ff0000"> <?php if (in_array("Common name cannot be blank.", $bird->errors))
   echo ('Common name cannot be blank'); ?> </font>
</dl>

<dl>
  <dt>Habitat</dt>
  <dd><input type="text" name="bird[habitat]" value="<?php echo h($bird->habitat); ?>" /></dd> <font color="ff0000"> <?php if (in_array("Habitat cannot be blank.", $bird->errors))
   echo ('Habitat cannot be blank'); ?> </font>
</dl>

<dl>
  <dt>Food</dt>
  <dd><input type="text" name="bird[food]" value="<?php echo h($bird->food); ?>" /></dd>
</dl>