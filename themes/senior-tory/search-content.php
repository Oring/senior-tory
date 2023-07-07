<?php 
global $ts_config,$parent_permalink,$parent_title,$addClass;

$post_thumbnail		= "";

if($ts_config["type"]=="mb"){
	$post_id					= get_the_ID();
	$post_permalink		= mbw_get_url(array('board_pid'=>mbw_get_board_item('fn_pid'),'mode'=>'view'),$parent_permalink,"");
	$post_class				= "";
	$post_type				= "mb";
	$post_title				= mbw_get_board_item('fn_title');	

	//카테고리 표시					
	if(mbw_get_board_item("fn_category1")!=""){
		$post_title		= '<span class="category1-text">['.mbw_get_board_item("fn_category1").']</span> '.$post_title;
	}				
	//댓글 개수 표시하기
	if(intval(mbw_get_board_item("fn_comment_count"))>0){
		$post_title		.= "<span class='cmt-count'> [<span class='cmt-count-num'>".mbw_get_board_item("fn_comment_count")."</span>]</span>";
	}
	
	if(intval(mbw_get_board_item("fn_is_secret"))!=1 && mbw_get_board_item('fn_image_path')!="") $post_thumbnail		= mbw_get_image_url("url_small",mbw_get_board_item('fn_image_path'));
	$post_date				= mbw_get_board_item("fn_reg_date");
	$post_content			= mbw_get_board_item("fn_content",false);
	if(mbw_get_board_item("fn_data_type")=="html") $post_content			= mbw_htmlspecialchars_decode($post_content);
	$post_content			= strip_tags(html_entity_decode($post_content, ENT_QUOTES));
	$post_content			= trim(str_replace(array("&nbsp;","　"," ","  "), " ", $post_content));

	$post_author			= mbw_get_board_item("fn_user_name",false); 
	$post_link				= ""; 
}else{
	$post_id					= get_the_ID();
	$post_permalink		= get_the_permalink();
	$post_class				= "";
	$post_type				= $post->post_type;
	$post_title				= get_the_title();
	$post_date				= get_the_time('Y-m-d H:i:s');

	$post_content			= $post->post_content;
	//$post_content		= do_shortcode($post_content);
	$post_content			= preg_replace("/\[.*\]/s", "", $post_content); 

	$post_author			= get_the_author_meta('display_name', $post->post_author); 
	$post_link				= ""; 
	$post_images			= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ));
	if(!empty($post_images[0])) $post_thumbnail		= $post_images[0];
}

if(empty($post_title)) return;

$ts_config["index"]		= $ts_config["index"]+1;

if($ts_config["content_display"]){
	$maxtext					= "...";
	$content_maxlength		= $ts_config["content_maxlength"];
	$post_content				= preg_replace("/<script.*<\/script>/s", "", $post_content); 
	$post_content				= strip_tags($post_content);

	if(function_exists('mb_strlen')) $content_length	= mb_strlen($post_content, mbw_get_option("encoding"));
	else $content_length	= strlen($post_content);

	if($content_maxlength<$content_length){
		if(function_exists('mb_substr')) $post_content		= mb_substr($post_content, 0, $content_maxlength, mbw_get_option("encoding")).$maxtext;
		else $post_content		= substr($post_content, 0, $content_maxlength).$maxtext;
	}
}else $post_content				= "";

//검색 키워드에 하이라이트색 적용
$post_title	= mbw_search_text_highlight((str_replace("'", "", $ts_config["search_text"])),$post_title,'<span style="background-color:#FFFF66; color:#FF0000;">\1</span>');

if(!empty($post_content)) 
	$post_content	= mbw_search_text_highlight((str_replace("'", "", $ts_config["search_text"])),$post_content,'<span style="background-color:#FFFF66; color:#FF0000;">\1</span>');


if(!$ts_config["show_post_thumbnail"]) $post_thumbnail		= "";

?>
<div class="ht-search-item <?php echo $ts_config["responsive_class"]; ?> <?php echo $addClass; ?>">

	<header class="ht-content-header"></header>

	<div class="ht-content-body post-<?php echo $post_id; ?>">
		<div>
			<?php if(!empty($post_thumbnail)){ ?>
			<div class="pull-left" style="margin-right:8px !important;"><a href="<?php echo $post_permalink; ?>"><div class="border-eee-1"><div style="background-image:url('<?php echo $post_thumbnail; ?>');background-position:center center;background-size:cover;width:42px;height:42px"></div></div></a></div>	
			<?php } ?>
			<div class="ht-post-title">
			<?php if(!empty($parent_title)){ ?>
				<a href="<?php echo $parent_permalink; ?>"><?php echo $parent_title; ?></a> <span style="font-size:11px;">&gt;</span>
			<?php } ?>
			
			<a href="<?php echo $post_permalink; ?>"><?php echo $post_title; ?></a>

			
			</div>
			<div class="ht-post-date "><div class="published" title="<?php echo $post_date;?>"><?php echo $post_date; ?></div></div>
		</div>
		<div class="ht-post-body ">
			<?php echo $post_content; ?>
		</div>
	</div><!-- .ht-content-body -->


	<div class="ht-content-footer">	</div>

</div><!-- .ht-search-item-->