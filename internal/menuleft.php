<a href="?p=products" 
onclick="set_cookie('nav-bannerN1_curbside_desktop_imagetext');">
<div class="tgtNavBannerWrap ">
	<img src="https://i.pinimg.com/originals/e4/5b/d0/e45bd09bad9cab3ad3a6984397376bfb.jpg" width= 220
	alt="DISCOVER OUR INCREDIBLE RANGE OF BOOKS">
</div></a>
_______________________________________
<br>
<h5>&nbsp;&nbsp;&nbsp;Product Categories</h5>
<ul class="nav nav-pills flex-column">

<?php
$sql = 'select * from category order by Name';

if (! ($res = $mysqli->query($sql))) {
 echo "Table creation failed: (" . 
 			$mysqli->errno . ") " . $mysqli->error;
} else {
	while ($row = $res->fetch_assoc()) {
		print "<li class='nav-item'><a class='nav-link' href='index.php?p=catinfo&catid=$row[ID]'>".
				"$row[Name]</a></li>";
	}
}



?>

</ul>

