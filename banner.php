<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/AccessSave/AccessSaveClass.php');

	$IPAddress = $_SERVER['REMOTE_ADDR'];
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$URL = '';
	if (isset($_SERVER['HTTP_REFERER'])) {
		$URL = $_SERVER['HTTP_REFERER'];
	} elseif (isset($_SERVER['REQUEST_URI'])) {
		$URL = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

// Save to DB and get Views Count
	$accessSave = new AccessSaveClass();
	$count = $accessSave->execute($IPAddress, $userAgent, $URL);

// Create an image
	$img = imagecreate( 3000, 160 );
	$background = imagecolorallocate( $img, 0, 0, 255 );
	$textColor = imagecolorallocate( $img, 255, 255, 0 );

	imagestring( $img, 4, 30, 25, 'Page URL: ' . $URL, $textColor );
	imagestring( $img, 4, 30, 55, 'IP Address: ' . $IPAddress, $textColor );
	imagestring( $img, 4, 30, 85, 'User Agent: ' . $userAgent, $textColor );
	imagestring( $img, 4, 30, 115, 'Views Count: ' . $count, $textColor );

	header( "Content-type: image/png" );
	imagepng( $img );
	imagedestroy( $img );
?>
