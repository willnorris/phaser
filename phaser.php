<?php
/*
 Plugin Name: Phaser
 Description: Photons and Phasers.
 Author: Will Norris
 Author URI: http://willnorris.com/
 Version: 0.1-alpha
 License: GPLv2
 */

require_once dirname(__FILE__) . '/jetpack/class.photon.php';
require_once dirname(__FILE__) . '/jetpack/shim.php';

/**
  * Rewrite the requested URL to be served from the external image serivce.
  *
  * @uses apply_filters() Calls 'phaser_rewrite_url' with final URL
  *
  * @param string $src image URL to rewrite
  * @param int $width desired width of the image
  * @param int $height desired height of the image
  * @return string rewritten image URL
  */
function phaser_rewrite_url($src, $width=null, $height=null) {
  return apply_filters("phaser_rewrite_url", false, $src, $width, $height);
}

/**
  * Rewrite image URL to use resize.ly.
  */
function phaser_resizely_url($url, $src, $width, $height) {
  if ($height || $width) {
    $size = $width . "x" . $height;
  } else {
    $size = 0;
  }

  return "//resize.ly/" . $size . "/" . $src;
}
add_filter('phaser_rewrite_url', 'phaser_resizely_url', 10, 4);

/**
 * Allow HTTPS URLs.
 */
function phaser_reject_https($reject) {
  return false;
}
add_filter('jetpack_photon_reject_https', 'phaser__reject_https');
