<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KidsTube</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" media="only screen and (max-width: 767px)" href="mobile.css" />
    <link rel="stylesheet" media="only screen and (min-width: 768px)" href="desktop.css" />

  </head>
  <body>
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid" id="menu">
        <div class="nav navbar-header">
          <a href="index.php" class="navbar-brand">kidsTube</a>
          <button class="btn btn-default hidden-sm hidden-md hidden-lg" data-target="#sidebar-modal" data-toggle="modal">
          <i class="fa fa-chevron-circle-right "></i>
          </button>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
         
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="nav navbar-nav">
            <li class='<?php if( basename( $_SERVER['PHP_SELF']) == "index.php") echo"active"?>'>
              <a href="index.php">Home</a>
            </li>
            <li class='<?php if( basename( $_SERVER['PHP_SELF']) == "kids.php") echo"active"?>'>
              <a href="kids.php">Kids</a>
            </li>
            <li class='<?php if( basename( $_SERVER['PHP_SELF']) == "games.php") echo"active"?>'>
              <a href="games.php">Games</a>
            </li>
            <li class='<?php if( basename( $_SERVER['PHP_SELF']) == "parents.php") echo"active"?>'>
              <a href="parents.php">Parents</a>
            </li>
          </ul>

          <ul class="nav navbar-nav  navbar-right">
            <li class=""><a data-target="#contact_us" data-toggle="modal">Contact us</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="modal fade" id="contact_us">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="">Contact Us</h3>
                </div>
                <form action="">
                    <div class="modal-body">
                       <div class="form-group">
                            <input type="text" class="form-control" required placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" required placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  placeholder="Subject">
                        </div>
                        <div class="form-group">
                           <label for="message"> Your Message</label>
                            <textarea rows="5" aria-invalid="false" area-required class="form-control" id="message">
                            
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
