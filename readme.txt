=== Plugin Name ===
Contributors: tokokoo, satrya, davidkryzaniak
Tags: recent posts, thumbnails, widget, widgets, sidebar, excerpt, category, post tag, post type, multiple widgets
Requires at least: 3.4
Tested up to: 3.6
Stable tag: 0.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides flexible and advanced recent posts widget. Allows you to display them with thumbnails, post excerpt, multiple category and more.

== Description ==

**After updating, please re-save the widget**

This plugin will enable a custom, flexible and super advanced recent posts widget. Allows you to display a list of the most recent posts with thumbnail, excerpt and post date, also you can display it from all or specific or multiple category or tag.

= Features Include: =

* You can set the title url.
* Display thumbnails, with customizable size and alignment.
* Display excerpt, with customizable length.
* Display from all, specific or multiple category.
* Display from all, specific or multiple tag.
* Display post date and you can set the format.
* Default thumbnail.
* Read more option.
* Post type option.
* Support `get_the_image` function.
* Custom CSS
* Multiple widgets.

= Ugly Image Sizes =

This plugin creates custom image sizes. If you use images that were uploaded to the media library before you installed this plugin, please install [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) plugin to corrected the sizes.

= Support: =
1. Go to [forum support](http://wordpress.org/support/plugin/recent-posts-widget-extended).
2. [Open issue on github](https://github.com/tokokoo/recent-posts-widget-extended/issues).
3. [Rate/Review the plugin](http://wordpress.org/support/view/plugin-reviews/recent-posts-widget-extended).

= Plugin Info: =
* Developed by [Tokokoo Team](http://tokokoo.com)
* Follow us on Twitter to keep up with the latest updates [@tokokoo](http://twitter.com/tokokoo)

Be sure to check out our latest [premium ecommerce themes](http://tokokoo.com/tokokoo-themes/)

== Installation ==

1. Upload the 'recent-posts-widget-extended' folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the widgets page.

== Frequently Asked Questions ==

= How to filter the query from this plugin =

You can use `rpwe_default_query_arguments`

== Screenshots ==

1. The widget settings

== Changelog ==

= 0.9 - 9/9/2013 =
* Alignment issue
* Escape title attribute in widget title
* Set the width & height if use default thumbnail

= 0.8 =
* PLEASE RE-SAVE THE WIDGET
* Remove caching system, it causing some issues
* Change Limit option to input text rather than selectbox
* Add `rpwe_default_query_arguments` filter to allow developer filter the query
* Fix widget title filter bug
* Add Multiple categories
* Add Multiple tags
* Add offset & order options
* Add Read more option
* Add Default thumbnail
* Add Thumbnail alignment
* Add widget title link
* Add absolute date
* Add turn on off default styles

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