<?php
/**
* @package WordPress
* @subpackage Default_Theme
template name: Case Studies Page
*/
get_header();


/** Inner Banner */
get_template_part( 'template-parts/parts', 'inner-banner' );


echo '<section class="case-studies case-studies-page">'.
  '<div class="wrapper">'.
    '<h2>IGA Rewards Case Studies</h2>';

    $wpq = array (
				'post_type'	   =>'case_studies',
				'orderby'		 => 'ID',
				'order'		   => 'ASC',
				'posts_per_page'  => -1
			);
			$myquery = new WP_Query ($wpq);
			$article_count = $myquery->post_count;
			if ($article_count) {
      echo '<div class="case-studies-list d-flex justify-content-center">' ;
          while ($myquery->have_posts()) : $myquery->the_post();
          echo '<div class="case_studies cell-4 cell-992-6 cell-640-12">' .
            '<a href="'. get_the_permalink() .'">'.
                '<div class="case_thumb">' .
                  (
                    has_post_thumbnail()
                    ? wp_get_attachment_image( get_post_thumbnail_id(), 'large' )
                    : ''
                  ) .
                '</div>' .
                '<div class="case_content">' .
                    '<p class="transition">'. get_field('subtitle') .'</p>'.
                    '<h4 class="transition pb-10">' . get_the_title() . '</h4>'.
                '</div>'.
              '</a>'.
            '</div>' ;
          endwhile;
      echo '</div>' ;
    }

  echo '</div>'.
'</section>';



/** Best Solution */
get_template_part( 'template-parts/parts', 'best-solution' );


get_footer();
?>
