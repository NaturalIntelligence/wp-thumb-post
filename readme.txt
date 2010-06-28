=== amtyThumb posts ===
Contributors: Amit Gpta
Tags: thumbnail, recent, post, amty, image, customizable
Requires at least: 2.7
Tested up to: 2.9.2
Stable tag: 5.0

Shows resently published posts on your blog with thumbnail. This is fully customizable & cmopletely under in user control.

== Description ==

This plugin shows resently published posts on your blog with thumbnail. You may customize it in any way. It extracts first image of your current post.
Fully customizable. You may control thumbnail size, Title length, apperance, etc.

Features over other plugins:


1. Can extract an image which is either on same server or on remote server
2. Can extract attached images
3. If an image is deleted from the post it automatically shows 2nd image as thumbnail
4. If there is no image in the post it shows default image which can be set.
5. Appearance is fully customizable through widget panel.


Note: 


This plugins works for IMG tag those are written in ur post like


	<img src="................
	
	
But if you set some other attributes like width, height, style. This plugins become helpless to read that image


	<img style="...." src=" ...."



== Installation ==

Instalation of plugin is similar to other wordpress plugin.

e.g.

1. Extract `amtyThumb_post.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add widget to your sidebar using widget panel of your dashboard.

You may also add amtyThumb_post anyehre in your post or page using short code. For his;

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


For any doubt or query visit http://article-stack.com/


== Frequently Asked Questions ==

= Only default images are being shown =

Check "img" tag in your post. Whether "src" attribute is written after "img" if not do it so.
e.g.
WRONG : <img style="...." src=" ...."
RIGHT : <img src=".....

= When i set thumbnail to display in right they are not alligned properly =

Check your CSS. Since it inherits CSS properties. And some properties may disarrange the apperance you may need to change some properies of your CSS.

= Still not able to see resized image =

Check whther you have PHP GD library installed.

= Does it supports all image types? =

No, It supports only jpg,png and gif. I handt tested it to others.

= Stil posts title are overlapping =

You'll have to do some setting through widget control panel like text height, text length etc. Then only you can stop overlapping.

For more queries visit http://article-stack.com/

== Screenshots ==

For live example visit http://article-stack.com/

1. When thumbnail is off
`/tags/2.0/21.jpg`
`/tags/2.0/20.jpg`
`/tags/2.0/11.jpg`
`/tags/2.0/17.jpg`

2. Right aligned thumbnail
`/tags/2.0/7.jpg`
`/tags/2.0/8.jpg`


3. Left aligned thumbnail
`/tags/2.0/3.jpg`
`/tags/2.0/14.jpg`
`/tags/2.0/16.jpg`

4. Horizontal view
`/tags/2.0/4.jpg`
`/tags/2.0/5.jpg`

5. Mixed View
`/tags/2.0/12.jpg`
`/tags/2.0/13.jpg`

== Changelog ==

= 5.0 =
* Now it can be added anywhere in your source code or page or post.

= 4.0 =
* Compatible with New Worpress version above than 2.9
* Display Recen or Random or Popular posts
* Display posts from specific category.
* Display Bug Fix. Previously, in case of Horizontal view, Next widget was being shown properly with come themes.
* Display Bux fix. Previously, in case of Horizontal view, Post title were overlapping.
* Changes in Widget control panel. Now it can remeber what value you set last time.

= 3.0 =
* 20 times faster than previous version.
* Reduced page size.


= 2.0 =
* Display first image of recently added posts with subtitle.
* Display default image
* Donot reduce the image size. Just resize its height & width.

== Upgrade Notice ==

= 3.5 =
Works with more theme. Now more robust, efficient.

= 3.0 =
Along with all features of previous version this version takes less time in loading. This is 20 times faster than previous version

= 2.0 =
This version reported slow loading time.  Upgrade immediately.

