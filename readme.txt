=== amty thumb recent ===
Contributors: Amit Gpta
Donate link: http://amtyera.net/
Tags: thumbnail, recent, post, amtyera, image
Requires at least: 2.0.2
Tested up to: 2.8.6
Stable tag: 2.0

Shows resently published posts on your blog with thumbnail. This is fully customizable.

== Description ==

This plugin shows resently published posts on your blog with thumbnail. You may customize it in any way. It extracts first image of your current post.
Fully customizable. You may control thumbnail size, Title length, apperance, etc.

Features over other plugins:
1. Can extract an image which is either on same server or on remote server
2. Can extract attached images
3. If an image is deleted from the post it automatically shows 2nd image as thumbnail
4. If there is no image in the post it shows default image which can be set.
5. Aperance is fully customizable through widget panel.


Note: 
This plugins works for IMG tag those are written in ur post like
	<img src="................
But if you set some other attributes like width, height, style. This plugins become helpless to read that image
	<img style="...." src=" ...."



== Installation ==

Instalation of plugin is similar to other wordpress plugin.

e.g.

1. Upload `amty_thumb_recent.php` to the `/wp-content/plugins/` directory
[dont forget to copy logo.gif along with]
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add widget to your sidebar using widget panel of your dashboard.

== Frequently Asked Questions ==

= Only default images are being shown =

Check "img" tag in your post. Whether "src" attribute is written after "img" if not do it so.
e.g.
WRONG : <img style="...." src=" ...."
RIGHT : <img src=".....

= When i set thumbnail to display in right they are not alligned properly =

Check your CSS. Since it inherits CSS properties. And some properties may disarrange the apperance you may need to change some properies of your CSS.

== Screenshots ==

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

