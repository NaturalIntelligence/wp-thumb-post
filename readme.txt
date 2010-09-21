=== amtyThumb posts ===
Contributors: Amit Gpta
Donate link: http://article-stack.com/
Tags: thumbnail, recent, random, popular, post, amty, image, customizable, shortcode
Requires at least: 2.5
Tested up to: 3.1
Stable tag: 5.5

Fully customizable plugin to show recently published posts, random posts and popular posts on your blog with thumbnail.

== Description ==

This plugin shows recently published posts on your blog with thumbnail. You may customize it in any way. It extracts first image of your current post.
Fully customizable. You may control thumbnail size, Title length, appearance, etc.

Features over other plugins:


1. Can extract an image which is either on same server or on remote server
2. Can extract attached images
3. If an image is deleted from the post it automatically shows 2nd image as thumbnail
4. If there is no image in the post it shows default image which can be set.
5. Appearance is fully customizable through widget panel.


== Installation ==

Installation of plugin is similar to other wordpress plugin.

e.g.

1. Extract `amtyThumb_post.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add widget to your sidebar using widget panel of your dashboard.

You may also add amtyThumb_post anywehre in your post or page using short code. For his;

	[amtyThumb show_thumb='no']
	[amtyThumb display_type='Horizontally' max_post ='3']

Possible parameters with default values

	'title' => 'Amty Thumb Posts', //'' to hide it
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>',
	'thumb_width' => '70', 
	'thumb_height' => '70', 
	'thumb_border' => '1', 
	'show_thumb' => 'yes',
	'image_type' => 'any', //'attached','any','referenced', 'uploaded'
	'imagepath' => '', 
	'pretag' => '', 
	'posttag' => '', 
	'title_len' => 30, 
	'display_type' => 'Vertically', //'Horizontally','Vertically'
	'display_first' => 'image', //'image','title'
	'box_width' => '50', 
	'title_box_height' => '50', 
	'box_border' => '0', 
	'max_post' =>  '5', 
	'category' => 'All',
	'widgettype' => 'Recent' //'Recent','Random','Popular'


For any doubt or query visit [article-stack](http://article-stack.com/other/amty-thumb-recent-is-now-amty-thumb-posts.amty "amty thumb recent")


== Frequently Asked Questions ==



= Only default images are being shown =

Check whether you had optimized your database. Remove sub versions of your posts. It'll not only help to extract exact image but will decrease loading time of your blog.

= When i set thumbnail to display in right they are not aligned properly =

Check your CSS. Since it inherits CSS properties. And some properties may disarrange the appearance you may need to change some properties of your CSS.

= Still not able to see resized image =

Check whether you have PHP GD library installed.

= Does it supports all image types? =

No, It supports only jpg,png and gif. I hadn't tested it to others.

= Posts title are overlapping =

You'll have to do some setting through widget control panel like text height, text length etc. Then only you can stop overlapping.

For more queries visit [article-stack](http://article-stack.com/other/amty-thumb-recent-is-now-amty-thumb-posts.amty "amty thumb recent")

== Screenshots ==

For live example visit [article-stack](http://article-stack.com/other/amty-thumb-recent-is-now-amty-thumb-posts.amty "amty thumb recent")


== Changelog ==

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

= 3.5 =
Works with more theme. Now more robust, efficient.

= 3.0 =
Along with all features of previous version this version takes less time in loading. This is 20 times faster than previous version

= 2.0 =
This version reported slow loading time.  Upgrade immediately.