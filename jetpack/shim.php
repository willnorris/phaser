<?php
// This file provides minimal shims to use Phaser to service Jetpack Photon URLs.

/**
	* Handle requests for a Photon URL by passing it off to Phaser.
	*/
function jetpack_photon_url($src, $args=array()) {
	if (array_key_exists('resize', $args)) {
		list($width, $height) = explode(',', $args['resize']);
	}
	return phaser_rewrite_url($src, $width, $height);
}
add_filter( 'jetpack_photon_url', 'jetpack_photon_url', 10, 3 );


/**
	* Minimal implementation of the Jetpack class to ensure Jetpack_Photon will run.
	*/
class Jetpack {
	public static function check_privacy($file) {
		// do nothing
	}

	public static function get_content_width() {
		return $GLOBALS['content_width'];
	}
}

Jetpack_Photon::instance();
