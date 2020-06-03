<h2> My orders</h2>
<?php
if(isset($_POST['action_save'])) {
	setlocale(LC_ALL, 'el_GR.UTF-8');
	require_once "internal/dbconnect.php";
	$sql = "SELECT * FROM orders WHERE Customer=?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("i", $_SESSION['ID']);
	$stmt->execute();
	$res = $stmt->get_result();
	print "<ol>";
	while($row = $res->fetch_assoc()) {
		print "<li>$row['ID']: $row['Customer'] x $row['Date'] </li>\n";
	}
	print "</ol>";
}
print "</ol>";

?>
<form name="form1" method='POST' id="regForm">
<input type='submit' class="btn btn-primary" value='List' name='action_save'>
</form>