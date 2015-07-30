=== Like Buttons ===
Contributors: wonderboymusic
Tags: Facebook, social, like, share, post
Requires at least: 3.0
Tested up to: 4.3
Stable tag: 0.4

Adds Open Graph <code><meta></code> tags to your posts/pages/etc, adds a Facebook Like button to posts using simple Theme functions. Requires a Facebook Application ID (instructions are provided)

== Description ==

Like Buttons makes your site instantly share-able. The plugin adds <code><meta></code> tags to your pages' HTML <code><head></code> which will pull the proper content from your site when someone shares one of your site's URLs on Facebook. Using some simple Theme functions, you can add Like buttons to posts / pages / custom post types AND a Like button for your blog / website

<code>
// in the Loop - for posts / pages / custom post types
the_like_button()

// a Like button for your blog / website, put it anywhere!
the_blog_like_button()

// use this if you don't want to register your app
the_like_iframe()
</code>

Read More: http://scottctaylor.wordpress.com/2011/01/04/new-plugin-like-buttons/

== Installation ==
For Like Buttons to work properly, you need to register your site as a Facebook app <a href="http://www.facebook.com/developers/createapp.php" target="_blank">here</a>. Once you enter your Application Name and complete the security Captcha, select the Website tab on the left to obtain your Application ID and set Site URL to your site's root URL.


== Changelog ==

= 0.4 =
* Clean up

= 0.3.1 =
* Fixes permalink in the og meta in <head>

= 0.3 =
* adds jquery to the script queue (whoops!)

= 0.2 =

= 0.1 =
* Initial release


== Upgrade Notice ==
* Please update to the latest release of Like Buttons