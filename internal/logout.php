<?php
print "Bye $_SESSION[username]. We hope to see you again.";
$_SESSION['username']='?';
$_SESSION['is_admin']=0;
$_SESSION['userid']='';
if(isset($_SESSION['userid'])){
    unset($_SESSION['userid']);
}
?>
<br>
<p><a href="index.php?p=login">Login</a> again</p>