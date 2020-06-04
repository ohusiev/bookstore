<h2> My orders</h2>
<?php
require "dbconnect.php";
//if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin']==0) {
//	die("You are not admin");
//}
$stmt = $mysqli->prepare("SELECT * FROM orders WHERE Customer=$_SESSION[username]");
$result = $stmt->get_result();
print <<<END
<table class="table table-striped">
        <thead><tr><th>ID</th><th>Product</th><th>Date</th></tr><th>Price</th></tr></thead><tbody>
END;
	while ($row = $result->fetch_assoc()) {
        print "<tr><td> $row["ID"] </td> $row[ID] <td> $row[ID] </td> $row[ID] <td></td><td> $row[ID] </td></tr>";
		}
    print "</tbody></table>";
?>