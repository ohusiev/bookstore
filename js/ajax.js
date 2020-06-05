function show_customers() {
	$.ajax('ajax/show_allusers_json.php', { success: show_customers_json} );
}

function show_customers_json(x,y,z) {
	var o = JSON.parse(x);
	$('#maincontent').html('<table class="table" id="custtable"><thead><tr><th>ID</th><th>Fname</th><th>Lname</th></tr></thead><tbody></table>')
	for(var i = 0; i< o.length;i++) {
		var t = '<tr><td>'+ o[i].ID+'</td><td>'+o[i].Fname+'</td><td>'+o[i].Lname+'</td></tr>';
		$('#custtable TBODY').append(t);
	}
}
function show_orders() {
	$.ajax('ajax/showall_orders.php', { success: show_orders_response} );
}
function show_orders_response(x,y,z) {
	var o = JSON.parse(x);
	$('#maincontent').html('<table class="table" id="custtable"><thead><tr><th>Order ID</th><th>Date</th><th>Customer</th></th></tr></thead><tbody></table>')
	for(var i = 0; i< o.length;i++) {
		var t = '<tr>\n\
		<td>'+ o[i].OID + '</td>\n\
		<td>'+ o[i].OrderDate + '</td>\n\
		<td>'+ o[i].Firstname + ' ' +o[i].Lastname + '</td>\n\
		</tr>';
		$('#custtable TBODY').append(t);

	 }
	 
	
}