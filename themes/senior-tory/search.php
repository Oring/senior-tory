<?php
$ts_config		= array();

/* 사용자 설정 Start */

// 커머스 패키지가 설치되어 있을 경우 상품 검색 정보 표시 : true, false
$ts_config["show_commerce_product"]		= true;

// 워드프레스 페이지 및 포스트 검색 결과 표시 : true, false
$ts_config["show_wp_post"]					= true;

// 검색 결과 제목에 썸네일 표시 여부 : true, false
$ts_config["show_post_thumbnail"]			= true;

// 검색 결과 게시물 내용 표시 여부 : true, false
$ts_config["content_display"]					= true;

// 검색 결과 블럭 쌓기 효과 적용 여부 : true, false 
$ts_config["use_masonry"]						= true;

// 검색 결과 게시물 내용 최대 길이 설정
$ts_config["content_maxlength"]				= 40;

//반응형 클래스 설정 : col-432, col-555, col-444, col-333, col-221, col-111
$ts_config["responsive_class"]					= "col-221";

//검색에 노출하지 않을 게시판 설정
//게시판 이름을 쉼표로 구분해서 입력: board1,board2,board3
$ts_config["not_allow_board_name"]			= "home,main,users,logs,user_messages,commerce_order";

/* 사용자 설정 End */

$ts_config["action"]			= 'ht_theme_search';
$ts_config["type"]			= "mb";
$ts_config["index"]			= 0;

$maxCount					= 50;
$template_index				= 0;

if(!defined('HT_THEME')){ 
	define('HT_THEME', 'HOMETORY');
	if(function_exists('mbw_get_resize_responsive')) echo mbw_get_resize_responsive(mbw_get_vars("device_type"));
}
if(!function_exists('mbw_theme_search_template')){
	function mbw_theme_search_template(){			
		if(is_search()){
			global $wpdb,$mdb,$mb_admin_tables,$mb_fields,$ts_config,$parent_permalink,$parent_title,$addClass,$maxCount,$template_index;

			//회원 레벨 가져와서 리스트 레벨 비교하기
			$mb_user_level			= mbw_get_user("fn_user_level");
			$search_items			= array();
			$search_count			= 0;
			if(!empty($_GET["s"])){
				$ts_config["search_text"]				= mbw_htmlspecialchars($_GET["s"]);
			}else{
				return;
			}
		
			//커머스 패키지가 설치되어 있으면 상품 정보 출력
			if($ts_config["show_commerce_product"] && mbw_get_option("commerce_version")!=""){
				$table_name		= mbw_get_board_table_name("commerce_product");
				$select_query	= $mdb->prepare("select * from `".$table_name."` where sale_status=1 and (".$mb_fields["board"]["fn_title"]." like %s or ".$mb_fields["board"]["fn_content"]." like %s or ".$mb_fields["board"]["fn_user_name"]." like %s or ".$mb_fields["board"]["fn_tag"]." like %s or ".$mb_fields["board"]["fn_category1"]." like %s or ".$mb_fields["board"]["fn_category2"]." like %s or ".$mb_fields["board"]["fn_category3"]." like %s) and is_show=1 order by pid desc limit 0, 100", '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%');
				$results				= $mdb->get_results($select_query,ARRAY_A);
				if(!empty($results)){
					$search_count		= $search_count+count($results);
					$search_items["commerce"]	= $results;
				}
			}
			//게시판 검색 결과 출력
			$items					= $mdb->get_results("SELECT * FROM ".$mb_admin_tables["board_options"]." WHERE board_type='board' and table_link='' and post_id!=0 and list_level<=".$mb_user_level, ARRAY_A);
			foreach($items as $item){
				if(!empty($ts_config["not_allow_board_name"]) && strpos(','.$ts_config["not_allow_board_name"].',', ','.$item["board_name"].',')!==false) continue;

				$table_name		= mbw_get_board_table_name($item["board_name"]);
				$select_query	= $mdb->prepare("select * from `".$table_name."` where is_secret=0 and (".$mb_fields["board"]["fn_title"]." like %s or ".$mb_fields["board"]["fn_content"]." like %s or ".$mb_fields["board"]["fn_user_name"]." like %s or ".$mb_fields["board"]["fn_tag"]." like %s or ".$mb_fields["board"]["fn_category1"]." like %s or ".$mb_fields["board"]["fn_category2"]." like %s or ".$mb_fields["board"]["fn_category3"]." like %s) and is_show=1 order by pid desc limit 0, 100", '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%', '%'.$ts_config["search_text"].'%');
				$results				= $mdb->get_results($select_query,ARRAY_A);
				if(!empty($results)){
					$search_count		= $search_count+count($results);				
					$search_items[$item["post_id"]]	= $results;
				}
			}			
			
			if($search_count > 0){
				mbw_set_board_fields($mb_fields["board"]);
				$template_start	= "";

				foreach($search_items as $key=>$board_items){
					if($key=="commerce"){
						$parent_permalink		= mbw_get_product_view_url();
						$parent_title				= "";
					} else{
						$parent_permalink		= get_permalink($key);						
						$parent_title				= $mdb->get_var($mdb->prepare("SELECT post_title FROM ".$wpdb->posts." WHERE ID=%d",$key));
					}					
					foreach($board_items as $item){			
						if( $template_index >= $maxCount ){
							$addClass	=	"mb-hide-content";
						}else{
							$addClass	=	"";
						}
						mbw_set_board_item($item);
						get_template_part('search-content');
						$template_index++;
					}
					
				}
				//더보기 버튼 추가
				echo $template_start;			
				
			}
		}		
	}
}
add_action($ts_config["action"], 'mbw_theme_search_template',2);

get_header();
?>
<style type="text/css">
.clear {clear:both  !important;}
.ht-wrapper * {box-sizing:border-box !important;-moz-box-sizing:border-box !important;-webkit-box-sizing:border-box !important;}
.ht-content-none{text-align:center; }
.ht-body-head-wrapper { border-bottom:1px solid #ddd;}
.ht-body-head-wrapper .ht-post-heading{padding:20px 0; position:relative;min-height:65px;}
.ht-body-head-wrapper .ht-post-heading span {border:none !important; font-size:16px; font-weight:500;color:#777}
.ht-body-head-wrapper .ht-post-breadcrumbs{position:absolute;top:30%;right:0px;}
.ht-body-head-wrapper .ht-post-breadcrumbs span, .ht-body-head-wrapper .ht-post-breadcrumbs a{font-size:13px;color:#999}

.ht-content{ padding:40px 0 30px; }
.mb-hide-content{display:none !important;}
.pull-left {float:left !important;overflow:hidden;}
.pull-right {float:right !important;overflow:hidden;}
.ht-search-item .ht-content-body .pull-left{padding-top:2px;}

.ht-body-main{margin:0 -8px}
.ht-body-main .ht-search-item{padding:8px 8px 8px;} 
.ht-search-item .ht-content-body{padding:13px 15px 12px; border:1px solid #ddd; box-shadow:0px 0px 1px #ddd;}
.ht-search-item .ht-post-body {font-size:13px; line-height:20px;}
.ht-search-item .ht-post-title{ padding-bottom:2px; text-align:left;line-height:1.4 !important}
.ht-search-item .ht-post-title a { font-size:14px; font-weight:700; }
.ht-search-item .ht-post-date{border-bottom:1px solid #ddd; font-size:11px; text-align:left; padding-bottom:7px; margin-bottom:7px;}
.ht-search-item .ht-post-meta { font-size:11px; text-align:right;}
.ht-search-item .cmt-count{font-size:12px !important;color:#999 !important;}

.ht-search-item .ht-content-title {font-size:25px; padding:0px 0 25px; font-weight:600;color:#5a5a5a;}
.ht-content-none {line-height:normal;min-height:500px;padding-top:50px;}
.ht-content-none .ht-post-header{font-size:110px; color:#5a5a5a; font-weight:700; padding-bottom:40px; padding-top:10px;}
.mb-mobile .ht-content-none .ht-post-header{font-size:60px; color:#5a5a5a; font-weight:700; padding-bottom:30px; padding-top:10px;line-height:1.4;}

.ht-content-none .ht-post-body-msg1 { font-size:22px; font-weight:600; padding-bottom:20px;}
.ht-content-none .ht-post-body-msg2 { padding-bottom:12px;}
.ht-content-none .ht-search-none-input{max-width:300px;width:calc(100% - 80px);height:34px;vertical-align:top;display:inline-block !important;padding:2px 8px !important;}
.ht-content-none .ht-search-none-btn{width:50px;height:34px;cursor:pointer !important;display:inline-block !important;background-color:#333 !important;color:#FFF !important;border:none;text-align:center;}
</style>

<div class="ht-body-head-wrapper ht-layout ht-wrapper">
	<div class="container">	
		<div class="ht-post-heading" style="">
			<div><span class="ht-title"><?php echo get_search_query();?></span></div>
			<div class="ht-post-breadcrumbs" style=""><?php echo 'Search results for "' . get_search_query() . '"';?></div>
		</div>
	</div>
</div>

<div class="ht-body-wrapper ht-layout ht-wrapper mb-<?php echo mbw_get_vars("device_type");?>">
	<div class="container">
		<div class="ht-body-main">
			<div class="ht-content-wrap">

				<div class="ht-content responsive-list">

					<?php do_action("ht_theme_search") ?>

					<?php if($ts_config["show_wp_post"] && !empty($_GET["s"]) && have_posts()): while(have_posts()) : the_post(); $ts_config["type"]="wp";$parent_title	=""; ?>
						
						<?php 
						if( $template_index >= $maxCount ){
							$addClass	=	"mb-hide-content";
						}else{
							$addClass	=	"";
						}
						get_template_part('search-content'); 
						$template_index++;
						?>

					<?php endwhile; endif; ?>
					
					<?php if(empty($ts_config["index"])){ ?>
						<div class="ht-content-none">
							<header class="ht-content-header">
								<h1 class="ht-content-title"><?php _e( 'Nothing Found', HT_THEME ); ?></h1>
							</header>
						
							<div class="ht-post-header">Try again</div>
							<div class="ht-post-body">
								<div class="ht-post-body-msg1"><span class="ht-post-search-query"></span><?php _e( ' 검색결과가 없습니다', HT_THEME ) ?>.</div>
								<div class="ht-post-body-msg2"><?php _e( '다른 키워드를 사용하여 다시 검색해 주세요', HT_THEME ) ?></div>

									<form id="ht-search-form" class="ht-search-form" method="get" action="<?php echo home_url(); ?>">
									<div>
										<input class="ht-search-none-input" name="s" class="text" type="text" value="<?php the_search_query() ?>" size="40" /><input class="ht-search-none-btn" type="submit" value="검색" />
									</div>
									</form>
								</div>
							</div>
						</div>
					<?php } ?>
					<div class="clear"></div>	
				</div>
				<?php if( $template_index > $maxCount ) { ?>
				<div id="" class="ht-add-list-button" style="text-align:center;margin:0 5px !important;"><button onclick="mbSendContentList();return false;" class="btn btn-default" title="더보기" type="button" style="width:100%;padding:5px 0px !important; height:30px; margin:6px 0 11px !important;background-color:#f3f3f3;border:1px solid #ccc;cursor:pointer !important;"><span>더보기</span></button></div>
				<?php } ?>
			</div><!-- end ht-content-wrap -->
		</div>
	</div><!-- end container -->	
</div>

<?php if($ts_config["use_masonry"] && !empty($ts_config["responsive_class"])){ wp_enqueue_script('masonry'); ?>
<script type="text/javascript">
	var ht_msnry;
	jQuery(document).ready(function() {		
		if(jQuery(".ht-content>.ht-search-item").length>0)
			setTimeout(function() { ht_msnry = new Masonry( jQuery(".ht-content")[0], {itemSelector: '.ht-search-item'});}, 100);
	});

	
	var tempIndex = <?php echo $maxCount; ?>;
	var sendIndex = tempIndex;
	var prevIndex =0;
	function mbSendContentList(){
		prevIndex = sendIndex;
		sendIndex = sendIndex + tempIndex;

		for(var i=prevIndex; i<=sendIndex; i++){
			if( jQuery(".ht-content .mb-hide-content:nth-child("+i+")").length > 0 ){
				jQuery(".ht-content .mb-hide-content:nth-child("+i+")").removeClass("mb-hide-content");
			}else{
				jQuery(".ht-add-list-button").hide();
			}			
		}
		if(typeof(ht_msnry)!=="undefined"){	
			setTimeout(function() { ht_msnry = new Masonry( jQuery(".ht-content")[0], {itemSelector: '.ht-search-item'});}, 100);
		}
	}
</script>
<?php } ?>

<?php
	get_footer();
?>