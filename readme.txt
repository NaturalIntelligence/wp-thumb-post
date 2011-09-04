=== amtyThumb posts ===
Contributors: Amit Gpta
Donate link: http://article-stack.com/
Tags: thumbnail, recent, random, popular, post, amty, image, customizable, shortcode, mostly-viewed, rarely-viewed, recently-viewed, most-commented
Requires at least: 2.5
Tested up to: 3.2
Stable tag: 7.1.0

Fully customizable plugin to show Recently written, Recently viewed, Random, Mostly & Rarely Viewd, Mostly Commented posts with thumbnail.

== Description ==

This plugin shows Recently written, Recently viewed, Random, Mostly & Rarely Viewd, Mostly Commented posts with thumbnail. You may customize it in any way. It uses [amtyThumb](http://wordpress.org/extend/plugins/amtythumb/ "amtyThumb") plugin to extract first image of your current post.
Fully customizable. You may control thumbnail size, Title length, appearance, etc.
If you don't have any image in a post, you can set default image too.

= Features over other plugins =

1. amtyThumb plugin is best to extract any type of image from any post.
2. No need to set separate field for image in your post.
3. If an image is deleted from the post it automatically shows 2nd image as thumbnail.
4. If there is no image in the post it shows default image which can be set. default image path need to be set in advance.
5. Appearance is fully customizable through widget panel or from short code.
6. Best for beginner to masters

= Dependency =

1. amtyThumb plugin must be installed for image extraction.
2. WP-PostViews plugin must be installed to display mostly & rarely viewed posts.
3. Recently Viewed Posts plugin must be installed to display recently viewed posts.

== Installation ==

Installation of plugin is similar to other wordpress plugin.

e.g.

1. Extract `amtyThumb_post.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add widget to your sidebar using widget panel of your dashboard.

You may also add amtyThumb_post anywehre in your post or page using short code. For his;

	[amtyThumb show_thumb='no']
	[amtyThumb max_post ='3']

Possible parameters with default values

	'title' => 'Amty Thumb Posts', //'' to hide it
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	'thumb_width' => '70',
	'thumb_height' => '70',
	'default_img_path' => '', //should be set
	'pretag' => '',
	'template' => '',	//<li><img src="%POST_THUMB%" /><a href="%POST_URL%"  title="%POST_TITLE%">%POST_TITLE%</a></li>				 
	'posttag' => '',
	'title_len' => 30,
	'max_post' =>  10,
	'category' => 'All',
	'widgettype' => 'Recently Written' //'Recently Written','Random','Most Commented'

= Template Parameter =

1. %VIEW_COUNT% - Display number of times post is visited.
2. %POST_THUMB% - Display thumbnail 
3. %POST_URL% - Display post param link
4. %POST_TITLE% - Display post title
5. %POST_CONTENT% - Display post content
6. %POST_EXCERPT% - Display post excerpt
7. %POST_LAST_VIEWED% - Supported only when displaying recently viewed posts
8. %POST_DATE%	- Not supported when displaying recently viewed posts
9. %SHORT_TITLE% - Display short title.


For any doubt or query visit [article-stack](http://article-stack.com/other/amty-thumb-recent-is-now-amty-thumb-posts.amty "amty thumb recent")


== Frequently Asked Questions ==



= Only default images are being shown =

Check whether you had optimized your database. Remove sub versions of your posts. It'll not only help to extract exact image but will decrease loading time of your blog.

= Still not able to see resized image =

Check whether you have PHP GD library installed.

= Does it supports all image types? =

No, It supports only jpg,png and gif. I hadn't tested it for others.


For more queries visit [article-stack](http://article-stack.com/other/amty-thumb-recent-is-now-amty-thumb-posts.amty "amty thumb recent")

== Screenshots ==

For live example visit [article-stack](http://article-stack.com/other/amty-thumb-recent-is-now-amty-thumb-posts.amty "amty thumb recent")
	or [Think Zara Hatke](http://thinkzarahatke.com "Colletion of unique thinks")

== Changelog ==

= 7.1.0 =
* Addtion of %SHORT_TITLE% template code to display short title

= 7.0.0 =
* Template support for highly customized view.
* Many changes related to appearance
* Display Mostly, Rarely & Recently Viewed posts
* Support for WP-PostViews & Recently Viewed Posts plugins.


= 6.5 =
* Thumbnail part is separated.
* Support for amtyThumb plugin to generate thumbs.

= 6.1 =
* Bug fix for plugin directory name.

= 6.0 =
* Bug fix for finding first image.
* Support for generating thumbnail from youtube video

= 5.5 =
* Previous version was not able to extract first image, if your wordpress database is not optimized. Now it can work with database which is not optimized.


= 5.0 =
* Now it can be added anywhere in your source code or page or post.

= 4.0 =
* Compatible with New Wordpress version above than 2.9
* Display Recent or Random or Popular posts
* Display posts from specific category.
* Display Bug Fix. Previously, in case of Horizontal view, Next widget was being shown properly with come themes.
* Display Bug fix. Previously, in case of Horizontal view, Post title were overlapping.
* Changes in Widget control panel. Now it can remember what value you set last time.

= 3.0 =
* 20 times faster than previous version.
* Reduced page size.


= 2.0 =
* Display first image of recently added posts with subtitle.
* Display default image
* Don't reduce the image size. Just resize its height & width.

== Upgrade Notice ==

= 7.1.0 =
* Addtion of %SHORT_TITLE% template code to display short title