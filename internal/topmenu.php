<?php
if($_SESSION['username']=='?'){
    print <<< END
      <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?p=start">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=aboutus">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=products">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=cart">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=login">Login</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="?p=register">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=blog">Blog</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="?p=contact">Contact</a>
      </li>        
      </ul>
    END;
  }else{
    print <<< END
      <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?p=start">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=aboutus">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=products">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=cart">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=blog">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=contact">Contact</a>
      </li>        
      </ul>
    END;
}
?>