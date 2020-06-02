<h2>Registration</h2>
<?php
if(isset($_POST['action_save'])) {
	require_once("internal/dbconnect.php");
	$sql = "INSERT INTO customer (Fname, Lname, email, uname, Address, Phone, passwd_enc) VALUES (?, ?, ?, ?, ?, ?, PASSWORD(?))";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("sssssss", $_POST['Fname'], $_POST['Lname'], $_POST['email'], $_POST['uname'], $_POST['Address'], $_POST['Phone'], $_POST['pass']);
	$r = $stmt->execute();
	if($r) {
		print "<h3>You are registered : (".strftime('%H:%M:%S %a %d %b %Y',time()).")</h3>" ;
	} else {
		print "Registration Error : (".strftime('%H:%M:%S %a %d %B %Y',time()).")..";
	}
}
?>

<form name="form1" method='POST' id="regForm">
<table class="table table-striped" >

<tr><td class="text-right">First Name:</td><td><input class="form-control" type='text' name='Fname'></td></tr>
<tr><td class="text-right">Last Name:</td><td><input class="form-control" type='text' name='Lname'></td></tr>
<tr><td class="text-right">Email:</td><td><input class="form-control" type='text' name='email'></td></tr>
<tr><td class="text-right">User Name:</td><td><input class="form-control" type='text' name='uname' id='uname'maxlength="15">
<br/><span id='availability'></span></td></tr>
<tr><td class="text-right">Password:</td><td><input class="form-control" type='password' name='pass' required oninvalid="return required()"></td></tr>
<tr><td class="text-right">Repeat Password:</td><td><input class="form-control" type='password' name='repass'required oninvalid="return required()"></td></tr>
<tr><td class="text-right">Address:</td><td><textarea class="form-control" name='Address' ></textarea></td></tr>
<tr><td class="text-right">Phone:</td><td><input class="form-control" type='text' name='Phone' ></td></tr>
<tr><td colspan="2" class="text-center">
<input type='submit' class="btn btn-primary" value='Register' name='action_save' onClick="return compareStr()">
</td></tr>
</table>
</form>
<script>
	var form1 = document.getElementById('regForm');
	function compareStr(){
		if(form1.pass.value != form1.repass.value)
		{
			alert("Passwords must be the same");
			form1.pass.focus();
			return false;
		}
		return true;
	}
	function required() 
	{
		if (form1.pass.value.length == 0)
		{ 
			pass.setCustomValidity("Password cannot be empty");	
			return false; 
		}  	
		return true; 
		} 
</script>