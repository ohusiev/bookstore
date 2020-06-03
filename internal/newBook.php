
<h2>Add New Book</h2>
<?php
if(isset($_POST['action_save'])) {
	$sql = "INSERT INTO product (Title, Description, Price, Category) VALUES (?, ?, ?, ?)";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("ssss", $_POST['Title'], $_POST['Description'], $_POST['Price'], $_POST['Category']);
	$r = $stmt->execute();
	if($r) {
		print "Saved : (".strftime('%H:%M:%S %a %d %b %Y',time()).").." ;
	} else {
		print "Error : (".strftime('%H:%M:%S %a %d %B %Y',time()).")..";
	}
}
?>
<form  method='POST'>
<table class="table table-striped" >
<tr><td class="text-right">Title:</td><td><input class="form-control" type='text' name='Title'></td></tr>
<tr><td class="text-right">Description:</td><td><input class="form-control" type='text' name='Description'></td></tr>
<tr><td class="text-right">Price:</td><td><input class="form-control" type='text' name='Price'></td></tr>
<tr><td class="text-right">Category:</td><td><input class="form-control" type='text' name='Category'></td></tr>
<tr><td colspan="2" class="text-center"><input type='submit' class="btn btn-primary" value='Save' name='action_save'> <input type='reset' class="btn btn-primary" value='Cancel'>
<input type='hidden' name='p' value='newBook'>
</td></tr>
</table>
</form>






