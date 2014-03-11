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
require_once dirname(__FILE__) . '/jetpack/functions.photon.php';
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
add_filter('phaser_url', 'phaser_resizely_url', 10, 4);

function photon_url_die($url, $src, $args, $scheme) {
  error_log(print_r(array(
    'url' => $url,
    'src' => $src,
    'args' => $args,
    'scheme' => $scheme,
  ), true));
}
//add_filter( 'jetpack_photon_url', 'photon_url_die', 10, 4 );

/**
 * Convert a jetpack request to a phaser request.
 */
function jetpack_phaser_url($url, $src, $args, $scheme) {
  $width = 0; $height = 0; $fit = false;
  if (array_key_exists('resize', $args)) {
    list($width, $height) = explode(',', urldecode($args['resize']));
  }
  if (array_key_exists('fit', $args)) {
    $fit = true;
    list($width, $height) = explode(',', urldecode($args['fit']));
  }
  if (array_key_exists('w', $args) && $args['w']) {
    $width = $args['w'];
  }
  if (array_key_exists('h', $args) && $args['h']) {
    $height = $args['h'];
  }


  if ($height || $width) {
    $size = $width . "x" . $height;
  } else {
    $size = 0;
  }

  return "https://s.wjn.me/" . $size . ($fit ? ',fit' : '') . '/' . $src;
}
add_filter( 'jetpack_photon_url', 'jetpack_phaser_url', 10, 4 );

/**
 * Process HTTPS URLs.
 */
function phaser_reject_https($reject) {
  return false;
}
add_filter('jetpack_photon_reject_https', 'phaser_reject_https');
