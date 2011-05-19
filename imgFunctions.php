<?php

function lead_img_thumb_post($w=70,$h=70,$b=0,$default_src='',$imagetype) {


	  $style = "style=\"border:".$b."px solid; margin:1px;\" ";

	if (function_exists('amty_lead_img')) {
		  $img_url = amty_lead_img($w,$h,1,'','','zoom','');
		  if($img_url == '')
		  	$img_url = $default_src ;
	}
	else{
		echo "amtyThumb plugin is missing";
		$img_url = "";
	}

	echo  "<img src=\"" . $img_url . "\" alt=\"" . $output->post_title . "\" title=\"" . $output->post_content . "\"" . $style . "/>";

}//function end

?>