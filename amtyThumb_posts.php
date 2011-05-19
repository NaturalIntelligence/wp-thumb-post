<?php
/*
Plugin Name: amtyThumb Posts
Plugin URI: http://article-stack.com/
Description: This plugin shows recent / random/ popular posts on your blog with thumbnail.
You may customize it in any way. It uses amtyThumb plugin to extracts first image of your current post.
Fully customizable. You may control thumbnail size, Title length, apperance, and alomst everything

Author: Amit Gupta
Version: 6.5
Author URI: http://article-stack.com/
*/


add_action( 'widgets_init', 'thumb_posts_widgets' );
add_shortcode( 'amtyThumb', 'amtyThumb_shortcode' );

function thumb_posts_widgets() {
	register_widget( 'amtyThumb_posts' );
}


class amtyThumb_posts extends WP_Widget {

	function amtyThumb_posts() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'amty_thumb', 'description' => __('It displays recently published posts with thumbnail', 'amtyThumb_posts') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'amty-thumb-recent' );

		/* Create the widget. */
		$this->WP_Widget( 'amty-thumb-recent', __('Amty Thumb Posts', 'amtyThumb_posts'), $widget_ops, $control_ops );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and width & Height to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['maxpost'] = strip_tags( $new_instance['maxpost'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['height'] = strip_tags( $new_instance['height'] );
		$instance['border'] = strip_tags( $new_instance['border'] );
		$instance['itemwidth'] = strip_tags( $new_instance['itemwidth'] );
		$instance['itemheight'] = strip_tags( $new_instance['itemheight'] );
		$instance['itemborder'] = strip_tags( $new_instance['itemborder'] );

		$instance['titlelen'] = strip_tags( $new_instance['titlelen'] );


		/* No need to strip tags for icon */
		$instance['icon'] = $new_instance['icon'];
		$instance['icontype'] = $new_instance['icontype']; //'uploaded','attached','referenced'
		//$instance['show_default'] = $new_instance['show_default'];
		$instance['imagepath'] = $new_instance['imagepath'];
		$instance['pretag'] = $new_instance['pretag'];
		$instance['posttag'] = $new_instance['posttag'];
		$instance['displaytype'] = $new_instance['displaytype'];
		$instance['templateItems'] = $new_instance['templateItems'];
		$instance['category'] = $new_instance['category'];
		$instance['widgettype'] = $new_instance['widgettype'];
		return $instance;
	}




function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Amty Thumb Posts', 'amtyThumb_posts'),
					 'width' => __('70', 'amtyThumb_posts'),
					 'height' => __('70', 'amtyThumb_posts'),
					 'border' => __('1', 'amtyThumb_posts'),
					 'icon' => 'yes',
					 'icontype' => 'any',	//'uploaded','referenced','attached','any'
					 'imagepath' => __('', 'amtyThumb_posts'),
					 'pretag' => __('', 'amtyThumb_posts'),
					 'posttag' => __('', 'amtyThumb_posts'),
					 'titlelen' => __(50, 'amtyThumb_posts'),
					 'displaytype' => __('Vertically', 'amtyThumb_posts'),
					 'templateItems' => __('image', 'amtyThumb_posts'),
					 'itemwidth' => __('50', 'amtyThumb_posts'),
					 'itemheight' => __('50', 'amtyThumb_posts'),
					 'itemborder' => __('0', 'amtyThumb_posts'),
					 'maxpost' =>  __('5', 'amtyThumb_posts'),
					 'category' => __('All','amtyThumb_posts'),
					 'widgettype' => __('Recent','amtyThumb_posts')
					  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>

		<p>
			<select id="<?php echo $this->get_field_id( 'widgettype' ); ?>" name="<?php echo $this->get_field_name( 'widgettype' ); ?>" style="width:80px;">
				<option <?php if ( 'Recent' == $instance['widgettype'] ) echo 'selected="selected"'; ?>>Recent</option>
				<option <?php if ( 'Random' == $instance['widgettype'] ) echo 'selected="selected"'; ?>>Random</option>
				<option <?php if ( 'Popular' == $instance['widgettype'] ) echo 'selected="selected"'; ?>>Popular</option>
			</select> Posts,
			Category :
			<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" style="width:100px;" >
				 <option <?php if ( 'All' == $instance['category'] ) echo 'selected="selected"'; ?>>All</option>
				 <?php
				  $categories=  get_categories();
				  foreach ($categories as $cat) { ?>
				   <option <?php if ( $cat->cat_name == $instance['category'] ) echo 'selected="selected"'; ?>><?php echo $cat->cat_name ?> </option>;
		  <?php }?>
			</select>
        </p>
		<!-- Post Count: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'maxpost' ); ?>"><?php _e('Maximum Posts:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'maxpost' ); ?>" name="<?php echo $this->get_field_name( 'maxpost' ); ?>" value="<?php echo $instance['maxpost']; ?>" style="width:30px;" />
		</p>
		<hr>
		<h3>Thumbnail</h3>
		<!-- Icon: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e('Display thumbnail:', 'amtyThumb_posts'); ?></label>
			<select id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" class="widefat" style="width:60px;">
				<option <?php if ( 'yes' == $instance['icon'] ) echo 'selected="selected"'; ?>>yes</option>
				<option <?php if ( 'no' == $instance['icon'] ) echo 'selected="selected"'; ?>>no</option>
			</select>
		</p>

<hr />
		<!-- Width: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" style="width:30px;" />
		<!-- Height: Text Input -->
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" style="width:30px;" />
		<!-- Border: Text Input -->
			<label for="<?php echo $this->get_field_id( 'border' ); ?>"><?php _e('Border:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'border' ); ?>" name="<?php echo $this->get_field_name( 'border' ); ?>" value="<?php echo $instance['border']; ?>" style="width:30px;" />
		</p>
		<p>
			First
			<select id="<?php echo $this->get_field_id( 'icontype' ); ?>" name="<?php echo $this->get_field_name( 'icontype' ); ?>" style="width:100px;">
				<option <?php if ( 'anyimage' == $instance['icontype'] ) echo 'selected="selected"'; ?>>any</option>
				<option <?php if ( 'attached' == $instance['icontype'] ) echo 'selected="selected"'; ?>>attached</option>
				<option <?php if ( 'uploaded' == $instance['icontype'] ) echo 'selected="selected"'; ?>>uploaded</option>
				<option <?php if ( 'referenced' == $instance['icontype'] ) echo 'selected="selected"'; ?>>referenced</option>
			</select>
			 Image.
		</p>
		<!-- Show default image? Checkbox -->
		<?php /*<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_default'], true ); ?> id="<?php echo $this->get_field_id( 'show_default'); ?>" name="<?php echo $this->get_field_name( 'show_default'); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_default' ); ?>"><?php _e('Display default image?', 'amtyThumb_posts'); ?></label>
		</p>*/?>
		<!-- Default Image Path: Text Input -->
		<p>
		<!-- imagepath: Text Input -->
			<label for="<?php echo $this->get_field_id( 'imagepath' ); ?>"><?php _e('Default thumbnail path: ', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'imagepath' ); ?>" name="<?php echo $this->get_field_name( 'imagepath' ); ?>" value="<?php echo $instance['imagepath']; ?>" style="width:95%;" />
		</p>
		<hr>
		<h3>Title</h3>
		<!-- PreTag: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pretag' ); ?>"><?php _e('PreTag:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'pretag' ); ?>" name="<?php echo $this->get_field_name( 'pretag' ); ?>" value="<?php echo $instance['pretag']; ?>" style="width:60px;" />
		<!-- PostTag: Text Input -->
			<label for="<?php echo $this->get_field_id( 'posttag' ); ?>"><?php _e('PostTag:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'posttag' ); ?>" name="<?php echo $this->get_field_name( 'posttag' ); ?>" value="<?php echo $instance['posttag']; ?>" style="width:60px;" />
		</p>
		<p>
		<!-- Length: Text Input -->
			<label for="<?php echo $this->get_field_id( 'titlelen' ); ?>"><?php _e('Title Length(in number of chars):', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'titlelen' ); ?>" name="<?php echo $this->get_field_name( 'titlelen' ); ?>" value="<?php echo $instance['titlelen']; ?>" style="width:30px;" />
		</p>
		<hr>
		<h3>Template</h3>
		<p>
			View:
			<select id="<?php echo $this->get_field_id( 'displaytype' ); ?>" name="<?php echo $this->get_field_name( 'displaytype' ); ?>" class="widefat" style="width:100px;">
				<option <?php if ( 'Horizontally' == $instance['displaytype'] ) echo 'selected="selected"'; ?>>Horizontally</option>
				<option <?php if ( 'Vertically' == $instance['displaytype'] ) echo 'selected="selected"'; ?>>Vertically</option>
			</select>
			Show
			<select id="<?php echo $this->get_field_id( 'templateItems' ); ?>" name="<?php echo $this->get_field_name( 'templateItems' ); ?>" class="widefat" style="width:60px;">
				<option <?php if ( 'title' == $instance['templateItems'] ) echo 'selected="selected"'; ?>>title</option>
				<option <?php if ( 'image' == $instance['templateItems'] ) echo 'selected="selected"'; ?>>image</option>
			</select>
			 first.
		</p>
		<!-- Width: Text Input -->
		<p>
			In case of Horizontal view <br>
			<label for="<?php echo $this->get_field_id( 'itemwidth' ); ?>"><?php _e('Minimum Width:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'itemwidth' ); ?>" name="<?php echo $this->get_field_name( 'itemwidth' ); ?>" value="<?php echo $instance['itemwidth']; ?>" style="width:30px;" /><br>
		<!-- Height: Text Input -->
			<label for="<?php echo $this->get_field_id( 'itemheight' ); ?>"><?php _e('Text Height:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'itemheight' ); ?>" name="<?php echo $this->get_field_name( 'itemheight' ); ?>" value="<?php echo $instance['itemheight']; ?>" style="width:30px;" /><br>
		<!-- Border: Text Input -->
			<label for="<?php echo $this->get_field_id( 'itemborder' ); ?>"><?php _e('Box Border:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'itemborder' ); ?>" name="<?php echo $this->get_field_name( 'itemborder' ); ?>" value="<?php echo $instance['itemborder']; ?>" style="width:30px;" />
		</p>
		<hr>

	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$width = $instance['width'];
		$height = $instance['height'];
		$border = $instance['border'];
		$maxpost = $instance['maxpost'];
		$icon = $instance['icon'];
		/*$show_default = isset( $instance['show_default'] ) ? $instance['show_default'] : false;*/

		$imagepath = $instance['imagepath'];			//path for default image in case of no image in post
		$icontype = $instance['icontype'];
		$pretag = $instance['pretag'];				//styling post title
		$posttag = $instance['posttag'];				//styling post title
		$displaytype =  $instance['displaytype'];			//Horizontal | Verticle
		$templateItems =  $instance['templateItems'];		//Show image first or post title first

		$itemwidth = $instance['itemwidth'];					//styling Temlpate Vertical view
		$itemheight = $instance['itemheight'];				//styling Temlpate Vertical view
		$itemborder = $instance['itemborder'];				//styling Temlpate Vertical view

		$titlelen = $instance['titlelen'];				//Stripping Post title for better display; if 0 then no stripping
		$ptitle = '';

		$categoryName = $instance['category'];		//limiting search to a particular category
		$widgetType = $instance['widgettype'];		//Recent/random/popular etc.
		/* Before widget (defined by themes). */
		echo $before_widget;

		displayPosts($before_title ,$after_title,$title, $width ,$height ,$border ,$maxpost ,$icon ,$imagepath,$icontype ,$pretag ,$posttag,$displaytype,$templateItems,$itemwidth ,$itemheight ,$itemborder ,$titlelen ,$categoryName ,$widgetType);

		/* Display the widget title if one was input (before and after defined by themes). */


		/* After widget (defined by themes). */
		echo $after_widget;
	}
} //class end

include ("imgFunctions.php");

function amtyThumb_shortcode( $attr, $content = null ) {
    extract( shortcode_atts( array( 'title' => 'Amty Thumb Posts', //'' to hide it
								   'before_title' => '<h2>',
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
					 ), $attr ) );

displayPosts($before_title, $after_title,$title, $thumb_width,$thumb_height,$thumb_border,$max_post,$show_thumb,$imagepath,$image_type,$pretag,$posttag,$display_type,$display_first,$box_width,$title_box_height,$box_border,$title_len,$category,$widgettype);

}


function displayPosts($before_title, $after_title, $title = '',$width = 70,$height = 70 ,$border = 0 ,$maxpost  = 5,$icon ,$imagepath = '',$icontype ,$pretag = '',$posttag = '',$displaytype = 'Vertically',$templateItems = 'image',$itemwidth = '50',$itemheight  = '50',$itemborder = 0,$titlelen = 30,$categoryName = 'All',$widgetType = 'Recent'){

	if ( $title != '' )
			echo $before_title . $title . $after_title;
	?>
            	<ul style="list-style-type:none;"><!-- <?php echo "http://article-stack.com"; ?> -->
				<?php

				if ($categoryName != 'All') {
						$theCatId = get_cat_id($categoryName );
						//$theCatId = $theCatId->term_id;
						$category = "cat=" . $theCatId . "&";
				}else{
						$category = '';
				}
				$recent = new WP_Query();

				if($widgetType == 'Recent')
					$recent -> query($category . "showposts=" . $maxpost . "&orderby=date");
				elseif($widgetType == 'Random')
					$recent -> query($category . "showposts=" . $maxpost . "&orderby=rand");
				elseif($widgetType == 'Popular')
					$recent -> query($category . "showposts=" . $maxpost . "&orderby=comment_count");

	         while($recent->have_posts()) :
				 $recent -> the_post() ;
			//Decorating Post title
			$ptitle = the_title('','',FALSE);
			if($titlelen != 0)
			{
			  if (strlen($ptitle)> $titlelen )
		        {
		                $ptitle = substr($ptitle,0,$titlelen ) . "...";
		        }
			}
			$ptitle = $pretag . $ptitle . $posttag ;
			//Decorating Post display style
			if($displaytype == 'Vertically'){
			?>
                    <li style="float:left; ">
					<div style="padding:2px;float:<?php if($templateItems == 'image'){echo "left";} else {echo "right";} ?>;" ><?php if ( $icon == 'yes') { lead_img_thumb_post($width ,$height ,$border,$imagepath ,$icontype ); } ?></div>
					<?php if($templateItems == 'image'){?>
						<a href="<?php the_permalink(); ?>" title="<?php echo $ptitle; ?>"><?php echo $ptitle; ?></a>
					<?php }
					else { ?>
						<a href="<?php the_permalink(); ?>" title="<?php echo $ptitle; ?>"><?php echo $ptitle; ?></a>
					<?php } ?>
			  </li>
				<div style="clear:both;"></div>
			<?php
			}
			else
			{?>
			<div style="display:block;min-width:<?php echo $width + 20;?>px;width:<?php echo $itemwidth;?>px;border:<?php echo $itemborder;?>px solid;float:left;margin:1px;min-height:<?php echo $itemheight + $height + 20;?>">
			  <li>
				<?php if($templateItems == 'image'){ ?>
					<div style="padding:2px;" ><?php if ( $icon == 'yes') { lead_img_thumb_post($width ,$height ,$border,$imagepath ,$icontype ); } ?></div>
					<div style="min-width:<?php echo $width + 20;?>px;width:<?php echo $itemwidth;?>px;height:<?php echo $itemheight;?>px;"><a href="<?php the_permalink(); ?>" title="<?php echo $ptitle; ?>"><?php echo $ptitle; ?></a></div>
				<?php }
				else {?>
					<div style="min-width:<?php echo $width + 20;?>px;width:<?php echo $itemwidth;?>px;height:<?php echo $itemheight ;?>px;"><a href="<?php the_permalink(); ?>" title="<?php echo $ptitle; ?>"><?php echo $ptitle; ?></a></div>
					<div style="padding:2px;" ><?php if ( $icon == 'yes') { lead_img_thumb_post($width ,$height ,$border,$imagepath ,$icontype ); } ?></div>
				<?php }?>
			  </li>
			</div>
              <?php
			}
		 endwhile; ?>
            </ul>
            <a href="<?php echo "http://article-stack.com"; ?>">*</a>
            <div style="clear:both;"></div>
	<?php
}

?>