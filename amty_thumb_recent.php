<?php
/*
Plugin Name: Amty Thumbnail Recent Posts
Plugin URI: http://amtyera.net/thumb_recent
Description: This plugin shows resently published posts on your blog with thumbnail.
You may customize it in any way. It extracts first image of your current post.
Fully customizable. You may control thumbnail size, Title length, apperance,

Author: Amit Gupta
Version: 2.0
Author URI: http://amtyera.net/
*/

add_action( 'widgets_init', 'thumb_recent_posts_widgets' );

function thumb_recent_posts_widgets() {
	register_widget( 'amty_thumb_recent_posts' );
}

class amty_thumb_recent_posts extends WP_Widget {

	function amty_thumb_recent_posts() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'amty_thumb', 'description' => __('It displays recently published posts with thumbnail', 'amty_thumb_recent') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'amty-thumb-recent' );

		/* Create the widget. */
		$this->WP_Widget( 'amty-thumb-recent', __('Amty Thumb Recent', 'amty_thumb_recent'), $widget_ops, $control_ops );
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
		$instance['icontype'] = $new_instance['icontype'];
		//$instance['show_default'] = $new_instance['show_default'];
		$instance['imagepath'] = $new_instance['imagepath'];
		$instance['pretag'] = $new_instance['pretag'];
		$instance['posttag'] = $new_instance['posttag'];
		$instance['displaytype'] = $new_instance['displaytype'];
		$instance['templateItems'] = $new_instance['templateItems'];

		return $instance;
	}




function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Amty Thumb Recent', 'amty_thumb_recent'),
					 'width' => __('70', 'amty_thumb_recent'),
					 'height' => __('70', 'amty_thumb_recent'),
					 'border' => __('1', 'amty_thumb_recent'),
					 'icon' => 'yes',
					 'show_icon' => true,
					 'icontype' => 'any',
					 'imagepath' => __('', 'amty_thumb_recent'),
					 'pretag' => __('', 'amty_thumb_recent'),
					 'posttag' => __('', 'amty_thumb_recent'),
					 'titlelen' => __(50, 'amty_thumb_recent'),
					 'displaytype' => __('Vertically', 'amty_thumb_recent'),
					 'templateItems' => __('image', 'amty_thumb_recent'),
					 'itemwidth' => __('50', 'amty_thumb_recent'),
					 'itemheight' => __('50', 'amty_thumb_recent'),
					 'itemborder' => __('0', 'amty_thumb_recent'),
					 'maxpost' =>  __('5', 'amty_thumb_recent')
					  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>
		<!-- Post Count: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'maxpost' ); ?>"><?php _e('Maximum Posts:', 'amty_thumb_recent'); ?></label>
			<input id="<?php echo $this->get_field_id( 'maxpost' ); ?>" name="<?php echo $this->get_field_name( 'maxpost' ); ?>" value="<?php echo $instance['maxpost']; ?>" style="width:30px;" />
		</p>
		<hr>
		<h3>Thumbnail</h3>
		<!-- Icon: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e('Display thumbnail:', 'amty_thumb_recent'); ?></label>
			<select id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" class="widefat" style="width:60px;">
				<option <?php if ( 'yes' == $instance['format'] ) echo 'selected="selected"'; ?>>yes</option>
				<option <?php if ( 'no' == $instance['format'] ) echo 'selected="selected"'; ?>>no</option>
			</select>
		</p>
		<!-- Width: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width:', 'amty_thumb_recent'); ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" style="width:30px;" />
		<!-- Height: Text Input -->
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height:', 'amty_thumb_recent'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" style="width:30px;" />
		<!-- Border: Text Input -->
			<label for="<?php echo $this->get_field_id( 'border' ); ?>"><?php _e('Border:', 'amty_thumb_recent'); ?></label>
			<input id="<?php echo $this->get_field_id( 'border' ); ?>" name="<?php echo $this->get_field_name( 'border' ); ?>" value="<?php echo $instance['border']; ?>" style="width:30px;" />
		</p>
		<p>
			First
			<select id="<?php echo $this->get_field_id( 'icontype' ); ?>" name="<?php echo $this->get_field_name( 'icontype' ); ?>" class="widefat" style="width:100px;">
				<option <?php if ( 'anyimage' == $instance['type'] ) echo 'selected="selected"'; ?>>any</option>
				<option <?php if ( 'attached' == $instance['type'] ) echo 'selected="selected"'; ?>>attached</option>
				<option <?php if ( 'uploaded' == $instance['type'] ) echo 'selected="selected"'; ?>>uploaded</option>
				<option <?php if ( 'refrenced' == $instance['type'] ) echo 'selected="selected"'; ?>>refrenced</option>
			</select>
			 Image.
		</p>
		<!-- Show default image? Checkbox -->
		<?php /*<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_default'], true ); ?> id="<?php echo $this->get_field_id( 'show_default'); ?>" name="<?php echo $this->get_field_name( 'show_default'); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_default' ); ?>"><?php _e('Display default image?', 'amty_thumb_recent'); ?></label>
		</p>*/?>
		<!-- Default Image Path: Text Input -->
		<p>
		<!-- imagepath: Text Input -->
			<label for="<?php echo $this->get_field_id( 'imagepath' ); ?>"><?php _e('Default thumbnail path: ', 'amty_thumb_recent'); ?></label>
			<input id="<?php echo $this->get_field_id( 'imagepath' ); ?>" name="<?php echo $this->get_field_name( 'imagepath' ); ?>" value="<?php echo $instance['imagepath']; ?>" style="width:95%;" />
		</p>
		<hr>
		<h3>Title</h3>
		<!-- PreTag: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pretag' ); ?>"><?php _e('PreTag:', 'amty_thumb_recent'); ?></label>
			<input id="<?php echo $this->get_field_id( 'pretag' ); ?>" name="<?php echo $this->get_field_name( 'pretag' ); ?>" value="<?php echo $instance['pretag']; ?>" style="width:60px;" />
		<!-- PostTag: Text Input -->
			<label for="<?php echo $this->get_field_id( 'posttag' ); ?>"><?php _e('PostTag:', 'amty_thumb_recent'); ?></label>
			<input id="<?php echo $this->get_field_id( 'posttag' ); ?>" name="<?php echo $this->get_field_name( 'posttag' ); ?>" value="<?php echo $instance['posttag']; ?>" style="width:60px;" />
		</p>
		<p>
		<!-- Length: Text Input -->
			<label for="<?php echo $this->get_field_id( 'titlelen' ); ?>"><?php _e('Title Length(in number of chars):', 'amty_thumb_recent'); ?></label>
			<input id="<?php echo $this->get_field_id( 'titlelen' ); ?>" name="<?php echo $this->get_field_name( 'titlelen' ); ?>" value="<?php echo $instance['titlelen']; ?>" style="width:30px;" />
		</p>
		<hr>
		<h3>Template</h3>
		<p>
			View:
			<select id="<?php echo $this->get_field_id( 'displaytype' ); ?>" name="<?php echo $this->get_field_name( 'displaytype' ); ?>" class="widefat" style="width:100px;">
				<option <?php if ( 'horizontal' == $instance['aligntype'] ) echo 'selected="selected"'; ?>>Horizontally</option>
				<option <?php if ( 'verticle' == $instance['aligntype'] ) echo 'selected="selected"'; ?>>Vertically</option>
			</select>
			Show
			<select id="<?php echo $this->get_field_id( 'templateItems' ); ?>" name="<?php echo $this->get_field_name( 'templateItems' ); ?>" class="widefat" style="width:60px;">
				<option <?php if ( 'item_title' == $instance['firstItem'] ) echo 'selected="selected"'; ?>>title</option>
				<option <?php if ( 'item_image' == $instance['firstItem'] ) echo 'selected="selected"'; ?>>image</option>
			</select>
			 first.
		</p>
		<!-- Width: Text Input -->
		<p>
			In case of Vertical view <br>
			<label for="<?php echo $this->get_field_id( 'itemwidth' ); ?>"><?php _e('Minimum Width:', 'amty_thumb_recent'); ?></label>
			<input id="<?php echo $this->get_field_id( 'itemwidth' ); ?>" name="<?php echo $this->get_field_name( 'itemwidth' ); ?>" value="<?php echo $instance['itemwidth']; ?>" style="width:30px;" /><br>
		<!-- Height: Text Input -->
			<label for="<?php echo $this->get_field_id( 'itemheight' ); ?>"><?php _e('Text Height:', 'amty_thumb_recent'); ?></label>
			<input id="<?php echo $this->get_field_id( 'itemheight' ); ?>" name="<?php echo $this->get_field_name( 'itemheight' ); ?>" value="<?php echo $instance['itemheight']; ?>" style="width:30px;" /><br>
		<!-- Border: Text Input -->
			<label for="<?php echo $this->get_field_id( 'itemborder' ); ?>"><?php _e('Box Border:', 'amty_thumb_recent'); ?></label>
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
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
	?>
            	<ul><!-- AmtyEra.net -->
                	<?php
	                    $recent = new WP_Query();
                	    	  $recent -> query("showposts=" . $maxpost);
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
			<div style="min-width:<?php echo $width + 20;?>px;width:<?php echo $itemwidth;?>px;border:<?php echo $itemborder;?>px solid;float:left;margin:1px">
			  <li>
				<?php if($templateItems == 'image'){ ?>
					<div style="padding:2px;" ><?php if ( $icon == 'yes') { lead_img_thumb_post($width ,$height ,$border,$imagepath ,$icontype ); } ?></div>
					<div style="height:<?php echo $itemheight;?>px;"><a href="<?php the_permalink(); ?>" title="<?php echo $ptitle; ?>"><?php echo $ptitle; ?></a></div>
				<?php }
				else {?>
					<div style="height:<?php echo $itemheight;?>px;"><a href="<?php the_permalink(); ?>" title="<?php echo $ptitle; ?>"><?php echo $ptitle; ?></a></div>
					<div style="padding:2px;" ><?php if ( $icon == 'yes') { lead_img_thumb_post($width ,$height ,$border,$imagepath ,$icontype ); } ?></div>
				<?php }?>
			  </li>
			</div>
              <?php
			}
		 endwhile; ?>
            </ul><a href="http://amtyera.net/">*</a>
	<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}
} //class end

function lead_img_thumb_post($w=70,$h=70,$b=0,$default_src='',$imagetype) {
        global $id, $wpdb;
	  $img='';
	  $attach_img='';
	  if($default_src == '') //default thumbnail path is given
		$default_src= get_bloginfo ('url')."/wp-content/plugins/amty_thumb_recent/logo.gif";
        //reading from database
        $image_data = $wpdb->get_results("SELECT guid, post_content, post_mime_type, post_title
        FROM $wpdb->posts
        WHERE post_parent = $id
        ORDER BY ID ASC");


	  $match_count = preg_match_all("/<img[^']*?src=\"([^']*?)\"[^']*?>/", $image_data[0]->post_content, $match_array, PREG_PATTERN_ORDER);
	  $img = $match_array[1][0];

	  $first_image_data = array ($image_data[0]);

        //array output
        foreach($first_image_data as $output) {

	  $style = "style=\"width:".$w."px; height:".$h."px; border:".$b."px solid; margin:1px;\" ";
                        //if there is no description use title (filename) instead
                        if (empty($output->post_content) == TRUE)
                                  {$output->post_content = $output->post_title;}
                        //images
				if (substr($output->post_mime_type, 0, 5) == 'image' && $imagetype = 'uploaded')
                                 {echo "<img src=\"$output->guid\" alt=\"$output->post_title\" title=\"$output->post_content\" $style />";}
                        else	//exist on external server or attached image
     				{
					$attach_img = amty_get_firstimage1($output->guid);
					if($attach_img != '' && $imagetype = 'attached')	//Image attached as a metadata
						echo "<img src=\"$attach_img\" $style /> ";
					elseif($img !='' && $imagetype = 'referenced')		//image on remote machine
						echo "<img src=\"$img\" $style /> ";
					else{
						if (substr($output->post_mime_type, 0, 5) == 'image')
                        	         {echo "<img src=\"$output->guid\" alt=\"$output->post_title\" title=\"$output->post_content\" $style />";}
	                  	      else	//exist on external server or attached image
     						{
							$attach_img = amty_get_firstimage1($output->guid);
							if($attach_img = '')	//Image attached as a metadata
								echo "<img src=\"$attach_img\" $style /> ";
							elseif($img !='')		//image on remote machine
								echo "<img src=\"$img\" $style /> ";
							else //Post has no image
			     					echo "<img src=\"" . $default_src . "\"  $style />";
						}//inner else end
					}//outer else end
				}
       }//foreach end
}//function end

function amty_get_firstimage1($post_id='', $size='thumbnail') {
         $id = (int) $post_id;
         $args = array(
          'post_type' => 'attachment',
          'post_mime_type' => 'image',
          'numberposts' => 1,
          'order' => 'ASC',
          'orderby' => 'menu_order ID',
          'post_status' => null,
          'post_parent' => $id
         );
         $attachments = get_posts($args);
         if ($attachments) {
           $img = wp_get_attachment_image_src($attachments[0]->ID, $size);
           return $img[0];
         }else{
           return '';
         }
        }

?>