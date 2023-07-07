<?php
/**
 * Template Name: Page-content
 *
 */
//Body 영역에 Content 만 출력하기
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		the_content();
	}
}

get_footer();
?>