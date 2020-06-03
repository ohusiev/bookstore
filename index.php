<!doctype html>
<html lang="en">
<?php
session_start();
require_once "internal/dbconnect.php";

if( ! isset($_SESSION['username'])) {
	$_SESSION['username']='?';
}
if( ! isset($_SESSION['is_admin'])) {
	$_SESSION['is_admin']=0;
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>BIBLIOO</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap/dashboard.css" rel="stylesheet">
    <script src="js/ajax.js"></script>
  </head>
<body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a href="index.php?p=start"> <img border="0" src="https://i.pinimg.com/originals/ad/ce/76/adce765a4b69040f8056527f2f3df8f8.png" alt="Biblioo_logo_white" width=70>
        <a class="navbar-brand" href="index.php?p=start">BIBLIOO &nbsp; &nbsp; &nbsp; &nbsp;</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
         <?php
         require ("internal/topmenu.php");
         ?>
        </div>
      </nav>
    </header>
<div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
          
	
<?php
	require "internal/menuleft.php";
	if($_SESSION['is_admin']) {
		print "<h3>Admin MENU</h3>";
		print <<<END
<ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link " href="javascript:show_customers()">Customers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:show_orders()">Orders</a>
            </li>
            <li class="nav-item">
            <a class="nav-link " href="?p=newBook">Add New Book</a>
         </li>
         <li class="nav-item">
            <a class="nav-link " href="?p=Book_edit">Change Book Details</a>
         </li>
         <li class="nav-item">
            <a class="nav-link " href="?p=book_delete">Delete Book</a>
         </li>
          </ul>
          
END;
	}
	if($_SESSION['username']!='?') {
		print "<h3>User MENU</h3>";
		print <<<END
<ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link " href="?p=myorders">My orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=myinfo">My Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?p=logout">Logout</a>
            </li>
           
            </ul>
END;
	}
?>
</nav>
<main id='maincontent' role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
<?php
if( ! isset($_REQUEST['p'])) {
	$_REQUEST['p']='start';
}
$p = $_REQUEST['p'];
// list of the permited pages
$pages = array('blog', 'myorders','register','start','shopinfo','login','do_login','after_login','logout','myinfo','contact','products','cart','catinfo','productinfo','add_cart','empty_cart','buy_cart','delete_item','newBook','Book_edit','book_delete', 'checkout');

$ok=false;
foreach($pages as $pp) {
	if($pp==$p) {
		require "internal/$p.php";
		$ok=true;
	}
}
if(! $ok) {
	print "Page does not exists";
}

?>
     </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
  </body>
</html>
