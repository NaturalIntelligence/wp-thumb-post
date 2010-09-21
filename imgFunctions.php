<?php

function lead_img_thumb_post($w=70,$h=70,$b=0,$default_src='',$imagetype) {
        global $id, $wpdb;
	  $img='';
	  $attach_img='';
	  if($default_src == '') //default thumbnail path is given
		$default_src= get_bloginfo ('url')."/wp-content/plugins/amtyThumb_posts/logo.jpg";
        //reading from database
        /*$image_data = $wpdb->get_results("SELECT guid, post_content, post_mime_type, post_title
        FROM $wpdb->posts
        WHERE post_parent = $id
        ORDER BY ID ASC");*/
		
		$image_data = $wpdb->get_results("SELECT guid, post_content, post_mime_type, post_title
	FROM wp_posts
	WHERE id = $id");


	  	  $match_count = preg_match_all("/<img[^']*?src=\"([^']*?)\"[^']*?>/", $image_data[0]->post_content, $match_array, PREG_PATTERN_ORDER);
	  if($match_count == 0){
		  
		  $match_count = preg_match_all("/<img[^']*?src=\"([^']*?)\"[^']*?>/", $image_data[1]->post_content, $match_array, PREG_PATTERN_ORDER);
		  if($match_count == 0){
			  $match_count = preg_match_all("/<img[^>]+>/i", $image_data[1]->post_content, $match_array, PREG_PATTERN_ORDER);
	  		  if($match_count == 0)
				  $match_count = preg_match_all("/<img[^']*?src=\"([^']*?)\"[^']*?//>/", $image_data[0]->post_content, $match_array, PREG_PATTERN_ORDER);
	  	}
	  }

	  $img = $match_array[1][0];

	  $first_image_data = array ($image_data[0]);

        //array output
        foreach($first_image_data as $output) {

	  $style = "style=\"border:".$b."px solid; margin:1px;\" ";
                        //if there is no description use title (filename) instead
                        if (empty($output->post_content) == TRUE)
                                  {$output->post_content = $output->post_title;}
                        //images
				if (substr($output->post_mime_type, 0, 5) == 'image' && $imagetype = 'uploaded')
                                 {echo "<img src=\"" . get_bloginfo ('url') . "/wp-content/plugins/amtyThumb_posts/util/imgsize.php?&w=".$w."&h=".$h."&img=" . $output->guid . "\" alt=\"$output->post_title\" title=\"$output->post_content\" $style />";}
                        else	//exist on external server or attached image
     				{
					$attach_img = amty_get_firstimage1($output->guid);
					if($attach_img != '' && $imagetype = 'attached')	//Image attached as a metadata
						echo "<img src=\"" . get_bloginfo ('url') . "/wp-content/plugins/amtyThumb_posts/util/imgsize.php?&w=".$w."&h=".$h."&img=" . $attach_img . "\" $style /> ";
					elseif($img !='' && $imagetype = 'referenced')		//image on remote machine
						echo "<img src=\"" . get_bloginfo ('url') . "/wp-content/plugins/amtyThumb_posts/util/imgsize.php?&w=".$w."&h=".$h."&img=" . $img . "\" $style /> ";
					else{
						if (substr($output->post_mime_type, 0, 5) == 'image')
                        	         {echo "<img src=\"" . get_bloginfo ('url') . "/wp-content/plugins/amtyThumb_posts/util/imgsize.php?&w=".$w."&h=".$h."&img=" . $output->guid . "\" alt=\"$output->post_title\" title=\"$output->post_content\" $style />";}
	                  	      else	//exist on external server or attached image
     						{
							$attach_img = amty_get_firstimage1($output->guid);
							if($attach_img = '')	//Image attached as a metadata
								echo "<img src=\"" . get_bloginfo ('url') . "/wp-content/plugins/amtyThumb_posts/util/imgsize.php?&w=".$w."&h=".$h."&img=" . $attach_img . "\" $style /> ";
							elseif($img !='')		//image on remote machine
								echo "<img src=\"" . get_bloginfo ('url') . "/wp-content/plugins/amtyThumb_posts/util/imgsize.php?&w=".$w."&h=".$h."&img=" . $img . "\" $style /> ";
							else //Post has no image
			     					echo "<img src=\"" . get_bloginfo ('url') . "/wp-content/plugins/amtyThumb_posts/util/imgsize.php?&w=".$w."&h=".$h."&img=" . $default_src . "\"  $style />";
			     					//echo "<img src=\" . $default_src . \"  $style />";
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