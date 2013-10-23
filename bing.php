<?php

# initialise
$a = array();
$fields = array('addressLine', 'locality', 'adminDistrict', 'postalCode');
foreach ($fields as $field) {
	$a[$field] = '';
}

# check if form has been submitted
if (!empty($_POST) && array_key_exists('a', $_POST)) {
	$a = array_merge($a, $_POST['a']);
}

$form = <<<OUT
<form action="{$_SERVER['PHP_SELF']}" method="post" id="geoForm">
	<fieldset title="">
		<input name="c[countryRegion]" type="hidden" class="hidden" value="UK" />
		<input name="c[key]" type="hidden" class="hidden" value="AhPuv-6lkVFe36dKaBwhyWvKklVXBWTKBXvmUBcWEI7V8ds9e38-GgjVSxM6oYIs" />
		<ol>
			<li>
				<label for="a_addressLine">Street Address</label>
				<input name="a[addressLine]" id="a_addressLine" type="text" class="text" value="{$a['addressLine']}" />
			</li>
			<li>
				<label for="a_locality">Town / City</label>
				<input name="a[locality]" id="a_locality" type="text" class="text" value="{$a['locality']}" />
			</li>
			<li>
				<label for="a_adminDistrict">County</label>
				<input name="a[adminDistrict]" id="a_adminDistrict" type="text" class="text" value="{$a['adminDistrict']}" />
			</li>
			<li>
				<label for="a_postalCode">Postcode</label>
				<input name="a[postalCode]" id="a_postalCode" type="text" class="text" value="{$a['postalCode']}" />
			</li>
			<li class="submit"><button type="submit">Find!</button></li>
		</ol>
	</fieldset>
</form>
OUT;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<title>Bing Map Lat Lng</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="php.js"></script>
	
	<script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
	<script type="text/javascript" src="bing.js"></script>
	
<style type="text/css">

#geoMap {
	height: 260px;
	position: relative;
	width: 400px;
}
.NavBar_typeButtonContainer, .NavBar_compassContainer, .LogoContainerActive, .LogoSearchContainer, .BottomRightBar {
	display: none;
}
.NavBarFull {
	width: 52px !important;
}
.NavBar_zoomContainer {
	left: 0 !important;
}


</style>

</head>

<body>

	<div id="geoMap"></div>
	<div id="geoResult"></div>
	
	<?= $form; ?>

</body>
</html>