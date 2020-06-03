<h2>Delete Book</h2>
<?php 
if (isset($_REQUEST['delete'])) {
	setlocale(LC_ALL, 'el_GR.UTF-8');
	$sql = "DELETE FROM product WHERE ID='$_REQUEST[ID]'";
	$stmt = $mysqli->prepare($sql);
	//$stmt->bind_param("ssss", $_REQUEST['Title'], $_REQUEST['Description'], $_REQUEST['Price'], $_REQUEST['Category']);
	$r = $stmt->execute();
	if($r) {
		print "Data Deleted : (".strftime('%H:%M:%S %a %d %b %Y',time()).")..";
	} else {
		print "Data Not Deleted : (".strftime('%H:%M:%S %a %d %B %Y',time()).").." ;
	}
}
?>
<form method='GET'>
<table class="table table-striped">
<tr><td class="text-right">Book ID:</td><td><input class="form-control" type='text' name='ID'></td></tr>
<tr><td colspan="2" class="text-center"><input type='submit' class="btn btn-primary" value='Delete' name='delete'> 
<input type='hidden' name='p' value='book_delete'>
</td></tr>
</table>
</form>
		