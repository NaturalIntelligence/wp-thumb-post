<?php
/*
Plugin Name: amtyThumb Posts
Plugin URI: http://article-stack.com/
Description: Shows Recently written, Recently viewed, Random, Mostly & Rarely Viewd, Mostly Commented posts with thumbnail.
You may customize it in any way. It uses amtyThumb plugin to extracts first image of your current post.
Fully customizable. You may control thumbnail size, Title length, apperance, and alomst everything

Author: Amit Gupta
Version: 7.0.0
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
		$widget_ops = array( 'classname' => 'amty_thumb', 'description' => __('Displays posts with thumbnail', 'amtyThumb_posts') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'amty-thumb-recent' );
		
		/* Create the widget. */
		$this->WP_Widget( 'amty-thumb-recent', __('Amty Thumb Posts', 'amtyThumb_posts'), $widget_ops, $control_ops );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and width & Height to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['titlelen'] = strip_tags( $new_instance['titlelen'] );
		$instance['shortenchar'] = strip_tags( $new_instance['shortenchar'] );//shortenchar
		$instance['maxpost'] = strip_tags( $new_instance['maxpost'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['height'] = strip_tags( $new_instance['height'] );		
		
		//$instance['show_default'] = $new_instance['show_default'];
		$instance['default_img_path'] = $new_instance['default_img_path'];
		$instance['pretag'] = $new_instance['pretag'];
		$instance['posttag'] = $new_instance['posttag'];
		$instance['template'] = $new_instance['template'];		
		$instance['category'] = $new_instance['category'];
		$instance['widgettype'] = $new_instance['widgettype'];
		return $instance;
	}



function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Amty Thumb Recently Written',
					 'width' => '70',
					 'height' => '70',
					 'default_img_path' => '',
					 'pretag' => '<ul>',
					 'template' => '<li><img src="%POST_THUMB%" /><a href="%POST_URL%"  title="%POST_TITLE%">%POST_TITLE%</a></li>',
					 'posttag' => '</ul>',
					 'titlelen' => 30,
					 'shortenchar' => '...',
					 'maxpost' =>  10,
					 'category' => 'All',
					 'widgettype' => 'Recently Written'
					  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>

		<p>
			<select id="<?php echo $this->get_field_id( 'widgettype' ); ?>" name="<?php echo $this->get_field_name( 'widgettype' ); ?>" style="width:80px;">
				<option <?php if ( 'Recently Written' == $instance['widgettype'] ) echo 'selected="selected"'; ?>>Recently Written</option>
				<option <?php if ( 'Random' == $instance['widgettype'] ) echo 'selected="selected"'; ?>>Random</option>
				<option <?php if ( 'Most Commented' == $instance['widgettype'] ) echo 'selected="selected"'; ?>>Most Commented</option>
				<option <?php if ( 'Most Viewed' == $instance['widgettype'] ) echo 'selected="selected"'; ?>>Most Viewed</option>
				<option <?php if ( 'Least Viewed' == $instance['widgettype'] ) echo 'selected="selected"'; ?>>Least Viewed</option>
				<option <?php if ( 'Recently Viewed' == $instance['widgettype'] ) echo 'selected="selected"'; ?>>Recently Viewed</option>
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
<hr />
		<!-- Width: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" style="width:30px;" />
		<!-- Height: Text Input -->
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" style="width:30px;" />
		</p>

		<!-- Show default image Checkbox -->
		<?php /*<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_default'], true ); ?> id="<?php echo $this->get_field_id( 'show_default'); ?>" name="<?php echo $this->get_field_name( 'show_default'); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_default' ); ?>"><?php _e('Display default image?', 'amtyThumb_posts'); ?></label>
		</p>*/?>
		<!-- Default Image Path: Text Input -->
		<p>
		<!-- default_img_path: Text Input -->
			<label for="<?php echo $this->get_field_id( 'default_img_path' ); ?>"><?php _e('Default thumbnail path: ', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'default_img_path' ); ?>" name="<?php echo $this->get_field_name( 'default_img_path' ); ?>" value="<?php echo $instance['default_img_path']; ?>" style="width:95%;" />
		</p>
		<hr />
		<h3>Template</h3>
		
		<p>
		<!-- PreTag: Text Input -->
			<label for="<?php echo $this->get_field_id( 'pretag' ); ?>"><?php _e('PreTag:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'pretag' ); ?>" name="<?php echo $this->get_field_name( 'pretag' ); ?>" value="<?php echo $instance['pretag']; ?>" style="width:60px;" />
		<!-- template: Text Input -->
		<br />
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template:', 'amtyThumb_posts'); ?></label><br />
			<textarea id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" rows="4" style="width:100%;"> <?php echo $instance['template']; ?></textarea>
		<br />
		<!-- PostTag: Text Input -->
			<label for="<?php echo $this->get_field_id( 'posttag' ); ?>"><?php _e('PostTag:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'posttag' ); ?>" name="<?php echo $this->get_field_name( 'posttag' ); ?>" value="<?php echo $instance['posttag']; ?>" style="width:60px;" />
		</p>
		<p>
		<!-- Length: Text Input -->
			<label for="<?php echo $this->get_field_id( 'titlelen' ); ?>"><?php _e('Title Length(in number of chars):', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'titlelen' ); ?>" name="<?php echo $this->get_field_name( 'titlelen' ); ?>" value="<?php echo $instance['titlelen']; ?>" style="width:30px;" />
			<br />
			<label for="<?php echo $this->get_field_id( 'shortenchar' ); ?>"><?php _e('Text to append in last of short title:', 'amtyThumb_posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'shortenchar' ); ?>" name="<?php echo $this->get_field_name( 'shortenchar' ); ?>" value="<?php echo $instance['shortenchar']; ?>" style="width:30px;" />
		</p>
		<hr />
		Powered by <a href="article-stack.com">article-stack</a> & <a href="thinkzarahatke.com">thinkzarahatke</a>.
	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$width = $instance['width'];
		$height = $instance['height'];
		$maxpost = $instance['maxpost'];
		$default_img_path = $instance['default_img_path'];			//path for default image in case of no image in post
		$pretag = $instance['pretag'];
		$template = $instance['template'];
		$posttag = $instance['posttag'];			
		$titlelen = $instance['titlelen'];				//Stripping Post title for better display; if 0 then no stripping
		$shortenchar = $instance['shortenchar'];
		$categoryName = $instance['category'];		//limiting search to a particular category
		$widgetType = $instance['widgettype'];		//Recent/random/popular etc.
		/* Before widget (defined by themes). */
		
		echo $before_widget;
		
		
		displayPosts($before_title ,$after_title,$title, $width ,$height ,$maxpost ,$default_img_path,$pretag ,$template,$posttag,$titlelen,$shortenchar ,$categoryName ,$widgetType);
		/* After widget (defined by themes). */
		echo $after_widget;
	}
} //class end

function amtyThumb_shortcode( $attr, $content = null ) {
    extract( shortcode_atts( array( 'title' => 'Amty Thumb Posts', //'' to hide it
								   'before_title' => '<h2>',
								   'after_title' => '</h2>',
					 'thumb_width' => '70',
					 'thumb_height' => '70',
					 'default_img_path' => '',
					 'pretag' => '',
					 'template' => '',					 
					 'posttag' => '',
					 'title_len' => 30,
					 'shortenchar' => '...',
					 'max_post' =>  10,
					 'category' => 'All',
					 'widgettype' => 'Recently Written' //'Recent','Random','Most Commented'
					 ), $attr ) );

displayPosts($before_title, $after_title,$title, $thumb_width,$thumb_height,$max_post,$default_img_path,$pretag,$template,$posttag,$title_len,$shortenchar,$category,$widgettype);

}


function displayPosts($before_title, $after_title, $title = '',$width = 70,$height = 70 ,$maxpost  = 10 ,$default_img_path = '',$pretag = '',$template , $posttag = '',$titlelen = 30,$shortenchar='...',$categoryName = 'All',$widgetType = 'Recent'){
	global $wpdb;
	if ( $title != '' ){
		echo $before_title . $title . $after_title;
	}
	if ($categoryName != 'All') {
		$theCatId = get_cat_id($categoryName );
		//$theCatId = $theCatId->term_id;
		$category = "cat=" . $theCatId . "&";
	}else{
			$category = '';
	}

	if($widgetType == 'Recently Written')
		$amty_posts = get_posts($category . "showposts=" . $maxpost . "&orderby=date");
	elseif($widgetType == 'Random')
		$amty_posts = get_posts($category . "showposts=" . $maxpost . "&orderby=rand");
	elseif($widgetType == 'Most Commented')
		$amty_posts = get_posts($category . "showposts=" . $maxpost . "&orderby=comment_count");
	elseif($widgetType == 'Most Viewed')
		$amty_posts = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_type = 'post' AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT $maxpost");
	elseif($widgetType == 'Least Viewed')
		$amty_posts = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_type = 'post' AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views ASC LIMIT $maxpost");
	elseif($widgetType == 'Recently Viewed')
		get_recently_viewed_posts_with_thumbs($maxpost,$template,$titlelen,$shortenchar);
	$temp = "";
	
		 if($amty_posts) {
			foreach ($amty_posts as $post) {
				
				$temp = $template;	
				//Decorating Post title
				//$ptitle = get_the_title($post);
				$ptitle = $post->post_title;
				
				if($titlelen != 0)
				{
				  if (strlen($ptitle)> $titlelen )
				  {
					$stitle = substr($ptitle,0,$titlelen ) . $shortenchar;
				  }
				  else{
					$stitle = $ptitle;
				  }
				}
				
				//'<li><img src="%POST_THUMB%" /><a href="%POST_URL%"  title="%POST_TITLE%">%POST_TITLE%</a></li>'
					
					/*
							setup_postdata($post);
							the_title();
							the_attachment_link($post->ID, false);
							the_excerpt();
						OR

							$attachments = get_posts($args);
							if ($attachments) {
								foreach ( $attachments as $attachment ) {
									echo apply_filters( 'the_title' , $attachment->post_title );
									the_attachment_link( $attachment->ID , false );
								}
							}
					*/
					$post_views =  get_post_meta($post->ID, 'views', true);
					$temp = str_replace("%VIEW_COUNT%", number_format_i18n($post_views), $temp);			
					$post_excerpt = views_post_excerpt($post->post_excerpt, $post->post_content, $post->post_password, $chars);

					$temp = str_replace("%POST_TITLE%", $ptitle, $temp);
					$temp = str_replace("%SHORT_TITLE%", $stitle, $temp);
					$temp = str_replace("%POST_EXCERPT%", $post_excerpt, $temp);
					$temp = str_replace("%POST_CONTENT%", $post->post_content, $temp);
					$temp = str_replace("%POST_URL%", get_permalink($post->ID), $temp);
					$temp = str_replace("%POST_DATE%", mysql2date('F j, Y', $post->post_date, false), $temp);
					$pos = strrpos($temp, "%POST_THUMB%");
					if ($pos === false) { 
						//Do nothing
					}else{
						$imgpath = lead_img_thumb_post($width ,$height ,$default_img_path , $post->ID );
						$temp = str_replace("%POST_THUMB%", $imgpath , $temp);
					}
					
					$output .= $temp;
			}
			$output = $pretag . $output . $posttag;
			echo $output;
		}
		 ?>
            
            <!-- <a href="<?php echo "http://article-stack.com"; ?>">*</a> -->
            <div style="clear:both;"></div>
	<?php
}

function lead_img_thumb_post($w=70,$h=70,$default_src='',$post_id) {

	if (function_exists('amty_lead_img')) {
		if($post_id != '')
		  $img_url = amty_lead_img($w,$h,1,'','','zoom',$post_id);
		else
		  $img_url = amty_lead_img($w,$h,1,'','','zoom','');
		if($img_url == '')
		  $img_url = amty_lead_img($w,$h,1,$default_src,'','zoom','');
	}
	else{
		echo "amtyThumb plugin is missing";
		$img_url = "";
	}

	//echo  "<img src=\"" . $img_url . "\" alt=\"" . $output->post_title . "\" title=\"" . $output->post_content . "\"" . $style . "/>";
	return $img_url;
}//function end

//if(!function_exists('get_recently_viewed_posts')) {
function get_recently_viewed_posts_with_thumbs( $max_shown = 10 , $template,$titlelen,$shortenchar = '...') {

		if ( $max_shown + 0 > 0 );
		else $max_shown = 10;
		
		$recently_viewed_posts = recently_viewed_posts_cache_get();		
		if ( !$recently_viewed_posts && !is_array( $recently_viewed_posts ) ) 
			return "";
		$html = "";
		$count = 0;
		
		$html .= "<!-- BUFFER:" . count( $recently_viewed_posts ) . "-->";

		// run a WP_Query so that the get_permalinks and get_the_titles don't cause individual queries.
		if ( $max_shown > 5 ) { // guesstimate threshold
			foreach ( $recently_viewed_posts as $item ) 
				if ( $item[1] != recently_viewed_posts_get_remote_IP() ) {
					$post_in[] = $item[0];
					if ( ++$count == $max_shown ) 
						break;  // i've shown enough
				}
			new WP_Query( array( 'post__in' => $post_in, 'posts_per_page' => 10000 ) ); 
		}
		
		$count = 0;
		foreach ( $recently_viewed_posts as $item ) {
			$pos_content = strrpos($temp, "%POST_CONTENT%");
			$pos_excerpt = strrpos($temp, "%POST_EXCERPT%");
			if ($pos_content === false && $pos_excerpt === false ) { 
				//Do nothing
			}else{
				global $wpdb;
				$post_data = $wpdb->get_results("SELECT post_content,post_excerpt FROM wp_posts WHERE id = $item[0]");
				echo $post_data;
				$post_content = $post_data[0]->post_content;
				$post_excerpt = $post_data[0]->post_excerpt;
			}
			$post_views =  get_post_meta($item[0], 'views', true);
			if ( $item[1] != recently_viewed_posts_get_remote_IP() ) {
				//Decorating Post title
				//$ptitle = get_the_title($post);
				$ptitle =get_the_title( $item[0] );
				
				if($titlelen != 0)
				{
				  if (strlen($ptitle)> $titlelen )
				  {
					$stitle = substr($ptitle,0,$titlelen ) . $shortenchar;
				  }
				  else{
					$stitle = $ptitle;
				  }
				}
				$search = array( 
					"%VIEW_COUNT%",
					"%POST_THUMB%", 
					"%POST_URL%",
					"%POST_TITLE%",
					"%SHORT_TITLE%",
					"%POST_CONTENT%",
					"%POST_EXCERPT%",
					"%POST_LAST_VIEWED%"
				);
				$replace = array(
					$post_views,
					lead_img_thumb_post($width ,$height ,$default_img_path , $item[0] ),
					get_permalink( $item[0] ),
					$ptitle,
					$stitle,
					$post_content,
					$post_excerpt,
					recently_viewed_posts_time_since( $item[2] )
				);

				$template = apply_filters( "recently_viewed_posts_entry_format", $template, $item );
				$entry = str_replace( $search, $replace, $template );
				$html .= apply_filters( "recently_viewed_posts_entry", $entry );
				if ( ++$count == $max_shown ) 
					break;  // i've shown enough
			}
		}
		return apply_filters( "get_recently_viewed_posts", $html );
	}
//}


?>