<?php
  if(!isset($page_title)) { $page_title = 'Bird Area'; }
?>

<?php
  require_login();
?>

<!doctype html>

<html lang="en">
  <head>
    <title>SA Birds - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" /> -->
  </head>

  <body>
    <header>
      <h1>SA Birds Admin Area</h1>
    </header>

    <navigation>
      <a href="<?php echo url_for('../../web250/sab/birds.php'); ?>">Back to Home</a></li>
    </navigation>


    <?php echo display_session_message(); ?>
