=== Plugin Name ===
Contributors: satrya, themephe, davidkryzaniak
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=D7VPMAPHA98LW
Tags: recent posts, thumbnails, widget, widgets, sidebar, excerpt, category, post tag, post type, multiple widgets
Requires at least: 3.4
Tested up to: 3.8.1
Stable tag: 0.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides flexible and advanced recent posts widget. Allows you to display them with thumbnails, post excerpt, multiple category and more.

== Description ==

**After updating, please re-save the widget**

This plugin will enable a custom, flexible and super advanced recent posts widget. Allows you to display a list of the most recent posts with thumbnail, excerpt and post date, also you can display it from all or specific or multiple category or tag.

= Features Include: =

* WordPress 3.8.1 Support.
* You can set the title url.
* **Display by date, comment count or random.** *new*
* Display thumbnails, with customizable size and alignment.
* Display excerpt, with customizable length.
* Display from all, specific or multiple category.
* Display from all, specific or multiple tag.
* Display post date and you can set the format.
* Default thumbnail.
* Read more option.
* Post type option.
* Custom CSS
* Multiple widgets.
* Support [Get the Image](http://wordpress.org/plugins/get-the-image/) plugin.

= Ugly Image Sizes =

This plugin creates custom image sizes. If you use images that were uploaded to the media library before you installed this plugin, please install [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) plugin to corrected the sizes.

= Tested Themes =

* [Twenty Eleven](http://wordpress.org/themes/twentyeleven)
* [Twenty Twelve](http://wordpress.org/themes/twentytwelve)
* [Twenty Fourteen](http://wordpress.org/themes/twentyfourteen)
* [Stargazer](http://wordpress.org/themes/stargazer)

= Support =

* Go to [forum support](http://wordpress.org/support/plugin/recent-posts-widget-extended).
* [Open issue on github](https://github.com/satrya/recent-posts-widget-extended).
* [Rate/Review the plugin](http://wordpress.org/support/view/plugin-reviews/recent-posts-widget-extended).

= Plugin Info =
* Developed by [Satrya](http://themephe.com)
* Follow us on Twitter to keep up with the latest updates [@themephe](http://twitter.com/themephe)

= Donations =
If you want to buy me a cup of coffee, you can do by visiting [this page](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=D7VPMAPHA98LW). I appreciate all donations, no matter the size. 

== Installation ==

1. Upload the 'recent-posts-widget-extended' folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the widgets page **Appearance -> Widgets**.

== Frequently Asked Questions ==

= How to filter the query from this plugin =
You can use `rpwe_default_query_arguments`

= Thumbnail size option not working properly =
Yes, this is because the plugin uses `the_post_thumbnail` custom sizes and not uses `add_image_size` function, [more information](http://codex.wordpress.org/Function_Reference/the_post_thumbnail). At the moment I have no idea how to fix this issue.

== Screenshots ==

1. The widget settings

== Changelog ==

= 0.9 - 2/19/2013 =
* PLEASE RE-SAVE THE WIDGET
* Fix issue with the get-the-image plugin support [#10](https://github.com/satrya/recent-posts-widget-extended/issues/10). Pros casjohnson
* Display by date, comment count or random. *new*
* Update support for WordPress 3.8
* Minor improvement
* Alignment issue
* Escape title attribute in widget title
* Set the width & height if use default thumbnail
* Sanitize custom css
* add 'list-style-type: none;' to the `li` to prevent bullet point on some themes.
* Change `numberposts` with `posts_per_page`
* Trim excerpt uses `wp_trim_words` function
* Update language

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