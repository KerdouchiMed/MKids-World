<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KidsTube-Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="functions.js" type="text/javascript"></script>
  </head>
  <body id='<?php echo $page_name ?>'>
    <?php include 'functions.php'; ?>
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid" id="Dashboard">
        <div class="nav navbar-header">
          <a href="index.php" class="navbar-brand">Dashboard</a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="nav navbar-nav">
            <li class='<?php if( basename( $_SERVER['PHP_SELF']) == "channels.php") echo"active"?>'><a href="channels.php">MK</a></li>
          </ul>

          <ul class="nav navbar-nav  navbar-right">
            <li class=""><a href="logout.php">Logout</a></li>
            <li class=""><a href="help.php">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>
