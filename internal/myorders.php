<h2> My orders</h2>
<?php

$userid= $mysqli->real_escape_string($_SESSION['userid']);
$sql = "SELECT orderdetails.Orders, orderdetails.Quantity, orderdetails.Product, orders.oDate, product.Title, product.Price 
    FROM ((orderdetails LEFT JOIN orders ON orderdetails.Orders=orders.ID)LEFT JOIN product ON orderdetails.Product=product.ID) 
    WHERE orders.Customer='$userid'";
$result = $mysqli->query($sql);
    print <<<END
            <table class="table table-striped">
        <thead><tr align="center"><th >Order ID</th><th>Date</th><th>Product ID</th><th>Title</th><th>Quantity</th><th>Price, €</th><th>Total, €</th></tr></thead><tbody>
        END;
if ($result->num_rows > 0){
	while ($row = $result->fetch_assoc()){
        $tprise = $row['Quantity']*$row['Price'];
        print "<tr><td align ='center'> $row[Orders] </td> <td align ='center'> $row[oDate] </td><td align ='center'>  $row[Product] </td><td><a href='http://localhost/bookstore/index.php?p=productinfo&pid=$row[Product]'>  $row[Title]</a> </td><td align ='center'>  $row[Quantity] </td><td align ='center'>  $row[Price] </td><td align ='center'><b>$tprise</b></td></tr>";
        }
        print "</tbody></table>";
    }else{
        echo "You don't have orders";
    }
?>