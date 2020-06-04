<h2> My orders</h2>
<?php

$userid= $mysqli->real_escape_string($_SESSION['userid']);
$sql = "SELECT * FROM orders WHERE Customer='$userid'";
$result = $mysqli->query($sql);
    print <<<END
            <table class="table table-striped">
        <thead><tr><th width="10%">ID</th><th>Product</th><th>Date</th><th>Price</th></tr></thead><tbody>
        END;
if ($result->num_rows > 0){
	while ($row = $result->fetch_assoc()){
        print "<tr><td> $row[ID] </td> <td> $row[ID] </td><td>  $row[oDate] </td><td>  $row[ID] </td></tr>";
        }
        print "</tbody></table>";
    }else{
        echo "You don't have orders";
    }
?>