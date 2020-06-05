<?php

require "../internal/dbconnect.php";
session_start();
if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin']==0) {
	die("You are not admin");
}
$sql = 'SELECT O.ID as OID, O.oDate as OrderDate,  C.Fname as Firstname, C.Lname as Lastname FROM orders O INNER JOIN  `customer` C ON O.Customer = C.ID';
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$res = $stmt->get_result();
$r = $res->fetch_all(MYSQLI_ASSOC);
print json_encode($r);
?>
