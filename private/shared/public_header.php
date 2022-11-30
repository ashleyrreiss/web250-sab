<!doctype html>

<html lang="en">
  <head>
    <title>SABirds <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" /> -->
  </head>

  <body>

    <header>
      <h1>
        <a href="<?php echo url_for('../../web250/sab/birds.php'); ?>">
          Southern Appalachian Birds
        </a>
      </h1>
    </header>

    <p>Welcome to the Southern Appalachian Bird site.</p>
  
    <navigation>
      <ul>
        <?php 
        if($session->is_logged_in()) { ?>
          <li>User: <?php echo $session->username; ?></li>
          <li><a href='logout.php'>Logout</a></li>
          <li><a href="<?php echo url_for('../../web250/sab/users/index.php'); ?>">Update Users</a></li>
          <li><a href="<?php echo url_for('../../web250//sab/birds/index.php'); ?>">Bird Administration</a></li>
        <?php 
        } else {
          echo "<a href='login.php'>Login</a>";
        }
        ?>
      </ul>
      

    </navigation>
