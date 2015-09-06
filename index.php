<?php

//Get contents entered in the search box
if(!empty($_GET['location'])){
	$maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' .urlencode($_GET['location']);		//urlencode removes spaces in urls
	
	$maps_json = file_get_contents($maps_url);		//store contents in $maps_json variable
	$maps_array = json_decode($maps_json, true);	//convert json into php array using json decode function

	//pass latitude and longitude data into variables
	$lat = $maps_array['results'][0]['geometry']['location']['lat'];
	$lng = $maps_array['results'][0]['geometry']['location']['lng'];

	$instagram_url = 'https://api.instagram.com/v1/media/search?lat=' .$lat. '&lng=' .$lng. '&client_id=812004a3e61744c0889339680c320a5b';//Generated from instagram.com/developer

	$instagram_json = file_get_contents($instagram_url);
	$instagram_array = json_decode($instagram_json, true);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Geogram</title>
	<meta name="author" content="Ali A. Kingravi" />
	<meta name="description" content="Web application that displays instagram images from around the world" />
	<meta name="keywords"  content="fullpage,jquery,ali,kingravi,plugin,fullscren,screen,full,iphone5,apple,pure,javascript,slider,php" />
	<meta name="Resource-type" content="Document" />

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/geoStyles.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/unsemantic-grid-responsive-tablet.css">
	
	<!-- Add Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
</head>

<body>

<section id="search">
	<div class="search-box">
		<form action="index.php">
			<div class="form-group">
				<label>Search images based on a location!</label>
				<input type="text" class="form-control" name="location" placeholder="Enter a location, e.g: disneyland,ca ... london ... hollywood etc"/>
				<button type="submit" class="btn btn-primary">Search</button>
			</div>
		</form>
	</div>
</section>

<section id="image-results">
	<div class="display-images">
		<?php
			if(!empty($instagram_array)){
				foreach ($instagram_array['data'] as $image) {
					echo '<img src="'.$image['images']['low_resolution']['url'].'"alt="" />';
				}
			}
			if(!empty($_GET['location'])&&empty($instagram_array)){
				echo "No images found, please enter another location";
			}
		?>
	</div>
</section>

<footer id="footer">
	<div class="footer-box">
		<div class="back-to-top">
			<a class="back-to-top-btn" href="#"><i class="fa fa-chevron-circle-up fa-4x"></i></a>
		</div>
	</div>
</footer>

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/geoScripts.js"></script>

</body>
</html>