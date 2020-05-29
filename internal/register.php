<h2>Registration</h2>

<?php
if(isset($_REQUEST['action_save'])) {
	//$_ENV['LC_ALL'] = 'el_GR.UTF-8';
	setlocale(LC_ALL, 'el_GR.UTF-8');

	$sql = 'update customer set Fname=?, Lname=?, email=?, Address=?, Phone=? where ID=?';
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("sssssi", $_REQUEST['Fname'], $_REQUEST['Lname'], $_REQUEST['email'], $_REQUEST['Address'], $_REQUEST['Phone'], $_SESSION['userid']);
	$r = $stmt->execute();
	if($r) {
		print "Saved : (".strftime('%H:%M:%S %a %d %b %Y',time()).").." ;
	} else {
        print "Error : (".strftime('%H:%M:%S %a %d %B %Y',time()).")..";}
    
}

?>

<form method='POST'>
<table class="table table-striped" >

<tr><td class="text-right">First Name:</td><td><input class="form-control" type='text' name='Fname'></td></tr>
<tr><td class="text-right">Last Name:</td><td><input class="form-control" type='text' name='Lname'></td></tr>
<tr><td class="text-right">Email:</td><td><input class="form-control" type='text' name='email'></td></tr>
<tr><td class="text-right">Password:</td><td><input class="form-control" type='text' name='pass'></td></tr>
<tr><td class="text-right">Repeat Password:</td><td><input class="form-control" type='text' name='repass'></td></tr>
<tr><td class="text-right">Address:</td><td><textarea class="form-control" name='Address' ></textarea></td></tr>
<tr><td class="text-right">Phone:</td><td><input class="form-control" type='text' name='Phone' ></td></tr>
<tr><td colspan="2" class="text-center">
<input type='submit' class="btn btn-primary" value='Save' name='action_save'>
</td></tr>
</table>
</form>