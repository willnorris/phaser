# Phaser #

Phaser is a WordPress plugin that rewrites images to be loaded from an external
image service.  It is modelled after, and intended as a replacement for,
[Jetpack's photon service][photon].  Photon may only be used on WordPress.com,
or on Jetpack-connected WordPress sites, so if you don't want the full Jetpack
plugin, you're out of luck.

Phaser is designed to work with any image service that allows fetching remote
image URLs.  It will provide the desired height and width of the image for
those services that will do server-side resizing, does not attempt to support
any other types of server-side image adjustment.

Out of the box, Phaser is setup to work with [resize.ly][], not because there
is any official connection (they actually have [their own WordPress
plugin][wp-resizely], but just because their API is very simple to use.
[Cloudinary][] is one of the only other services I know of that allow fetching
remote URLs, but any should work.  Of course, you could use the [Photon API][],
though I wouldn't recommend it.  

[photon]: http://jetpack.me/support/photon/
[resize.ly]: https://resize.ly/
[wp-resizely]: http://wordpress.org/plugins/wp-resizely/
[Cloudinary]: http://cloudinary.com/blog/delivering_all_your_websites_images_through_a_cdn
[Photon API]: http://developer.wordpress.com/docs/photon/api/

## License ##

Because Phaser borrows heavily from the Jetpack plugin, it is also licensed
under the [GPLv2][].

[GPLv2]: http://www.gnu.org/licenses/gpl-2.0.html
