<body>
<div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="index.php?p=start">Home</a>
			<a class="breadcrumb-item" href="?p=products">Product</a>
            <span class="breadcrumb-item active">Selected Book</span>
        </div>
    </div>
</body>

<?php
$pid = $_REQUEST['pid'];
$sql = "select * from product where ID=?";


if( $stmt = $mysqli->prepare($sql) ) {
	$stmt->bind_param("i", $pid);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
		/*print  "<b>$row[Title]</b>".
		"<p>$row[Description]</p>".
		"<input id='qty' type='number' value='1' name='qty'> <button class='btn btn-primary' id='btn_add_cart' onclick='add_cart($row[ID])'>Add</button>";*/
		print <<<END
			<div class='container'>
				<div class='panel panel-default'>
					<div class='panel-heading'>$row[Title]</div>
				<div class='panel-body'>
					<p>$row[Description]</p>
						<input id='qty' type='number' value='1' name='qty'> 
						<button class='btn btn-primary' id='btn_add_cart' onclick='add_cart($row[ID])'>Add</button>
				</div>
			</div>
		END;
		
	}

}
?>

<div id='response'></div>
<script>
var xmlhttp;
function add_cart(pid) {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = showresponse;
	var a = document.getElementById('qty').value;
	xmlhttp.open("GET","ajax/add_cart.php?pid="+pid+"&qty="+a,true);
	xmlhttp.send();
}

function showresponse() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("response").innerHTML = xmlhttp.responseText;
        }
}
</script>