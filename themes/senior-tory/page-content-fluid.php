<?php
/**
 * Template Name: Page-content-fluid
 *
 */
 //Body 영역에 Content 만 출력하고 헤더의 넓이를 100% 설정
get_header("fluid");

if(have_posts()){
	while(have_posts()){
		the_post();
		the_content();
	}
}

get_footer();
?>