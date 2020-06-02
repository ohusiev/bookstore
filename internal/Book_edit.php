<h2>Change Book Details</h2>
<?php 
if (isset($_REQUEST['action_save'])) {
	setlocale(LC_ALL, 'el_GR.UTF-8');
	$sql = "UPDATE product SET Title='$_REQUEST[Title]', Description='$_REQUEST[Description]',Price='$_REQUEST[Price]', Category='$_REQUEST[Category]' WHERE ID='$_REQUEST[ID]'";
	//$stmt->bind_param("ssssi", $_REQUEST['Title'], $_REQUEST['Decription'], $_REQUEST['Price'], $_REQUEST['Category'], $_SESSION['userid']);
	$stmt = $mysqli->prepare($sql);
	$r = $stmt->execute();
	if($r) {
		print "Record was updated successfully : (".strftime('%H:%M:%S %a %d %b %Y',time()).").." ;
	} else {
		print "Error : (".strftime('%H:%M:%S %a %d %B %Y',time()).")..";
	}
}
?>
<form method='GET'>
<table class="table table-striped" >
<?php
$sql = "SELECT * FROM product WHERE ID=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_REQUEST['ID']);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
?>

<tr><td class="text-right">Book ID:</td><td><input class="form-control" type='text' name='ID' value='<?= $row['ID']; ?>'></td></tr>
<tr><td class="text-right">Title:</td><td><input class="form-control" type='text' name='Title' value='<?= $row['Title']; ?>'></td></tr>
<tr><td class="text-right">Description:</td><td><input class="form-control" type='text' name='Description' value='<?= $row['Description']; ?>'></td></tr>
<tr><td class="text-right">Price:</td><td><input class="form-control" type='text' name='Price' value='<?= $row['Price']; ?>'></td></tr>
<tr><td class="text-right">Category:</td><td><input class="form-control" type='text' name='Category' value='<?= $row['Category']; ?>'></td></tr>
<tr><td colspan="2" class="text-center"> <input type='submit' class="btn btn-primary" value='Get Book Details'> <input type='submit' class="btn btn-primary" value='Save' name='action_save'> <input type='reset' class="btn btn-primary" value='Cancel'>
<input type='hidden' name='p' value='Book_edit'>
</td></tr>
</table>
</form>
		
