=== Plugin Name ===
Contributors: tokokoo, satrya, davidkryzaniak
Tags: recent posts, thumbnails, widget, widgets, sidebar, excerpt, transient api, multiple widgets
Requires at least: 3.3
Tested up to: 3.5
Stable tag: 0.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides flexible and advanced recent posts widget. Allows you to display them with thumbnails, post excerpt, specific category and more.

== Description ==

This plugin will enable a custom, flexible and advanced recent posts widget. Allows you to display a list of the most recent posts with thumbnail and excerpt, also you can display it from all or a specific category. The recent posts widget extended uses [Transients API](http://codex.wordpress.org/Transients_API) for delivering cached to optimize your site performance when used the widget.

= Features Include: =

* Display thumbnails, with customizable size.
* Display excerpt, with customizable length.
* Display from all or a specific category.
* Display post date.
* Post type option.
* Support `get_the_image` function.
* Transients API with cache life timer.
* Multiple widgets.
* Comes pre-styled, but comes proper CSS IDs and Classes to make it match your site.

= Ugly Image Sizes =
This plugin creates custom image sizes. If you use images that were uploaded to the media library before you installed this plugin, please install [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) plugin to corrected the sizes.

= Support: =
1. Go to [forum support](http://wordpress.org/support/plugin/recent-posts-widget-extended).
2. [Open issue on github](https://github.com/tokokoo/recent-posts-widget-extended/issues).
3. [Rate/Review the plugin](http://wordpress.org/support/view/plugin-reviews/recent-posts-widget-extended).

= Project Info: =
* Developed by [Tokokoo Team](http://tokokoo.com)
* Follow us on Twitter to keep up with the latest updates [@tokokoo](http://twitter.com/tokokoo)

== Installation ==

1. Upload the 'recent-posts-widget-extended' folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the widgets page.

== Screenshots ==
1. The widget settings

== Changelog ==

= 0.8 =
* PLEASE RE-SAVE THE WIDGET
* Remove caching system, it causing some issues
* Add `rpwe_default_query_arguments` filter to allow developer filter the query
* Change Limit option to input text rather than selectbox
* Fix widget title filter bug
* On off default styles
* Multiple categories
* Add offset & order options
* Read more option

= 0.7.1 =
* PLEASE RE-SAVE THE WIDGET
* Added setting for cache life
* Added input for CSS class (used for custom styling)
* Fix the inline issue on some themes
* Update language

= 0.7 =
* Remove `a` tag when no thumbnail
* Add custom css box
* Inheritance `font-family`
* Update language

= 0.6 =
* Update language
* Reset the loop

= 0.5 =
* Minor update

= 0.4 =
* Add date option
* Support `get_the_image` function
* Re-arrange markup
* Update language

= 0.3 =
* WordPress 3.5 compatibility
* Upload header image
* Sanitize `get_the_title` function

= 0.2 =
* Minor update

= 0.1 =
* Initial release